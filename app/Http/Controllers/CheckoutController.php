<?php 
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        $subtotal = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        $shippingCost = 20000; // Biaya pengiriman flat
        $total = $subtotal + $shippingCost;

        return view('checkout.index', compact('carts', 'subtotal', 'shippingCost', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:COD,Transfer Bank,E-Wallet',
        ]);

        $carts = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        // Check stock availability
        foreach ($carts as $cart) {
            if ($cart->product->stock < $cart->quantity) {
                return redirect()->back()->with('error', "Stok {$cart->product->name} tidak mencukupi!");
            }
        }

        DB::beginTransaction();
        try {
            $subtotal = $carts->sum(function ($cart) {
                return $cart->product->price * $cart->quantity;
            });

            $shippingCost = 20000;
            $total = $subtotal + $shippingCost;

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $request->customer_name,
                'customer_email' => auth()->user()->email,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $request->shipping_address,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'notes' => $request->notes,
                'status' => 'pending',
            ]);

            // Create order items and update stock
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'product_name' => $cart->product->name,
                    'price' => $cart->product->price,
                    'quantity' => $cart->quantity,
                    'subtotal' => $cart->product->price * $cart->quantity,
                ]);

                // Update stock and sold count
                $cart->product->decrement('stock', $cart->quantity);
                $cart->product->increment('sold', $cart->quantity);
            }

            // Clear cart
            Cart::where('user_id', auth()->id())->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat! Nomor pesanan: ' . $order->order_number);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $order->load('items.product');

        return view('orders.show', compact('order'));
    }
}
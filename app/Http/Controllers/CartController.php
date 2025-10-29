<?php 
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        $subtotal = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('cart.index', compact('carts', 'subtotal'));
    }

    public function add(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $newQuantity = $cart->quantity + $request->quantity;
            if ($product->stock < $newQuantity) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi!');
            }
            $cart->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Cart $cart, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        if ($cart->product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Keranjang berhasil diupdate!');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan!');
    }
}
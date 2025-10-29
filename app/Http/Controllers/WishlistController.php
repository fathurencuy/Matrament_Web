<?php 
namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', auth()->id())
            ->with('product')
            ->latest()
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    public function add(Product $product)
    {
        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'Produk sudah ada di wishlist!');
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke wishlist!');
    }

    public function remove(Product $product)
    {
        Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari wishlist!');
    }
}
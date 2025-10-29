<?php  

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\ControllerDispatcher;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('stock', '>', 0)
            ->latest()
            ->take(6)
            ->get();

        $newProducts = Product::where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        $bestSellingProducts = Product::where('stock', '>', 0)
            ->orderBy('sold', 'desc')
            ->take(6)
            ->get();

        $categories = Category::withCount('products')->get();

        return view('home.index', compact('featuredProducts', 'newProducts', 'bestSellingProducts', 'categories'));
    }

    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // Dalam implementasi nyata, kirim email atau simpan ke database
        // Untuk demo, kita hanya redirect dengan success message

        return redirect()->route('contact')->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}
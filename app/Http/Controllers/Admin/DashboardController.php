<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'user')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');

        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        $topSellingProducts = Product::orderBy('sold', 'desc')->take(5)->get();

        // Sales chart data (last 7 days)
        $salesData = Order::where('created_at', '>=', now()->subDays(7))
            ->where('status', '!=', 'cancelled')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total) as total_sales')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'totalRevenue',
            'pendingOrders',
            'processingOrders',
            'recentOrders',
            'topSellingProducts',
            'salesData'
        ));
    }
}

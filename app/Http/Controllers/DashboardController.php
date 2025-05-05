<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\StockMovement;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get products near expiry
        $nearExpiryProducts = Product::whereDate('expiry_date', '<=', Carbon::now()->addDays(20))
            ->orderBy('expiry_date')
            ->get();

        // Create notifications for near expiry products if not already created
        foreach ($nearExpiryProducts as $product) {
            $existingNotification = Notification::where('product_id', $product->id)
                ->where('message', 'like', '%expiring soon%')
                ->first();

            if (!$existingNotification) {
                Notification::create([
                    'product_id' => $product->id,
                    'message' => "Product '{$product->name}' is expiring soon (in {$product->getDaysUntilExpiry()} days).",
                    'read' => false,
                ]);
            }
        }

        // Get unread notifications
        $notifications = Notification::with('product')
            ->where('read', false)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get counts for dashboard
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $lowStockProducts = Product::where('stock', '<', 10)->count();
        $recentStockMovements = StockMovement::with('product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'notifications',
            'totalProducts',
            'totalCategories',
            'lowStockProducts',
            'recentStockMovements',
            'nearExpiryProducts'
        ));
    }

    public function markNotificationAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->read = true;
        $notification->save();

        return redirect()->back()->with('success', 'Notification marked as read.');
    }
}

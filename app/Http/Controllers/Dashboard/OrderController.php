<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items']);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment_status') && $request->payment_status != '') {
            $query->where('payment_status', $request->payment_status);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%");
            });
        }

        $orders = $query->latest()->paginate(20);

        return view('dashboard.pages.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.book'])->findOrFail($id);
        return view('dashboard.pages.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,declined,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح');
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['payment_status' => $request->payment_status]);

        return redirect()->back()->with('success', 'تم تحديث حالة الدفع بنجاح');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        
        return redirect()->route('orders.index')
            ->with('success', 'تم حذف الطلب بنجاح');
    }
}

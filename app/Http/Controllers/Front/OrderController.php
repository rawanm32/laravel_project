<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Store a new order
     */
  public function store(Request $request)
{
    // التحقق من البيانات
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
        'city' => 'required|string|max:255',
        'postal_code' => 'nullable|string|max:20',
        'country' => 'required|string|max:2',
        'payment_method' => 'required|in:cash,card,bank',
        'notes' => 'nullable|string|max:1000',
    ]);

    // الحصول على السلة
    $cookieId = $request->cookie('cart_id');
    if (!$cookieId) {
        return redirect()->route('cart.index')->with('error', 'السلة فارغة');
    }

    $cartItems = Cart::with('book')
        ->where('cookie_id', $cookieId)
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'السلة فارغة');
    }

    // حساب الإجمالي
    $subtotal = $cartItems->sum(function ($item) {
        return $item->quantity * ($item->book->price ?? 0);
    });

    $total = $subtotal; // بدون ضريبة أو شحن

    // إنشاء الطلب
    try {
        DB::beginTransaction();

        // إنشاء رقم طلب فريد
        $orderNumber = 'ORD-' . date('Ymd') . '-' . rand(1000, 9999);

        // إنشاء الطلب
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => $orderNumber,
            'status' => 'pending',
            'payment_status' => $request->payment_method == 'cash' ? 'pending' : 'pending',
            'payment_method' => $request->payment_method,
            
            // التسعير
            'subtotal' => $subtotal,
            'tax' => 0,
            'shipping' => 0,
            'total' => $total,
            'currency' => 'USD',
            
            // معلومات الفاتورة
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'notes' => $request->notes,
        ]);

        // إضافة عناصر الطلب
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $cartItem->book_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->book->price ?? 0,
                'total' => $cartItem->quantity * ($cartItem->book->price ?? 0),
            ]);
        }

        // تفريغ السلة
        Cart::where('cookie_id', $cookieId)->delete();

        DB::commit();

        // توجيه إلى صفحة نجاح الطلب
        return redirect()->route('orders.show', $order->id)
            ->with('success', 'تم إنشاء الطلب بنجاح! رقم الطلب: ' . $order->order_number);

    } catch (\Exception $e) {
        DB::rollBack();
        
        return redirect()->back()
            ->withInput()
            ->with('error', 'حدث خطأ: ' . $e->getMessage());
    }
}

    /**
     * Show order success page
     */
    public function success($orderId)
    {
        $order = Order::with('items.book')->findOrFail($orderId);

        // Check if order belongs to current user (if authenticated)
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بعرض هذا الطلب');
        }

        return view('front.orders.success', compact('order'));
    }

    /**
     * Show user orders
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'يجب تسجيل الدخول لعرض الطلبات');
        }

        $orders = Order::where('user_id', Auth::id())
            ->with('items.book')
            ->latest()
            ->paginate(10);

        return view('front.orders.index', compact('orders'));
    }

    /**
     * Show single order
     */
    public function show($id)
    {
        $order = Order::with('items.book')->findOrFail($id);

        // Check if order belongs to current user
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بعرض هذا الطلب');
        }

        return view('front.orders.show', compact('order'));
    }
}

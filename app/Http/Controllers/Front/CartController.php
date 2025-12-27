<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display cart items
     */
    public function index()
    {
        $cartItems = $this->getCartItems();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->book->price;
        });

        return view('front.cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add product to cart
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $cookieId = $this->getCookieId();
        $bookId = $request->book_id;
        $quantity = $request->quantity ?? 1;

        // Check if product already exists in cart
        $cart = Cart::where('cookie_id', $cookieId)
            ->where('book_id', $bookId)
            ->first();

        if ($cart) {
            // Update quantity if exists
            $cart->quantity += $quantity;
            $cart->save();
            
            return redirect()->back()->with('success', 'تم تحديث كمية المنتج في السلة');
        } else {
            // Create new cart item
            Cart::create([
                'cookie_id' => $cookieId,
                'user_id' => Auth::id(),
                'book_id' => $bookId,
                'quantity' => $quantity,
            ]);
            
            return redirect()->back()->with('success', 'تم إضافة المنتج للسلة بنجاح');
        }
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cookieId = $this->getCookieId();

        $cart = Cart::where('id', $id)
            ->where('cookie_id', $cookieId)
            ->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'المنتج غير موجود في السلة');
        }

        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->back()->with('success', 'تم تحديث الكمية بنجاح');
    }

    /**
     * Remove item from cart
     */
    public function destroy($id)
    {
        $cookieId = $this->getCookieId();

        $cart = Cart::where('id', $id)
            ->where('cookie_id', $cookieId)
            ->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'المنتج غير موجود في السلة');
        }

        $cart->delete();

        return redirect()->back()->with('success', 'تم حذف المنتج من السلة');
    }

    /**
     * Clear all cart items
     */
    public function clear()
    {
        $cookieId = $this->getCookieId();

        Cart::where('cookie_id', $cookieId)->delete();

        return redirect()->route('cart.index')->with('success', 'تم تفريغ السلة بنجاح');
    }

    /**
     * Show checkout page
     */
    public function checkout()
    {
        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'السلة فارغة');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->book->price;
        });

        return view('front.cart.checkout', compact('cartItems', 'total'));
    }

    /**
     * Get or create cookie ID for guest users
     */
    protected function getCookieId()
    {
        $cookieId = Cookie::get('cart_id');

        if (!$cookieId) {
            $cookieId = Str::uuid()->toString();
            Cookie::queue('cart_id', $cookieId, 60 * 24 * 30); // 30 days
        }

        return $cookieId;
    }

    /**
     * Get cart items for current user/guest
     */
    protected function getCartItems()
    {
        $cookieId = $this->getCookieId();

        return Cart::with('book')
            ->where('cookie_id', $cookieId)
            ->get();
    }

    /**
     * Get total cart count
     */
    public function getCartCount()
    {
        $cookieId = $this->getCookieId();

        return Cart::where('cookie_id', $cookieId)->sum('quantity');
    }

    /**
     * Merge guest cart with user cart after login
     */
    public function mergeCart()
    {
        if (!Auth::check()) {
            return;
        }

        $cookieId = $this->getCookieId();
        $userId = Auth::id();

        // Update all guest cart items to logged in user
        Cart::where('cookie_id', $cookieId)
            ->whereNull('user_id')
            ->update(['user_id' => $userId]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartitem = Cart::cartCount();
        $products = Product::paginate(8);
        return view('dashboard', compact('products', 'cartitem'));
    }

    public function addToCart(Request $request)
    {
        try {
            $userID = auth()->user()->id;
            $data = [
                'user_id' => auth()->user()->id,
                'product_id' => $request->id,
            ];
            $cart = Cart::where(['user_id' => $userID, 'product_id' => $request->id])->first();
            if ($cart) {
                $cart->increment('quantity');
            } else {
                $cart = Cart::create($data);
            }
            $cartCount = cart::cartCount();
            return response()->json(['status' => true, 'message' => 'Product added successfully.', 'data' => ['count' => $cartCount]]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!!']);
        }
    }

    public function removeFromCart(Request $request)
    {
        try {
            $cartitem = Cart::where('id', $request->id)
            ->where('user_id', auth()->user()->id)
            ->first();
            if ($cartitem == null) {
                return response()->json(['status' => false, 'message' => 'Item not found']);
            }
            $cartitem->delete();
            return response()->json(['status' => true, 'message' => 'Product removed from cart successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!!']);
        }
    }

    public function updateQuantity(Request $request)
    {
        try {
            $cartitem = Cart::where('id', $request->id)
            ->where('user_id', auth()->user()->id)
            ->first();
            if ($cartitem == null) {
                return response()->json(['status' => false, 'message' => 'Item not found']);
            }
            $price = $cartitem->product->price * $request->quantity;
            $cartitem->update(['quantity' => $request->quantity]);
            $totalcartAmount = cart::totalcartAmount();
            return response()->json(['status' => true, 'message' => 'cart update successfully.','data' => ['price' => $price,'cart_total' => $totalcartAmount]]);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['status' => false, 'message' => 'Something went wrong!!']);
        }
    }

    public function cart(Request $request)
    {
        $cartitems = Cart::where('user_id', auth()->user()->id)
        ->with('product')
        ->get();
        $totalcartAmount = cart::totalcartAmount();
        return view('cart', compact('cartitems','totalcartAmount'));
    }
}

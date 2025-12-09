<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Car;

class CartController extends Controller
{
     public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->id;
        $type = $request->type; // 'car' or 'product'
        $action = $request->action; // 'add' or 'remove'

        $key = $type . '_' . $id;

        if ($action === 'add') {
            // Add item
            if (isset($cart[$key])) {
                $cart[$key]['quantity'] += 1;
            } else {
                $item = $type === 'car' ? Car::find($id) : Product::find($id);
                if(!$item) return response()->json(['status' => 'error', 'message' => 'Item not found']);

                $cart[$key] = [
                    'id' => $id,
                    'type' => $type,
                    'title' => $item->title,
                    'price' => $item->price,
                    'quantity' => 1,
                ];
            }
        } elseif ($action === 'remove') {
            // Remove item
            if(isset($cart[$key])) {
                unset($cart[$key]);
            }
        }

        session(['cart' => $cart]);

        return response()->json(['status' => 'success', 'cart_count' => count($cart)]);
    }
    // View all cart items

    public function updateQuantity(Request $request)
{
    $cart = session()->get('cart', []);
    $id = $request->id;
    $type = $request->type;
    $action = $request->action; // 'increment' or 'decrement'

    $key = $type . '_' . $id;

    if(isset($cart[$key])) {
        if($action === 'increment') {
            $cart[$key]['quantity'] += 1;
        } elseif($action === 'decrement') {
            $cart[$key]['quantity'] -= 1;
            if($cart[$key]['quantity'] <= 0) {
                unset($cart[$key]);
            }
        }
    }

    session(['cart' => $cart]);

    return response()->json([
        'status' => 'success',
        'cart' => $cart,
        'cart_count' => count($cart)
    ]);
}

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Mail\OrderPlacedMail;


use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty');
        }

        // Calculate total amount
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Create order record (pending)
        $order = Order::create([
            'name'   => $request->name,
            'email'  => $request->email,
            'address'=> $request->address,
            'items'  => json_encode($cart),
            'total_amount' => $total,
            'payment_status' => 'pending'
        ]);

        // Stripe checkout
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => 'Car Parts Purchase'],
                    'unit_amount' => $total * 100,
                ],
                'quantity' => 1
            ]],
            'mode' => 'payment',
            'success_url' => route('order.success', $order->id),
           
        ]);

        return redirect($session->url);
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);

        $order->update([
            'payment_status' => 'paid'
        ]);

        // clear cart
        session()->forget('cart');
         Mail::to($order->email)->send(new OrderPlacedMail($order));

        return view('orders.success', compact('order'));
    }

    public function downloadPdf(Order $order)
    {
        $pdf = Pdf::loadView('orders.pdf', compact('order'));
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }
}

<h2>Thank you for your order, {{ $order->name }}!</h2>

<p><strong>Email:</strong> {{ $order->email }}</p>
<p><strong>Address:</strong> {{ $order->address }}</p>

<h3>Order Items:</h3>
<ul>
@foreach(json_decode($order->items, true) as $item)
    <li>{{ $item['title'] }} × {{ $item['quantity'] }} — ${{ $item['price'] }}</li>
@endforeach
</ul>

<p><strong>Total Amount:</strong> ${{ $order->total_amount }}</p>

<p>Your invoice is also available for download on our website.</p>

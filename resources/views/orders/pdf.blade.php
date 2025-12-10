<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Invoice</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px; border: 1px solid #ccc; }
        h1 { color: green; }
    </style>
</head>
<body>

<h1>Invoice</h1>

<p><strong>Name:</strong> {{ $order->name }}</p>
<p><strong>Email:</strong> {{ $order->email }}</p>
<p><strong>Address:</strong> {{ $order->address }}</p>

<table>
    <thead>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price ($)</th>
        </tr>
    </thead>
    <tbody>
        @foreach(json_decode($order->items, true) as $item)
        <tr>
            <td>{{ $item['title'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ $item['price'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Total: ${{ $order->total_amount }}</h2>

</body>
</html>

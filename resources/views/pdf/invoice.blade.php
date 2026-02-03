<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body { font-family: sans-serif; }
        .container { width: 100%; }
        .header { margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <div class="title">INVOICE</div>
        <p>Transaction ID: {{ $transaction->id }}</p>
        <p>Date: {{ $transaction->created_at->format('d M Y') }}</p>
    </div>

    <hr>

    <p><strong>Customer:</strong> {{ $transaction->user->name }}</p>
    <p><strong>Email:</strong> {{ $transaction->user->email }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th class="text-right">Price</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $transaction->product->name }}</td>
                <td>{{ $transaction->qty }}</td>
                <td class="text-right">Rp {{ number_format($transaction->product->price, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

</div>

</body>
</html>

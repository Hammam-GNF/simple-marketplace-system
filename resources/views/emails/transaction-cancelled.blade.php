<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Transaction Cancelled</title>
</head>
<body>
    <h1>Transaction Cancelled</h1>
    <p>Hi {{ $transaction->user->name }},</p>
    <p>Your transaction for <strong>{{ $transaction->product->name }}</strong> (Qty: {{ $transaction->qty }}) has been cancelled.</p>
    <p>Status: <strong>{{ ucfirst($transaction->status) }}</strong></p>
    <p>If you have any questions, please contact our support team.</p>
    <p>Thank you.</p>
</body>
</html>

<h2>Payment Confirmed</h2>

<p>Thank you for your purchase.</p>

<p><strong>Transaction ID:</strong> {{ $transaction->id }}</p>
<p><strong>Product:</strong> {{ $transaction->product->name }}</p>
<p><strong>Quantity:</strong> {{ $transaction->qty }}</p>
<p><strong>Total Price:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>

<p>Your order has been successfully paid.</p>

<p>Best regards,<br>
The Marketplace Team</p>
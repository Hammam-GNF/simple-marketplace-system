<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            margin-bottom: 20px;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
        }

        .invoice-meta {
            text-align: right;
        }

        .section {
            margin-top: 25px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th {
            background: #f2f2f2;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .text-right {
            text-align: right;
        }

        .summary {
            margin-top: 20px;
            width: 300px;
            float: right;
        }

        .summary td {
            padding: 6px;
        }

        .status-paid {
            color: green;
            font-weight: bold;
        }

        .footer {
            margin-top: 60px;
            font-size: 10px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>

{{-- ================= HEADER ================= --}}
<table width="100%">
    <tr>
        <td>
            <div class="brand">Simple Marketplace</div>
            <div>Indonesia</div>
        </td>

        <td class="invoice-meta">
            <h2>INVOICE</h2>
            <div><strong>No:</strong> INV-{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</div>
            <div><strong>Date:</strong> {{ $transaction->created_at->format('d M Y') }}</div>
        </td>
    </tr>
</table>

<hr>

{{-- ================= CUSTOMER ================= --}}
<div class="section">
    <strong>Bill To:</strong><br>
    {{ $transaction->user->name }}<br>
    {{ $transaction->user->email }}
</div>

{{-- ================= ITEM TABLE ================= --}}
<div class="section">

    <table class="table">
        <thead>
        <tr>
            <th>Product</th>
            <th width="80">Qty</th>
            <th width="120">Unit Price</th>
            <th width="120">Total</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>{{ $transaction->product->name }}</td>
            <td class="text-right">{{ $transaction->qty }}</td>
            <td class="text-right">
                Rp {{ number_format($transaction->product->price, 0, ',', '.') }}
            </td>
            <td class="text-right">
                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
            </td>
        </tr>
        </tbody>
    </table>

</div>

{{-- ================= SUMMARY ================= --}}
<table class="summary">
    <tr>
        <td><strong>Total Payment</strong></td>
        <td class="text-right">
            Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
        </td>
    </tr>

    <tr>
        <td>Status</td>
        <td class="text-right {{ $transaction->status === 'paid' ? 'status-paid' : '' }}">
            {{ strtoupper($transaction->status) }}
        </td>

    </tr>

    @if($transaction->paid_at)
        <tr>
            <td>Paid At</td>
            <td class="text-right">
                {{ $transaction->paid_at->format('d M Y H:i') }}
            </td>
        </tr>
    @endif
</table>

<div style="clear: both;"></div>

{{-- ================= FOOTER ================= --}}
<div class="footer">
    This invoice is generated automatically by system.<br>
    Thank you for your purchase.
</div>

</body>
</html>

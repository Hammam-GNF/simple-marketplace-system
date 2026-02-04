<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Product</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Qty</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Total</th>
            <th class="px-4 py-3 text-center text-sm font-semibold">Status</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Date</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Expired Date</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Action</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-200 bg-white">
        @foreach ($transactions as $index => $transaction)
            <tr>
                <td class="px-4 py-3">
                    {{ $transactions->firstItem() + $index }}
                </td>

                <td class="px-4 py-3">
                    {{ $transaction->product->name }}
                </td>

                <td class="px-4 py-3 text-right">
                    {{ $transaction->qty }}
                </td>

                <td class="px-4 py-3 text-right">
                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                </td>

                <td class="px-4 py-3 text-center">
                    <span class="px-2 py-1 rounded text-xs
                        @if($transaction->status === 'pending')
                            bg-yellow-100 text-yellow-700
                        @elseif($transaction->status === 'awaiting_payment')
                            bg-blue-100 text-blue-700
                        @elseif($transaction->status === 'paid')
                            bg-green-100 text-green-700
                        @elseif($transaction->status === 'cancelled')
                            bg-red-100 text-red-700
                        @else
                            bg-gray-100 text-gray-600
                        @endif
                    ">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </td>

                <td class="px-4 py-3 text-right text-sm">
                    {{ $transaction->created_at->format('d M Y H:i') }}
                </td>

                <td class="px-4 py-3 text-right text-sm">
                    {{ optional($transaction->expired_at)->format('d M Y H:i') ?? '—' }}
                </td>

                <td class="px-4 py-3 text-right space-x-2">

                    <a href="{{ route('customer.transactions.show', $transaction) }}"
                    class="text-indigo-600 hover:underline text-sm">
                        View
                    </a>

                    @if ($transaction->canCancel())
                        <x-danger-button
                            x-data
                            x-on:click.prevent="$dispatch('open-modal', 'cancel-transaction-{{ $transaction->id }}')"
                        >
                            Cancel
                        </x-danger-button>

                        @include('customer.transactions.partials.cancel-transaction-modal', [
                            'transaction' => $transaction
                        ])
                    @endif

                    @if ($transaction->canPay())
                        <x-secondary-button
                            x-data
                            x-on:click.prevent="$dispatch('open-modal', 'pay-transaction-{{ $transaction->id }}')"
                        >
                            Pay
                        </x-secondary-button>

                        @include('customer.transactions.partials.pay-transaction-modal', [
                            'transaction' => $transaction
                        ])
                    @endif

                </td>

            </tr>
        @endforeach
    </tbody>
</table>

<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Product</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Qty</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Total</th>
            <th class="px-4 py-3 text-center text-sm font-semibold">Status</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Date</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Action</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-200 bg-white">
        @foreach ($transactions as $index => $transaction)
            <tr>
                <td class="px-4 py-3">
                    {{ $index + 1 }}
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
                        @elseif($transaction->status === 'paid')
                            bg-green-100 text-green-700
                        @else
                            bg-red-100 text-red-700
                        @endif
                    ">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </td>

                <td class="px-4 py-3 text-right text-sm">
                    {{ $transaction->created_at->format('d M Y H:i') }}
                </td>

                <td class="px-4 py-3 text-right">
                    @if ($transaction->status === 'pending')
                        <x-danger-button
                            x-data
                            x-on:click.prevent="$dispatch('open-modal', 'cancel-transaction-{{ $transaction->id }}')"
                        >
                            Cancel
                        </x-danger-button>

                        @include('customer.transactions.partials.cancel-transaction-modal', [
                            'transaction' => $transaction
                        ])
                    @else
                        —
                    @endif
                </td>


            </tr>
        @endforeach
    </tbody>
</table>

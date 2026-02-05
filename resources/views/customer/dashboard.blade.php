<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Customer Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="text-2xl font-bold">{{ $stats['total'] }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Pending</p>
                    <p class="text-2xl font-bold">{{ $stats['pending'] }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Paid</p>
                    <p class="text-2xl font-bold">{{ $stats['paid'] }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Cancelled</p>
                    <p class="text-2xl font-bold">{{ $stats['cancelled'] }}</p>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white p-6 rounded-lg shadow flex gap-3">
                <a href="{{ route('customer.products.index') }}"
                   class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                    Browse Products
                </a>

                <a href="{{ route('customer.transactions.index') }}"
                   class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                    My Transactions
                </a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Recent Transactions</h3>

                <table class="w-full text-sm">
                    <thead class="text-left text-gray-500 border-b">
                        <tr>
                            <th class="py-2">Product</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr class="border-b">
                                <td class="py-2">{{ $transaction->product->name }}</td>
                                <td>{{ $transaction->qty }}</td>
                                <td>Rp {{ number_format($transaction->total_price) }}</td>
                                <td class="capitalize">{{ $transaction->status }}</td>
                                <td>
                                    <a href="{{ route('customer.transactions.show', $transaction) }}"
                                       class="text-indigo-600 hover:underline">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">
                                    No transactions yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

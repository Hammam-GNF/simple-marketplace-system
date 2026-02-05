<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Users</p>
                    <p class="text-2xl font-bold">{{ $stats['users'] }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Products</p>
                    <p class="text-2xl font-bold">{{ $stats['products'] }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Pending Transactions</p>
                    <p class="text-2xl font-bold">{{ $stats['pendingTransactions'] }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Total Transactions</p>
                    <p class="text-2xl font-bold">{{ $stats['totalTransactions'] }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                        Manage Users
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                        Manage Products
                    </a>
                    <a href="{{ route('admin.transactions.index') }}" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                        View Transactions
                    </a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Recent Transactions</h3>

                <table class="w-full text-sm">
                    <thead class="text-left text-gray-500 border-b">
                        <tr>
                            <th class="py-2">Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr class="border-b">
                                <td class="py-2">{{ $transaction->user->name ?? '-' }}</td>
                                <td>Rp. {{ number_format($transaction->total_price) }}</td>
                                <td class="capitalize">{{ $transaction->status }}</td>
                                <td>
                                    <a href="{{ route('admin.transactions.show', $transaction) }}"
                                       class="text-blue-600 hover:underline">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-500">
                                    No transactions found.
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

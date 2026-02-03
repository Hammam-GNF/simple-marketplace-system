<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Transaction List
        </h2>
    </x-slot>

    <div class="py-12 space-y-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white shadow sm:rounded-lg">
            <div class="flex space-x-2 mb-6">
                @php
                    $statuses = [
                        null => 'All',
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'cancelled' => 'Cancelled',
                    ];
                @endphp

                @foreach ($statuses as $key => $label)
                    <a
                        href="{{ route('admin.transactions.index', $key ? ['status' => $key] : []) }}"
                        class="px-4 py-2 rounded text-sm font-medium
                            {{ ($currentStatus === $key || ($key === null && !$currentStatus))
                                ? 'bg-indigo-600 text-white'
                                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                            }}"
                    >
                        {{ $label }}
                    </a>
                @endforeach
            </div>
            @include('admin.transactions.partials.transaction-table')
            <div class="mt-4">
                {{ $transactions->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

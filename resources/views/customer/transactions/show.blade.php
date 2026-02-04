<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Order Detail {{ $transaction->id }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="p-6 bg-white shadow sm:rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Order Info</h3>

            <div class="grid grid-cols-2 gap-4 text-sm">

                <div>
                    <p class="text-gray-500">Status</p>
                    <span class="px-2 py-1 rounded text-xs
                        @if($transaction->status === 'pending')
                            bg-yellow-100 text-yellow-700
                        @elseif($transaction->status === 'awaiting_payment')
                            bg-blue-100 text-blue-700
                        @elseif($transaction->status === 'paid')
                            bg-green-100 text-green-700
                        @elseif($transaction->status === 'cancelled')
                            bg-red-100 text-red-700
                        @endif
                    ">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </div>

                <div>
                    <p class="text-gray-500">Created At</p>
                    {{ $transaction->created_at->format('d M Y H:i') }}
                </div>

                <div>
                    <p class="text-gray-500">Expired At</p>
                    {{ optional($transaction->expired_at)->format('d M Y H:i') ?? '—' }}
                </div>

            </div>
        </div>


        <div class="p-6 bg-white shadow sm:rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Product Info</h3>

            <div class="grid grid-cols-2 gap-4 text-sm">

                <div>
                    <p class="text-gray-500">Product</p>
                    <p class="font-medium">{{ $transaction->product->name }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Price</p>
                    Rp {{ number_format($transaction->product->price, 0, ',', '.') }}
                </div>

                <div>
                    <p class="text-gray-500">Quantity</p>
                    {{ $transaction->qty }}
                </div>

                <div>
                    <p class="text-gray-500">Total</p>
                    <p class="font-semibold">
                        Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                    </p>
                </div>

            </div>
        </div>


        <div class="flex justify-end space-x-3">

            @if ($transaction->canCancel())
                <form method="POST"
                      action="{{ route('customer.transactions.cancel', $transaction) }}">
                    @csrf
                    @method('PATCH')

                    <x-danger-button>
                        Cancel Order
                    </x-danger-button>
                </form>
            @endif

            @if ($transaction->canPay())
                <form method="POST"
                      action="{{ route('customer.transactions.pay', $transaction) }}">
                    @csrf
                    @method('PATCH')

                    <x-secondary-button type="submit">
                        Pay Now
                    </x-secondary-button>
                </form>
            @endif

            @if ($transaction->status === 'paid')
                <p class="text-sm text-gray-500">
                    Invoice will be sent by admin after payment confirmation.
                </p>
            @endif

        </div>

    </div>
</x-app-layout>

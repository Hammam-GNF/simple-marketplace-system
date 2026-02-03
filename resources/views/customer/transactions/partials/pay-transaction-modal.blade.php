<x-modal name="pay-transaction-{{ $transaction->id }}" focusable>
    <form
        method="POST"
        action="{{ route('customer.transactions.pay', $transaction) }}"
        class="p-6 space-y-4"
    >
        @csrf
        @method('PATCH')

        <h2 class="text-lg font-semibold text-gray-900">
            Payment Instruction
        </h2>

        <div class="text-sm text-gray-700 space-y-2">
            <p>
                You are about to proceed with payment for:
                <span class="font-semibold">{{ $transaction->product->name }}</span>
            </p>

            <p>
                <span class="font-medium">Total Amount:</span>
                <span class="font-semibold">
                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                </span>
            </p>

            <p>
                Please transfer the amount to the following account:
            </p>

            <ul class="ml-4 list-disc text-gray-600">
                <li>Bank: BCA</li>
                <li>Account Number: 1234567890</li>
                <li>Account Name: Demo Marketplace</li>
            </ul>

            <p class="text-xs text-gray-500">
                After payment, please wait for admin confirmation.
            </p>
        </div>

        <div class="flex justify-end space-x-2 pt-4">
            <x-secondary-button
                type="button"
                x-on:click="$dispatch('close')"
            >
                Cancel
            </x-secondary-button>

            <x-primary-button>
                I Have Paid
            </x-primary-button>
        </div>
    </form>
</x-modal>

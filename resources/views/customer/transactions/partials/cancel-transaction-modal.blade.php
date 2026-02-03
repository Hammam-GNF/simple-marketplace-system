<x-modal name="cancel-transaction-{{ $transaction->id }}" focusable>
    <form
        method="POST"
        action="{{ route('customer.transactions.cancel', $transaction) }}"
        class="p-6"
    >
        @csrf
        @method('PATCH')

        <h2 class="text-lg font-medium text-gray-900">
            Cancel Transaction
        </h2>

        <p class="mt-3 text-sm text-gray-600">
            Are you sure you want to cancel this transaction for
            <span class="font-semibold">
                {{ $transaction->product->name }}
            </span>?
            <br>
            This action cannot be undone.
        </p>

        <div class="mt-6 flex justify-end">
            <x-secondary-button
                type="button"
                x-on:click="$dispatch('close')"
            >
                No
            </x-secondary-button>

            <x-danger-button class="ml-3">
                Yes, Cancel
            </x-danger-button>
        </div>
    </form>
</x-modal>

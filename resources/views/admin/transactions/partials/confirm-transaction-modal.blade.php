<x-modal name="confirm-transaction-{{ $transaction->id }}" focusable>
    <form
        method="POST"
        action="{{ route('admin.transactions.update', $transaction) }}"
        class="p-6"
    >
        @csrf
        @method('PUT')

        <h2 class="text-lg font-semibold">
            Confirm Payment
        </h2>

        <p class="mt-3 text-sm text-gray-600">
            Confirm payment for
            <span class="font-semibold">
                {{ $transaction->product->name }}
            </span>
            by
            <span class="font-semibold">
                {{ $transaction->user->name }}
            </span>?
        </p>

        <input type="hidden" name="status" value="paid">

        <div class="mt-6 flex justify-end space-x-2">
            <x-secondary-button
                type="button"
                x-on:click="$dispatch('close')"
            >
                Cancel
            </x-secondary-button>

            <x-primary-button>
                Confirm
            </x-primary-button>
        </div>
    </form>
</x-modal>

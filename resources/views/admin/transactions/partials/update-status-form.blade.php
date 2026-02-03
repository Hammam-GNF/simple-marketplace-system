<x-modal name="update-status-{{ $transaction->id }}" focusable>
    <form
        method="POST"
        action="{{ route('admin.transactions.update', $transaction) }}"
        class="p-6"
    >
        @csrf
        @method('PUT')

        <h2 class="text-lg font-semibold mb-4">
            Update Transaction Status
        </h2>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Status
            </label>

            <select
                name="status"
                class="w-full rounded-md border-gray-300 text-sm"
                required
            >
                <option value="pending" @selected($transaction->status === 'pending')>
                    Pending
                </option>

                <option value="paid" @selected($transaction->status === 'paid')>
                    Paid
                </option>

                <option value="cancelled" @selected($transaction->status === 'cancelled')>
                    Cancelled
                </option>
            </select>
        </div>

        <div class="flex justify-end space-x-2">
            <x-secondary-button
                type="button"
                x-on:click="$dispatch('close')"
            >
                Cancel
            </x-secondary-button>

            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</x-modal>

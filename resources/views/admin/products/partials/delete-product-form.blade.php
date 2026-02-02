<x-modal name="delete-product-{{ $product->id }}" focusable>
    <form method="post" action="{{ route('admin.products.destroy', $product) }}" class="p-6">
        @csrf
        @method('DELETE')

        <h2 class="text-lg font-medium text-gray-900">
            Delete Product
        </h2>

        <p class="mt-3 text-sm text-gray-600">
            Are you sure you want to delete
            <span class="font-semibold">{{ $product->name }}</span>?
            This action cannot be undone.
        </p>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                Cancel
            </x-secondary-button>

            <x-danger-button class="ml-3">
                Delete
            </x-danger-button>
        </div>
    </form>
</x-modal>

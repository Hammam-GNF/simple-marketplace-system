<x-modal name="delete-shop-product-{{ $shopProduct->id }}" focusable>
    <form method="post" action="{{ route('admin.shop-products.destroy', $shopProduct) }}" class="p-6">
        @csrf
        @method('DELETE')

        <h2 class="text-lg font-medium text-gray-900">
            Delete Shop Product
        </h2>

        <p class="mt-3 text-sm text-gray-600">
            Remove 
            <span class="font-semibold">{{ $shopProduct->product->name }}</span>
            from 
            <span class="font-semibold">{{ $shopProduct->shop->name }}</span>?
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

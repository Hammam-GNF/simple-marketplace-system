<x-modal name="edit-shop-product-{{ $shopProduct->id }}" focusable>
    <form method="post" action="{{ route('admin.shop-products.update', $shopProduct) }}" class="p-6">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-medium text-gray-900">
            Edit Product
        </h2>
        
        <div class="mt-4">
            <x-input-label value="Shop" />
            <select
                name="shop_id"
                class="mt-1 block w-full rounded-md border-gray-300"
                required
            >
                <option value="">-- Select Shop --</option>
                @foreach ($shops as $shopOption)
                    <option value="{{ $shopOption->id }}"
                        @selected(old('shop_id', $shopProduct->shop_id) == $shopOption->id)>
                        {{ $shopOption->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <x-input-label value="Product" />
            <select
                name="product_id"
                class="mt-1 block w-full rounded-md border-gray-300"
                required
            >
                <option value="">-- Select Product --</option>
                @foreach ($products as $productOption)
                    <option value="{{ $productOption->id }}" 
                        @selected(old('product_id', $shopProduct->product_id) == $productOption->id)>
                        {{ $productOption->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mt-4">
            <x-input-label value="Description" />
            <x-text-input
                id="description"
                name="description"
                type="text"
                class="mt-1 block w-full"
                value="{{ old('description', $shopProduct->description) }}"
            />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                Cancel
            </x-secondary-button>

            <x-primary-button class="ml-3">
                Update
            </x-primary-button>
        </div>
    </form>
</x-modal>

<x-modal name="edit-product-{{ $product->id }}" focusable>
    <form method="post" action="{{ route('admin.products.update', $product) }}" class="p-6">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-medium text-gray-900">
            Edit Product
        </h2>

        <div class="mt-4">
            <x-input-label for="name-{{ $product->id }}" value="Name" />
            <x-text-input
                id="name-{{ $product->id }}"
                name="name"
                type="text"
                class="mt-1 block w-full"
                value="{{ old('name', $product->name) }}"
                required
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description-{{ $product->id }}" value="Description" />
            <x-text-input
                id="description-{{ $product->id }}"
                name="description"
                type="text"
                class="mt-1 block w-full"
                value="{{ old('description', $product->description) }}"
            />
        </div>

        <div class="mt-4">
            <x-input-label for="price-{{ $product->id }}" value="Price" />

            <div class="mt-1 flex rounded-md shadow-sm">
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    Rp
                </span>

                <x-text-input
                    id="price-{{ $product->id }}"
                    name="price"
                    type="text"
                    step="1"
                    min="0"
                    class="rounded-none rounded-r-md block w-full"
                    value="{{ old('price', number_format($product->price, 0, '', '.')) }}"
                    required
                    oninput="formatRupiah(this)"
                />
            </div>
        </div>


        <div class="mt-4">
            <x-input-label for="stock-{{ $product->id }}" value="Stock" />
            <x-text-input
                id="stock-{{ $product->id }}"
                name="stock"
                type="number"
                class="mt-1 block w-full"
                value="{{ old('stock', $product->stock) }}"
            />
        </div>

        <div class="mt-4">
            <x-input-label for="category_id-{{ $product->id }}" value="Category" />
            <select
                id="category_id-{{ $product->id }}"
                name="category_id"
                class="mt-1 block w-full rounded-md border-gray-300"
                required
            >
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
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

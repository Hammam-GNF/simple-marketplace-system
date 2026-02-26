<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Create Shop Products
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Add a new Shop Product to the system.
        </p>
    </header>

    <form method="POST" action="{{ route('admin.shop-products.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="shop_id" value="Shop" />
            <select
                name="shop_id"
                class="mt-1 block w-full rounded-md border-gray-300"
                required
            >
                <option value="">-- Select Shop --</option>
                @foreach ($shops as $shop)
                    <option value="{{ $shop->id }}"
                        @selected(old('shop_id') == $shop->id)>
                        {{ $shop->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('shop_id')" />
        </div>

        <div>
            <x-input-label for="product_id" value="Product" />
            <input
                type="text"
                id="productSearch"
                placeholder="Search product..."
                class="mb-4 w-full border-gray-300 rounded-md"
            />
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4 max-h-96 overflow-y-auto border rounded-lg p-4">

            @foreach ($products as $product)
                <label class="border rounded-lg p-4 cursor-pointer hover:shadow transition flex gap-3 items-start">

                    <input
                        type="checkbox"
                        name="product_id[]"
                        value="{{ $product->id }}"
                        class="mt-1 rounded border-gray-300"
                        @checked(collect(old('product_id'))->contains($product->id))
                    >

                    <div class="flex-1">
                        <div class="font-semibold text-gray-800">
                            {{ $product->name }}
                        </div>

                        @if($product->price ?? false)
                            <div class="text-sm text-gray-500">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        @endif

                        @if($product->description ?? false)
                            <div class="text-xs text-gray-400 mt-1 line-clamp-2">
                                {{ Str::limit($product->description, 60) }}
                            </div>
                        @endif
                    </div>

                </label>
            @endforeach
            <x-input-error class="mt-2" :messages="$errors->get('product_id')" />
        </div>

        <div>
            <x-input-label for="description" value="Description" />
            <textarea
                name="description"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            >{{ old('description') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
    <script>
        document.getElementById('productSearch').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            document.querySelectorAll('[name="product_id[]"]').forEach(function(checkbox) {
                let label = checkbox.closest('label');
                let text = label.innerText.toLowerCase();
                label.style.display = text.includes(value) ? '' : 'none';
            });
        });
    </script>
</section>

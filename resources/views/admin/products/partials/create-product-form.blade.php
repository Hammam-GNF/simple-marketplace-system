<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Create Product
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Add a new product to the system.
        </p>
    </header>

    <form method="POST" action="{{ route('admin.products.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="name" value="Product Name" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                value="{{ old('name') }}"
                required
                autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="description" value="Description" />
            <textarea
                id="description"
                name="description"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            >{{ old('description') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="price" value="Price" />

            <div class="mt-1 flex rounded-md shadow-sm">
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    Rp
                </span>

                <x-text-input
                    id="price"
                    name="price"
                    type="text"
                    step="1"
                    min="0"
                    class="rounded-none rounded-r-md block w-full"
                    value="{{ old('price') }}"
                    required
                    oninput="formatRupiah(this)"
                />
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('price')" />
        </div>


        <div>
            <x-input-label for="stock" value="Stock" />
            <x-text-input
                id="stock"
                name="stock"
                type="number"
                class="mt-1 block w-full"
                value="{{ old('stock') }}"
                required
            />
            <x-input-error class="mt-2" :messages="$errors->get('stock')" />
        </div>

        <div>
            <x-input-label for="category_id" value="Category" />
            <select
                id="category_id"
                name="category_id"
                class="mt-1 block w-full rounded-md border-gray-300"
                required
            >
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</section>


<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Name</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Description</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Category</th>
                <th class="px-4 py-3 text-right text-sm font-semibold">Price</th>
                <th class="px-4 py-3 text-right text-sm font-semibold">Stock</th>
                <th class="px-4 py-3 text-right text-sm font-semibold">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 bg-white">
            @foreach ($products as $index => $product)
                <tr>
                    <td class="px-4 py-3">{{ $products->firstItem() + $index }}</td>
                    <td class="px-4 py-3">{{ $product->name }}</td>
                    <td class="px-4 py-3">{{ $product->description }}</td>
                    <td class="px-4 py-3">{{ $product->category->name }}</td>
                    <td class="px-4 py-3 text-right">{{ $product->getFormattedPriceAttribute() }}</td>
                    <td class="px-4 py-3 text-right">{{ $product->stock }}</td>
                    <td class="px-4 py-3 text-right space-x-2">

                        <!-- Edit -->
                        <x-secondary-button
                            x-data
                            x-on:click.prevent="$dispatch('open-modal', 'edit-product-{{ $product->id }}')"
                        >
                            Edit
                        </x-secondary-button>

                        <!-- Delete -->
                        <x-danger-button
                            x-data
                            x-on:click.prevent="$dispatch('open-modal', 'delete-product-{{ $product->id }}')"
                        >
                            Delete
                        </x-danger-button>

                        {{-- MODALS --}}
                        @include('admin.products.partials.update-product-form', ['product' => $product])
                        @include('admin.products.partials.delete-product-form', ['product' => $product])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
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

                    @if ($product->stock > 0)
                        <form
                            method="POST"
                            action="{{ route('customer.transactions.store') }}"
                            class="inline-flex items-center space-x-2"
                        >
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <input
                                type="number"
                                name="qty"
                                min="1"
                                max="{{ $product->stock }}"
                                value="1"
                                class="w-16 rounded border-gray-300 text-sm"
                                required
                            >

                            <x-primary-button>
                                Buy
                            </x-primary-button>
                        </form>
                    @else
                        <span class="text-sm text-red-500">Out of stock</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

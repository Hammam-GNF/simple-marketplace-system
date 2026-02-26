<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Shop</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Product</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Description</th>
                <th class="px-4 py-3 text-right text-sm font-semibold">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 bg-white">
            @php $no = $shopProducts->firstItem(); @endphp
            @foreach ($shopProducts as $shopProduct)
                <tr>
                    <td class="px-4 py-3">{{ $no++ }}</td>
                    <td class="px-4 py-3">{{ $shopProduct->shop->name }}</td>
                    <td class="px-4 py-3">{{ $shopProduct->product->name }}</td>
                    <td class="px-4 py-3">{{ $shopProduct->description }}</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end items-center gap-2">

                            <x-secondary-button
                                x-data
                                x-on:click.prevent="$dispatch('open-modal', 'edit-shop-product-{{ $shopProduct->id }}')"
                            >
                                Edit
                            </x-secondary-button>

                            <x-danger-button
                                x-data
                                x-on:click.prevent="$dispatch('open-modal', 'delete-shop-product-{{ $shopProduct->id }}')"
                            >
                                Delete
                            </x-danger-button>

                        </div>

                        @include('admin.shop-products.partials.update-shop-product-form', ['shopProduct' => $shopProduct])
                        @include('admin.shop-products.partials.delete-shop-product-form', ['shopProduct' => $shopProduct])
                    </td>
                </tr>
            @endforeach
            @if($shops->isEmpty())
                <tr>
                    <td colspan="5" class="px-4 py-3 text-center text-sm text-gray-500">
                        No shop products found.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
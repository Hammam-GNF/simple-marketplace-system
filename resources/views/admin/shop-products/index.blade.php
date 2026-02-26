<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Shop Products
        </h2>
    </x-slot>

    <div class="py-12 space-y-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white shadow sm:rounded-lg">
            @include('admin.shop-products.partials.create-shop-product-form')
        </div>
        <div class="p-6 bg-white shadow sm:rounded-lg">
            @include('admin.shop-products.partials.shop-products-table')
        </div>
        <div class="mt-4">
            {{ $shopProducts->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
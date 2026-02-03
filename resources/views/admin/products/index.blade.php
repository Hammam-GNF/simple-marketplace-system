<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Product Management
        </h2>
    </x-slot>

    <div class="py-12 space-y-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white shadow sm:rounded-lg">
            @include('admin.products.partials.create-product-form')
        </div>
        <div class="p-6 bg-white shadow sm:rounded-lg">
            @include('admin.products.partials.products-table')
            <div class="mt-4">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function formatRupiah(input) {
    let value = input.value.replace(/\D/g, '');

    input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

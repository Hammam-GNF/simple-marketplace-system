<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Category Management
        </h2>
    </x-slot>

    <div class="py-12 space-y-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Create --}}
        <div class="p-6 bg-white shadow sm:rounded-lg">
            @include('admin.categories.partials.create-category-form')
        </div>

        {{-- Table --}}
        <div class="p-6 bg-white shadow sm:rounded-lg">
            @include('admin.categories.partials.categories-table')
        </div>

    </div>
</x-app-layout>

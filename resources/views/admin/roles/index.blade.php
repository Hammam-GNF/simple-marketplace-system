<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Role Management
        </h2>
    </x-slot>

    <div class="py-12 space-y-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Create --}}
        <div class="p-6 bg-white shadow sm:rounded-lg">
            @include('admin.roles.partials.create-role-form')
        </div>

        {{-- Table --}}
        <div class="p-6 bg-white shadow sm:rounded-lg">
            @include('admin.roles.partials.roles-table')
        </div>

    </div>
</x-app-layout>

<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Name</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Description</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Action</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-200 bg-white">
        @foreach ($categories as $index => $category)
            <tr>
                <td class="px-4 py-3">{{ $categories->firstItem() + $index }}</td>
                <td class="px-4 py-3">{{ $category->name }}</td>
                <td class="px-4 py-3">{{ $category->description }}</td>
                <td class="px-4 py-3 text-right space-x-2">

                    <!-- Edit -->
                    <x-secondary-button
                        x-data
                        x-on:click.prevent="$dispatch('open-modal', 'edit-category-{{ $category->id }}')"
                    >
                        Edit
                    </x-secondary-button>

                    <!-- Delete -->
                    <x-danger-button
                        x-data
                        x-on:click.prevent="$dispatch('open-modal', 'delete-category-{{ $category->id }}')"
                    >
                        Delete
                    </x-danger-button>

                    {{-- MODALS --}}
                    @include('admin.categories.partials.update-category-form', ['category' => $category])
                    @include('admin.categories.partials.delete-category-form', ['category' => $category])
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

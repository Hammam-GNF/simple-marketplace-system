<x-modal name="delete-category-{{ $category->id }}" focusable>
    <form method="post" action="{{ route('admin.categories.destroy', $category) }}" class="p-6">
        @csrf
        @method('DELETE')

        <h2 class="text-lg font-medium text-gray-900">
            Delete Category
        </h2>

        <p class="mt-3 text-sm text-gray-600">
            Are you sure you want to delete
            <span class="font-semibold">{{ $category->name }}</span>?
            This action cannot be undone.
        </p>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                Cancel
            </x-secondary-button>

            <x-danger-button class="ml-3">
                Delete
            </x-danger-button>
        </div>
    </form>
</x-modal>

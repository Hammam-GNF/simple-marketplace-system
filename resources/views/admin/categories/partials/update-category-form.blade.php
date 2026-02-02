<x-modal name="edit-category-{{ $category->id }}" focusable>
    <form method="post" action="{{ route('admin.categories.update', $category) }}" class="p-6">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-medium text-gray-900">
            Edit Category
        </h2>

        <div class="mt-4">
            <x-input-label for="name-{{ $category->id }}" value="Name" />
            <x-text-input
                id="name-{{ $category->id }}"
                name="name"
                type="text"
                class="mt-1 block w-full"
                value="{{ old('name', $category->name) }}"
                required
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description-{{ $category->id }}" value="Description" />
            <x-text-input
                id="description-{{ $category->id }}"
                name="description"
                type="text"
                class="mt-1 block w-full"
                value="{{ old('description', $category->description) }}"
            />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                Cancel
            </x-secondary-button>

            <x-primary-button class="ml-3">
                Update
            </x-primary-button>
        </div>
    </form>
</x-modal>

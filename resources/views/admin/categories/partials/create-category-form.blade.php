<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Create Category
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Add a new category to the system.
        </p>
    </header>

    <form method="POST" action="{{ route('admin.categories.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="name" value="Category Name" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                value="{{ old('name') }}"
                required
                autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="description" value="Description" />
            <textarea
                id="description"
                name="description"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            >{{ old('description') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</section>

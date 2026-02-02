<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Create Role
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Add a new role to the system.
        </p>
    </header>

    <form method="POST" action="{{ route('admin.roles.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="name" value="Role Name" />
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

        <div class="flex items-center gap-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</section>

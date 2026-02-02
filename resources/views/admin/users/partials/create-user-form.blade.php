<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Create User
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Add a new user to the system.
        </p>
    </header>

    <form method="POST" action="{{ route('admin.users.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="name" value="User Name" />
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
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                value="{{ old('email') }}"
                required
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-full"
                required
                autocomplete="new-password"
            />
            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                required
            />
        </div>

        <div>
            <x-input-label for="role_id" value="Role" />
            <select
                id="role_id"
                name="role_id"
                class="mt-1 block w-full rounded-md border-gray-300"
                required
            >
                <option value="">-- Select Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('role_id')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</section>

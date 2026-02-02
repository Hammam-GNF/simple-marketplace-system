<x-modal name="edit-user-{{ $user->id }}" focusable>
    <form method="post" action="{{ route('admin.users.update', $user) }}" class="p-6">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-medium text-gray-900">
            Edit User
        </h2>

        <div class="mt-4">
            <x-input-label for="name-{{ $user->id }}" value="Name" />
            <x-text-input
                id="name-{{ $user->id }}"
                name="name"
                type="text"
                class="mt-1 block w-full"
                value="{{ old('name', $user->name) }}"
                required
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

         <div class="mt-4">
            <x-input-label for="email-{{ $user->id }}" value="Email" />
            <x-text-input
                id="email-{{ $user->id }}"
                name="email"
                type="email"
                class="mt-1 block w-full"
                value="{{ old('email', $user->email) }}"
                required
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password-{{ $user->id }}" value="Password (optional)" />
            <x-text-input
                id="password-{{ $user->id }}"
                name="password"
                type="password"
                class="mt-1 block w-full"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation-{{ $user->id }}" value="Confirm Password" />
            <x-text-input
                id="password_confirmation-{{ $user->id }}"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full"
            />
        </div>

        <div class="mt-4">
            <x-input-label for="role_id-{{ $user->id }}" value="Role" />
            <select
                id="role_id-{{ $user->id }}"
                name="role_id"
                class="mt-1 block w-full rounded-md border-gray-300"
                required
            >
                @foreach ($roles as $role)
                    <option
                        value="{{ $role->id }}"
                        @selected(old('role_id', $user->role_id) == $role->id)
                    >
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('role_id')" />
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

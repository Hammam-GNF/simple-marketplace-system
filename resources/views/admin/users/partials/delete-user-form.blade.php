<x-modal name="delete-user-{{ $user->id }}" focusable>
    <form method="post" action="{{ route('admin.users.destroy', $user) }}" class="p-6">
        @csrf
        @method('DELETE')

        <h2 class="text-lg font-medium text-gray-900">
            Delete User
        </h2>

        <p class="mt-3 text-sm text-gray-600">
            Are you sure you want to delete
            <span class="font-semibold">{{ $user->name }}</span>?
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

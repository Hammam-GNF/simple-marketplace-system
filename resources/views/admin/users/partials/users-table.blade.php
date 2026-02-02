<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Name</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Email</th>
            <th class="px-4 py-3 text-left text-sm font-semibold">Role</th>
            <th class="px-4 py-3 text-right text-sm font-semibold">Action</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-200 bg-white">
        @foreach ($users as $index => $user)
            <tr>
                <td class="px-4 py-3">{{ $index + 1 }}</td>
                <td class="px-4 py-3">{{ $user->name }}</td>
                <td class="px-4 py-3">{{ $user->email }}</td>
                <td class="px-4 py-3">{{ $user->role->name }}</td>
                <td class="px-4 py-3 text-right space-x-2">

                    <!-- Edit -->
                    <x-secondary-button
                        x-data
                        x-on:click.prevent="$dispatch('open-modal', 'edit-user-{{ $user->id }}')"
                    >
                        Edit
                    </x-secondary-button>

                    <!-- Delete -->
                    <x-danger-button
                        x-data
                        x-on:click.prevent="$dispatch('open-modal', 'delete-user-{{ $user->id }}')"
                    >
                        Delete
                    </x-danger-button>

                    {{-- MODALS --}}
                    @include('admin.users.partials.update-user-form', ['user' => $user])
                    @include('admin.users.partials.delete-user-form', ['user' => $user])
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

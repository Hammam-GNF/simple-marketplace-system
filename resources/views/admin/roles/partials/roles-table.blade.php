<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                <th class="px-4 py-3 text-left text-sm font-semibold">Name</th>
                <th class="px-4 py-3 text-right text-sm font-semibold">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 bg-white">
            @foreach ($roles as $index => $role)
                <tr>
                    <td class="px-4 py-3">{{ $roles->firstItem() + $index }}</td>
                    <td class="px-4 py-3">{{ $role->name }}</td>
                    <td class="px-4 py-3">{{ $role->description }}</td>
                    <td class="px-4 py-3 text-right space-x-2">

                        <!-- Edit -->
                        <x-secondary-button
                            x-data
                            x-on:click.prevent="$dispatch('open-modal', 'edit-role-{{ $role->id }}')"
                        >
                            Edit
                        </x-secondary-button>

                        <!-- Delete -->
                        <x-danger-button
                            x-data
                            x-on:click.prevent="$dispatch('open-modal', 'delete-role-{{ $role->id }}')"
                        >
                            Delete
                        </x-danger-button>

                        {{-- MODALS --}}
                        @include('admin.roles.partials.update-role-form', ['role' => $role])
                        @include('admin.roles.partials.delete-role-form', ['role' => $role])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

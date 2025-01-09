<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Role Management') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

            @if (session('success'))
                <div class="alert alert-success mb-4">
                    <div class="bg-green-100 text-green-800 p-4 rounded">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table id="role-management-table" class="table-auto w-full border-collapse dark:bg-gray-700">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-gray-600 dark:text-gray-300">#</th>
                            <th class="px-4 py-2 text-gray-600 dark:text-gray-300">User Name</th>
                            <th class="px-4 py-2 text-gray-600 dark:text-gray-300">Email</th>
                            <th class="px-4 py-2 text-gray-600 dark:text-gray-300">Roles</th>
                            <th class="px-4 py-2 text-gray-600 dark:text-gray-300 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-4 py-2 text-gray-600 dark:text-gray-300">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-gray-600 dark:text-gray-300">{{ $user->name }}</td>
                                <td class="px-4 py-2 text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
                                <td class="px-4 py-2">
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="badge bg-info text-gray-600 dark:text-gray-600 text-xs px-2 py-1 rounded bg-gray-200 dark:bg-gray-300">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2">
                                    <!-- Edit Button -->
                                    <button
                                        class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-3 py-1 text-center me-2 mb-2 dark:focus:ring-yellow-900"
                                        onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', {{ $user->roles->pluck('id') }})">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div id="editRoleModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center">
        <div class="bg-white rounded shadow p-6 w-1/3">
            <h2 class="text-lg font-bold mb-4">Edit Roles for <span id="modalUserName"></span></h2>
            <form action="{{ route('role.update') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" id="modalUserId">

                <div class="mb-4">
                    @foreach ($roles as $role)
                        <label class="block">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}" id="roleCheckbox_{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    @endforeach
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="closeEditModal()"
                        class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(userId, userName, userRoles) {
            // Set user details in the modal
            document.getElementById('modalUserId').value = userId;
            document.getElementById('modalUserName').textContent = userName;
    
            // Reset checkboxes
            document.querySelectorAll('[id^=roleCheckbox_]').forEach(checkbox => checkbox.checked = false);
    
            // Check the user's current roles
            userRoles.forEach(roleId => {
                const checkbox = document.getElementById(`roleCheckbox_${roleId}`);
                if (checkbox) checkbox.checked = true;
            });
    
            // Show modal
            const modal = document.getElementById('editRoleModal');
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }
    
        function closeEditModal() {
            const modal = document.getElementById('editRoleModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    
        window.addEventListener('DOMContentLoaded', () => {
            $('#role-management-table').DataTable();
        });
    </script>
    
</x-app-layout>
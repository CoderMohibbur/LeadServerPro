<x-app-layout>
    <x-slot name="header">
        <div class=" flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Roles Dashboard') }}
            </h2>
            <a href="{{ route('roles.create') }}"
                class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                Create
            </a>
        </div>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            {{-- <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        Total Roles: {{ $roles->count() }}
                    </p>
                </div>
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        Total Permissions: {{ $permissions->count() }}
                    </p>
                </div>
            </div> --}}

            @if (session('success'))
                <div class="alert alert-success mb-4">
                    <div class="bg-green-100 text-green-800 p-4 rounded">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table id="role-table" class="table-auto w-full border-collapse dark:bg-gray-700">
                    <thead>
                        <tr>
                            <th
                                class="px-4 py-2 text-gray-600 dark:text-gray-300">
                                #</th>
                            <th
                                class="px-4 py-2 text-gray-600 dark:text-gray-300">
                                Role Name</th>
                            <th
                                class="px-4 py-2 text-gray-600 dark:text-gray-300">
                                Permissions</th>
                            <th
                                class="px-4 py-2 text-gray-600 dark:text-gray-300 text-center">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td
                                    class="px-4 py-2   text-gray-600 dark:text-gray-300">
                                    {{ $loop->iteration }}</td>
                                <td
                                    class="px-4 py-2   text-gray-600 dark:text-gray-300">
                                    {{ $role->name }}</td>
                                <td class="px-4 py-2  ">
                                    @foreach ($role->permissions as $permission)
                                        <span
                                            class="badge bg-info text-gray-600 dark:text-gray-600 text-xs px-2 py-1 rounded bg-gray-200 dark:bg-gray-300">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2  ">
                                    {{-- <!-- Edit Button -->
                                    <a href="{{ route('roles.edit', $role->id) }}"
                                       class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-3 py-1  text-center me-2 mb-2 dark:focus:ring-yellow-900">Edit</a> --}}

                                    <!-- Delete Form -->
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="delete-btn text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-3 py-1 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                onclick="return confirm('Are you sure you want to delete this role?')">
                                                Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
           window.addEventListener('DOMContentLoaded', () => {
            $('#role-table').DataTable({

            });
        });
    </script>
</x-app-layout>

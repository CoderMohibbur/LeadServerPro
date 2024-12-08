<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="grid grid-cols-3 gap-4 mb-4">
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
                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        Add Role
                    </p>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success mb-4">
                    <div class="bg-green-100 text-green-800 p-4 rounded">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-200 dark:border-gray-700">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-300">#</th>
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-300">Role Name</th>
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-300">Permissions</th>
                            <th class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-300">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-300">{{ $role->name }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                    @foreach($role->permissions as $permission)
                                        <span class="badge bg-info text-gray-600 dark:text-gray-300 text-xs px-2 py-1 rounded">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                    <a href="#" class="btn btn-warning btn-sm text-gray-600 dark:text-gray-300">Edit</a>
                                    <form action="#" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm text-gray-600 dark:text-gray-300">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

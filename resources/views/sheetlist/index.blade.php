<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sheet Lists') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            
            <!-- Title and Action Button -->
            <div class="mb-6 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Sheet Lists</h1>
                <a href="{{ route('sheet-lists.create') }}" class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                    Create New Sheet
                </a>
            </div>
    
            <!-- Table Section -->
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="px-4 py-2 text-left text-gray-600 font-semibold dark:text-gray-300">File</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-semibold dark:text-gray-300">Working Date</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-semibold dark:text-gray-300">Sheet Name</th>
                        <th class="px-4 py-2 text-left text-gray-600 font-semibold dark:text-gray-300">Client</th>
                        <th class="px-4 py-2 text-center text-gray-600 font-semibold dark:text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sheetLists as $sheetList)
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $sheetList->file }}</td>
                            <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $sheetList->sheet_working_date }}</td>
                            <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $sheetList->sheet_name }}</td>
                            <td class="px-4 py-3 text-gray-800 dark:text-gray-200">{{ $sheetList->client->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('sheet-lists.show', $sheetList->id) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-300 dark:hover:text-blue-500 transition duration-200">View</a>
                                <span class="mx-2">|</span>
                                <a href="{{ route('sheet-lists.edit', $sheetList->id) }}" class="text-yellow-500 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-600 transition duration-200">Edit</a>
                                <span class="mx-2">|</span>
                                <form action="{{ route('sheet-lists.destroy', $sheetList->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-500 hover:text-red-700 dark:text-red-300 dark:hover:text-red-500 transition duration-200">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>    
    
</x-app-layout>

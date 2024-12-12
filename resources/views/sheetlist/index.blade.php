<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('sheet-list') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <h1>Sheet Lists</h1>
        <a href="{{ route('sheet-lists.create') }}">Create New Sheet</a>

        <table>
            <thead>
                <tr>
                    <th>File</th>
                    <th>Working Date</th>
                    <th>Sheet Name</th>
                    <th>Client</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sheetLists as $sheetList)
                    <tr>
                        <td>{{ $sheetList->file }}</td>
                        <td>{{ $sheetList->sheet_working_date }}</td>
                        <td>{{ $sheetList->sheet_name }}</td>
                        <td>{{ $sheetList->client->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('sheet-lists.show', $sheetList->id) }}">View</a>
                            <a href="{{ route('sheet-lists.edit', $sheetList->id) }}">Edit</a>
                            <form action="{{ route('sheet-lists.destroy', $sheetList->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

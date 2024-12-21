<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-left">
            {{ __('All Sheets List') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <!-- Move the button to the right with spacing -->
        <div class="mb-4 flex justify-end space-x-4">
            <a href="{{ route('sheets.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                Create New Sheet
            </a>
        </div>

        <!-- Data Table -->
        <table id="sheetTable" class="table-auto w-full border-collapse dark:border-gray-700">
            <thead>
                <tr>
                    <th class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">File</th>
                    <th class="px-4 py-2 border dark:border-gray-600 text-green-800 dark:text-green-400 font-bold text-center">Sheet Name</th>
                    <th class="px-4 py-2 border dark:border-gray-600 text-yellow-800 dark:text-yellow-400 font-bold text-center">Working Date</th>
                    <th class="px-4 py-2 border dark:border-gray-600 text-purple-800 dark:text-purple-400 font-bold text-center">Client Name</th>
                    <th class="px-4 py-2 border dark:border-gray-600 text-red-800 dark:text-red-400 font-bold text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sheets as $sheet)
                    <tr class="dark:bg-gray-900 text-center">
                        <td class="px-4 py-2 border dark:border-gray-600 dark:text-gray-300">
                            @if($sheet->file)
                                <a href="{{ asset('storage/' . $sheet->file) }}" target="_blank" class="text-blue-500 hover:underline dark:text-blue-400">Open File</a>
                            @else
                                <span class="text-gray-500 dark:text-gray-400">No file available</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border dark:border-gray-600 dark:text-gray-300">{{ $sheet->sheet_name }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600 dark:text-gray-300">{{ $sheet->sheet_working_date }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600 dark:text-gray-300">{{ $sheet->user->name }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600 dark:text-gray-300">
                            <form action="{{ route('sheets.destroy', $sheet) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<script>
window.addEventListener('DOMContentLoaded', () => {
    $('#sheetTable').DataTable({
        responsive: true,
        autoWidth: false,
        scrollX: true,
        layout: {
            topEnd: ['search'],
            topStart: {
                pageLength: true, 
                buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'colVis', 'print']
            }
        }
    });
});
</script>

</x-app-layout>

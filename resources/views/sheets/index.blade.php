<x-app-layout>
    <x-slot name="header">
        <div class=" flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-left">
                {{ __('All Sheets List') }}
            </h2>
            <a href="{{ route('sheets.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                Upload New Sheet
            </a>
        </div>

    </x-slot>

    <div class="p-4 sm:ml-64">
        <!-- Data Table -->
        <table id="sheetTable" class="table-auto w-full border-collapse dark:border-gray-700 ">
            <thead>
                <tr >
                    <th>Sheet Name</th>
                    <th>File</th>
                    <th>Working Date</th>
                    <th>Client Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sheets as $sheet)
                    <tr class="dark:bg-gray-900 text-center">

                        <td class="px-4 py-2 border dark:border-gray-600 dark:text-gray-300">
                            <a href="{{ route('leads.bySheet', $sheet->id) }}?sheet_id={{ $sheet->id }}" 
                                class="text-blue-500 hover:underline dark:text-blue-400">
                                 {{ $sheet->sheet_name }}
                             </a>
                        </td>
                        <td class="px-4 py-2 border dark:border-gray-600 dark:text-gray-300">
                            @if($sheet->file)
                                <a href="{{ asset('storage/' . $sheet->file) }}" target="_blank" class="text-blue-500 hover:underline dark:text-blue-400">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                                    </svg>
                                    Open File download
                                </a>
                            @else
                                <span class="text-gray-500 dark:text-gray-400">No file available</span>
                            @endif
                        </td>

                        <td class="px-4 py-2 border dark:border-gray-600 dark:text-gray-300">{{ $sheet->sheet_working_date }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600 dark:text-gray-300">
                            <a href="{{ route('leads.byUser', $sheet->user->id) }}?user_id={{ $sheet->user->id }}" 
                                class="text-blue-500 hover:underline dark:text-blue-400">
                                 {{ $sheet->user->name }}
                             </a>
                        </td>
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
        processing: true,
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
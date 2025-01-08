<x-app-layout>
    <x-slot name="header">
        <div class=" flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-left">
                {{ __('All Sheets List') }}
            </h2>
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-auto"
                type="button">
                Upload
            </button>
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
        <!-- Main modal -->
        <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5">
                        <!-- Move the button to the right with spacing -->
                        <div class="mb-4 flex justify-end space-x-4">
    
                        </div>
                        <form action="{{ route('sheets.store') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-6">
                            @csrf
    
                            <div class="grid grid-cols-2 gap-6">
                                <!-- File Input -->
                                <div>
                                    <label for="file" class="block text-gray-700 dark:text-gray-300">Select Your
                                        Sheet</label>
                                    <input type="file" id="file" name="file" required
                                        class="form-control w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                                    @error('file')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <!-- Working Date -->
                                <div>
                                    <label for="sheet_working_date" class="block text-gray-700 dark:text-gray-300">Sheet
                                        Working
                                        Date</label>
                                    <input type="date" id="sheet_working_date" name="sheet_working_date"
                                        value="{{ old('sheet_working_date', now()->toDateString()) }}" required
                                        class="form-control w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                                    @error('sheet_working_date')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <!-- Sheet Name -->
                                <div>
                                    <label for="sheet_name" class="block text-gray-700 dark:text-gray-300">Sheet
                                        Name</label>
                                    <input type="text" id="sheet_name" name="sheet_name" value="{{ old('sheet_name') }}"
                                        required
                                        class="form-control w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                                    @error('sheet_name')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div x-data="{ open: false, search: '', selectedUser: '', selectedUserId: '' }" class="relative">
                                    <label for="user_id" class="block text-gray-700 dark:text-gray-300">User</label>
    
                                    <!-- Input for search -->
                                    <input type="text" x-model="search" @focus="open = true" @click="open = true"
                                        class="w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm p-2"
                                        placeholder="Search User..." autocomplete="off">
    
                                    <!-- Dropdown Menu -->
                                    <div x-show="open" @click.outside="open = false"
                                        class="absolute mt-1 w-full bg-white dark:bg-gray-800 shadow-lg max-h-60 overflow-auto rounded-md z-10">
                                        <ul class="w-full py-1 text-sm text-gray-700 dark:text-gray-300">
                                            @foreach ($users as $user)
                                                <li
                                                    x-show="search === '' || '{{ $user->name }}'.toLowerCase().includes(search.toLowerCase())">
                                                    <a href="#"
                                                        class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700"
                                                        @click.prevent="
                                        selectedUser = '{{ $user->name }}';
                                        selectedUserId = '{{ $user->id }}';
                                        open = false;">
                                                        {{ $user->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
    
                                    <!-- Selected User -->
                                    <div x-show="selectedUser" class="mt-2 text-gray-600 dark:text-gray-300">
                                        <p>Selected User: <span x-text="selectedUser"></span></p>
                                    </div>
    
                                    <!-- Hidden Input for Form Submission -->
                                    <input type="hidden" name="user_id" :value="selectedUserId">
    
                                    <!-- Error handling -->
                                    @error('user_id')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
    
    
                            </div>
    
                            <div>
                                <button type="submit"
                                    class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                                    Upload Sheet
                                </button>
                                <button
                                onclick="window.location.href='{{ route('sheets.index') }}'"
                                class="px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                                Back to List
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Modal body -->
            </div>
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

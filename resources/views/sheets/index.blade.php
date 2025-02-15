<x-app-layout>
    <x-slot name="header">
        <div class=" flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-left">
                {{ __('All Sheets List') }}
            </h2>
            @if (auth()->user()->hasRole('admin|manager'))
                {{-- <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-auto"
                    type="button">
                    Upload
                </button> --}}
            @else
            @endif

        </div>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="flex justify-between space-x-4 mb-4">
                <div>
                    @if (session('success'))
                        <div class="px-4 py-3 mb-4 rounded relative border text-sm
                               bg-green-100 border-green-400 text-green-700
                               dark:bg-green-900 dark:border-green-700 dark:text-green-300"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="px-4 py-3 mb-4 rounded relative border text-sm
                               bg-red-100 border-red-400 text-red-700
                               dark:bg-red-900 dark:border-red-700 dark:text-red-300"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                </div>

                <div class=" flex space-x-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start
                            Date</label>
                        <input type="date" id="start_date" name="start_date"
                            class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End
                            Date</label>
                        <input type="date" id="end_date" name="end_date"
                            class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600">
                    </div>
                </div>

            </div>
            <!-- Data Table -->
            <table id="sheetTable" class="table-auto w-full border-collapse ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sheet Name</th>
                        <th>File</th>
                        <th>Working Date</th>
                        <th>Client Name</th>
                        <th>Sheet link</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sheets as $index => $sheet)
                        <tr class="dark:bg-gray-900">
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="px-4 py-2  dark:text-gray-300">
                                <a href="{{ route(auth()->user()->hasRole('admin') ? 'leads.bySheet' : 'client.leads.bySheet', $sheet->id) }}?sheet_id={{ $sheet->id }}"
                                    class="text-blue-500 dark:text-blue-400">
                                    {{ $sheet->sheet_name }}
                                </a>
                            </td>
                            <td class="px-4 py-2  dark:text-gray-300">
                                @if ($sheet->file)
                                    <a href="{{ asset('storage/' . $sheet->file) }}" target="_blank"
                                        class="text-blue-500 dark:text-blue-400">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white inline-block mr-2"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4" />
                                        </svg>
                                        Open File download
                                    </a>
                                @else
                                    <span class="text-gray-500 dark:text-gray-400">No file available</span>
                                @endif
                            </td>

                            <td class="px-4 py-2  dark:text-gray-300">{{ $sheet->sheet_working_date }}</td>
                            <td class="px-4 py-2  dark:text-gray-300">

                                @if (auth()->user()->hasRole('admin'))
                                    <a href="{{ route('leads.byUser', $sheet->user->id) }}?user_id={{ $sheet->user->id }}"
                                        class="text-blue-500 hover:underline dark:text-blue-400">
                                        {{ $sheet->user->name }}
                                    </a>
                                @else
                                    <p>{{ $sheet->user->name }}</p>
                                @endif
                            </td>
                        </td>
                        <!-- New Sheet Link Column -->
                        <td class="px-4 py-2 dark:text-gray-300">
                            @if($sheet->sheet_link)
                                <a target="_blank" href="{{ $sheet->sheet_link }}" class="text-blue-500 hover:underline dark:text-blue-400">
                                    Sheet View
                                </a>
                            @else
                                No link available
                            @endif
                        </td>

                            <td class="px-4 py-2  dark:text-gray-300">

                                @if (auth()->user()->hasRole('admin'))
                                <form action="{{ route('sheets.destroy', $sheet) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="delete-btn text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-3 py-1 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                        onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                </form>
                                @else
                                    <a href="{{ route(auth()->user()->hasRole('admin') ? 'leads.bySheet' : 'client.leads.bySheet', $sheet->id) }}?sheet_id={{ $sheet->id }}"
                                        class=" text-white dark:text-white rounded-xl bg-yellow-500 px-2 py-1">
                                        View
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Main modal -->
    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                                <input type="text" id="sheet_name" name="sheet_name"
                                    value="{{ old('sheet_name') }}" required
                                    class="form-control w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                                @error('sheet_name')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- sheet_link -->
                            <div>
                                <label for="sheet_link" class="block text-gray-700 dark:text-gray-300">Sheet
                                    Link</label>
                                <input type="text" id="sheet_link" name="sheet_link"
                                    value="{{ old('sheet_link') }}" required
                                    class="form-control w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                                @error('sheet_link')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                             <!-- Select User -->
                             <div class="relative">
                                <label for="user_id" class="block text-gray-700 dark:text-gray-300">User</label>

                                <!-- Input for search -->
                                <input
                                    type="text"
                                    id="user_search"
                                    class="w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm p-2"
                                    placeholder="Search User..."
                                    autocomplete="off"
                                    oninput="filterUsers(event)"
                                    onclick="openDropdown()"
                                    onkeydown="handleKeyboardNavigation(event)">

                                <!-- Dropdown Menu -->
                                <div
                                    id="dropdown_menu"
                                    class="absolute mt-1 w-full bg-white dark:bg-gray-800 shadow-lg max-h-60 overflow-auto rounded-md z-10 hidden">
                                    <ul id="user_list" class="py-1 text-sm text-gray-700 dark:text-gray-300">
                                        <!-- User options will be dynamically inserted here -->
                                    </ul>
                                </div>

                                <!-- Message if no users found -->
                                <div id="no_results" class="hidden absolute mt-1 w-full bg-white dark:bg-gray-800 shadow-lg rounded-md z-10">
                                    <p class="px-4 py-2 text-gray-500 dark:text-gray-400">No users found</p>
                                </div>

                                <!-- Hidden Input for Form Submission -->
                                <input type="hidden" name="user_id" id="selected_user_id">

                                <!-- Error handling -->
                                <div id="error_message" class="text-red-500 text-sm mt-1 hidden">An error occurred</div>
                            </div>

                            <script>
                                const users = @json($users); // The user data from the backend
                                let filteredUsers = [...users.slice(0, 10)]; // Show the first 10 users by default
                                let activeIndex = -1;

                                // Filter users based on search input
                                function filterUsers(event) {
                                    const search = event.target.value.toLowerCase();
                                    if (search.trim() === "") {
                                        filteredUsers = [...users.slice(0, 10)]; // Default to the first 10 users
                                    } else {
                                        filteredUsers = users.filter(user =>
                                            `${user.name} - ${user.username}`.toLowerCase().includes(search)
                                        );
                                    }
                                    activeIndex = -1; // Reset active index
                                    updateDropdown();
                                }

                                // Open the dropdown
                                function openDropdown() {
                                    if (filteredUsers.length === 0) {
                                        // If no filtering has been done, show the first 10 users
                                        filteredUsers = [...users.slice(0, 10)];
                                    }
                                    document.getElementById("dropdown_menu").classList.remove("hidden");
                                    document.getElementById("no_results").classList.add("hidden");
                                    updateDropdown();
                                }

                                // Close the dropdown
                                function closeDropdown() {
                                    document.getElementById("dropdown_menu").classList.add("hidden");
                                }

                                // Update the dropdown menu with filtered users
                                function updateDropdown() {
                                    const dropdownMenu = document.getElementById("dropdown_menu");
                                    const userList = document.getElementById("user_list");
                                    const noResults = document.getElementById("no_results");

                                    // Clear the current list
                                    userList.innerHTML = "";

                                    if (filteredUsers.length === 0) {
                                        dropdownMenu.classList.add("hidden");
                                        noResults.classList.remove("hidden");
                                        return;
                                    }

                                    dropdownMenu.classList.remove("hidden");
                                    noResults.classList.add("hidden");

                                    // Add users to the dropdown
                                    filteredUsers.slice(0, 10).forEach((user, index) => {
                                        const li = document.createElement("li");
                                        li.className = `block px-4 py-2 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 ${
                                            index === activeIndex ? "bg-gray-200 dark:bg-gray-700" : ""
                                        }`;
                                        li.textContent = `${user.name} - ${user.username}`;
                                        li.onclick = () => selectUser(index);
                                        userList.appendChild(li);
                                    });
                                }

                                // Handle keyboard navigation
                                function handleKeyboardNavigation(event) {
                                    if (filteredUsers.length === 0) return;

                                    if (event.key === "ArrowDown") {
                                        activeIndex = (activeIndex + 1) % filteredUsers.length;
                                    } else if (event.key === "ArrowUp") {
                                        activeIndex = (activeIndex - 1 + filteredUsers.length) % filteredUsers.length;
                                    } else if (event.key === "Enter") {
                                        if (activeIndex >= 0) {
                                            selectUser(activeIndex);
                                        }
                                    }

                                    updateDropdown();
                                }

                                // Select a user from the dropdown
                                function selectUser(index) {
                                    const user = filteredUsers[index];
                                    document.getElementById("user_search").value = `${user.name} - ${user.username}`;
                                    document.getElementById("selected_user_id").value = user.id;
                                    closeDropdown();
                                }

                                // Close the dropdown when clicking outside
                                document.addEventListener("click", (event) => {
                                    if (!event.target.closest(".relative")) {
                                        closeDropdown();
                                    }
                                });
                            </script>


                        </div>

                        <div>
                            <button type="submit"
                                class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                                Upload Sheet
                            </button>
                            <button onclick="window.location.href='{{ route('sheets.index') }}'"
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
            $(document).ready(function() {
                const table = $('#sheetTable').DataTable({
                    processing: true,
                    responsive: false,
                    autoWidth: false,
                    scrollX: true,
                    layout: {
                        topEnd: ['search'],
                        topStart: {
                            pageLength: true,
                            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'colvis',
                                'print'
                            ]
                        }
                    },
                });

                // Custom filtering function for date range
                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    const startDate = $('#start_date').val() ? new Date($('#start_date').val()) :
                        null;
                    const endDate = $('#end_date').val() ? new Date($('#end_date').val()) : null;
                    const workingDate = new Date(data[
                    2]); // Adjust index based on Working Date column

                    if ((startDate === null && endDate === null) ||
                        (startDate === null && workingDate <= endDate) ||
                        (endDate === null && workingDate >= startDate) ||
                        (workingDate >= startDate && workingDate <= endDate)) {
                        return true;
                    }
                    return false;
                });

                // Event listeners for the date inputs
                $('#start_date, #end_date').on('change', function() {
                    table.draw();
                });
            });
            // Handle Delete Button Clicks
            // $(document).on('click', '.delete-btn', function() {
            //     var userId = $(this).data('id');

            //     if (confirm('Are you sure you want to delete this user?')) {
            //         $.ajax({
            //             url: '/User/' + userId,
            //             type: 'DELETE',
            //             data: {
            //                 _token: '{{ csrf_token() }}' // Include CSRF token
            //             },
            //             success: function(response) {
            //                 alert('User deleted successfully!');
            //                 $('#UserTable').DataTable().ajax
            //                     .reload(); // Reload the table data after deletion
            //             },
            //             error: function() {
            //                 alert('An error occurred while deleting the user.');
            //             }
            //         });
            //     }
            // });
        });
    </script>

</x-app-layout>

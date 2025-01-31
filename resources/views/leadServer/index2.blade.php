<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/tagify.css') }}">

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white dark:bg-gray-800">
        @include('layouts.header')
        @include('layouts.filter_sitebar')

        <!-- Theme Toggle Button -->
        <button id="theme-toggle" class="fixed top-4 right-4 bg-gray-800 text-white p-2 rounded-full">
            <span id="theme-toggle-light-icon" class="hidden">🌞</span>
            <span id="theme-toggle-dark-icon" class="hidden">🌙</span>
        </button>

        <!-- Page Heading -->
        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                <div class="flex items-center justify-between w-full">
                    <!-- Left Section -->
                    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Lead Lists') }}
                    </h1>
                    <!-- Center Section (Navbar) -->
                    <nav class="hidden md:flex items-center justify-between">
                        <ul
                            class="font-medium flex flex-row space-x-8 bg-gray-50 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent">
                            <li>
                                <a href="/dashboard"
                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="/User"
                                class="block text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-orange-400 dark:hover:bg-orange-500 dark:focus:ring-orange-700">
                                User Management
                            </a>

                            </li>
                            <li>
                                <a href="/sheets"
                                class="block text-white bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-cyan-400 dark:hover:bg-cyan-500 dark:focus:ring-cyan-700">
                                Sheet List
                                </a>
                            </li>
                            <li>
                                <a href="/tickets"
                                class="block text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                Support Ticket
                                </a>
                            </li>

                            <li>
                                <a href="/lead-server"
                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Current Lead:<span class="ml-2 text-lg font-bold">{{ $leadcount }}</span>

                                </a>
                            </li>


                        </ul>
                    </nav>
                    <!-- Right Section (Button) -->
                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Upload
                    </button>
                </div>

            </div>
        </div>

        <!-- Page Content -->
        <main>
            <div class="p-4 sm:ml-64">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                    <div class="container mx-auto">

                        <!-- Table Section -->
                        <div class="w-full bg-white p-5 shadow-md rounded-lg dark:bg-gray-700">
                            <div class="overflow-x-auto">
                                <table id="dataTable" class="dataTable table-auto border-collapse w-full">
                                    <thead>
                                        <tr>
                                            <th class="p-2.5">#</th>
                                            <th class="p-2.5">LinkedIn Link</th>
                                            <th class="p-2.5">Company Name</th>
                                            <th class="p-2.5">Contact Name</th>
                                            <th class="p-2.5">First Name</th>
                                            <th class="p-2.5">Last Name</th>
                                            <th class="p-2.5">Email</th>
                                            <th class="p-2.5">Title Position</th>
                                            <th class="p-2.5">Personal Phone</th>
                                            <th class="p-2.5">Country</th>
                                            <th class="p-2.5">Job Link</th>
                                            <th class="p-2.5">Job Role</th>
                                            <th class="p-2.5">Tag</th>
                                            <th class="p-2.5">Person Location</th>
                                            <th class="p-2.5">Full Address</th>
                                            <th class="p-2.5">Company Phone</th>
                                            <th class="p-2.5">Company Head Count</th>
                                            <th class="p-2.5">City</th>
                                            <th class="p-2.5">State</th>
                                            <th class="p-2.5">Source Link</th>
                                            <th class="p-2.5">Middle Name</th>
                                            <th class="p-2.5">Sur Name</th>
                                            <th class="p-2.5">Gender</th>
                                            <th class="p-2.5">Employee Range</th>
                                            <th class="p-2.5">Company Website</th>
                                            <th class="p-2.5">Company LinkedIn Link</th>
                                            <th class="p-2.5">Company HQ Address</th>
                                            <th class="p-2.5">Industry</th>
                                            <th class="p-2.5">Revenue</th>
                                            <th class="p-2.5">Street</th>
                                            <th class="p-2.5">Zip Code</th>
                                            <th class="p-2.5">Rating</th>
                                            {{-- <th class="p-2.5">Checked By</th> --}}
                                            <th class="p-2.5">Review</th>
                                            <th class="p-2.5">Created At</th>
                                            <th class="p-2.5">Updated At</th>
                                            <th class="p-2.5">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
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

    @livewireScripts
    <script src="{{ asset('js/tagify.js') }}"></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            // Extract URL parameters
            const urlParams = new URLSearchParams(window.location.search);

            // Set the sheet ID in the filter input if it exists
            const sheetId = urlParams.get('sheet_id');
            if (sheetId) {
                $('#sheetIdFilter').val(sheetId);
            }

            // Set the user ID in the filter input if it exists
            const userId = urlParams.get('user_id');
            if (userId) {
                $('#userIdFilter').val(userId);
            }
            const dataTable = $('#dataTable').DataTable({
                processing: true,
                // serverSide: true, // Enable server-side processing
                responsive: true,
                autoWidth: false,
                scrollX: true,
                scrollY: "50vh",
                scrollCollapse: true,
                pageLength: 25, // Default number of rows per page
                lengthMenu: [25, 50, 100, 200], // Dropdown options for rows per page
                ajax: {
                    url: '/leads/data',
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(d) {

                        // Include sheet_id in the request payload
                        const sheetId = $('#sheetIdFilter').val();
                        if (sheetId) {
                            d.sheet_id = sheetId;
                        }

                        // Include user_id in the request payload
                        const userId = $('#userIdFilter').val();
                        if (userId) {
                            d.user_id = userId;
                        }

                        // Process all '.tagify' inputs within '#filtersContainer'
                        $('#filtersContainer .tagify').each(function() {
                            const tagify = $(this).data(
                            'tagify'); // Retrieve the Tagify instance
                            if (tagify) {
                                const columnName = $(this).attr(
                                'name'); // Use the input's name as the column
                                d[columnName] = Array.isArray(tagify.value) ?
                                    tagify.value.map(tag => tag.value) // Safely map tag values
                                    :
                                    []; // Default to an empty array if tagify.value is not valid
                            }
                        });

                        // Log the result for debugging
                        console.log(d);
                    }
                },
                columns: [{
                        data: null, // Use `null` as data is not tied to any column in the database
                        render: function(data, type, row, meta) {
                            return meta.row +
                                1; // meta.row starts from 0, so add 1 for 1-based indexing
                        },
                        width: "50px"
                    },
                    {
                        data: 'linkedin_link',
                        width: "150px"
                    },
                    {
                        data: 'company_name',
                        width: "150px"
                    },
                    {
                        data: 'contact_name',
                        width: "150px"
                    },
                    {
                        data: 'first_name',
                        width: "150px"
                    },
                    {
                        data: 'last_name',
                        width: "150px"
                    },
                    {
                        data: 'email',
                        width: "150px"
                    },
                    {
                        data: 'title_position',
                        width: "150px"
                    },
                    {
                        data: 'personal_phone',
                        width: "150px"
                    },
                    {
                        data: 'country',
                        width: "150px"
                    },
                    {
                        data: 'job_link',
                        width: "150px"
                    },

                    {
                        data: 'job_role',
                        width: "150px"
                    },

                    {
                        data: 'tag',
                        width: "150px"
                    },
                    {
                        data: 'person_location',
                        width: "150px"

                    },
                    {
                        data: 'full_address',
                        width: "150px"

                    },
                    {
                        data: 'company_phone',
                        width: "150px"

                    },
                    {
                        data: 'company_head_count',
                        width: "150px"
                    },

                    {
                        data: 'city',
                        width: "150px"
                    },
                    {
                        data: 'state',
                        width: "150px"

                    },

                    {
                        data: 'source_link',
                        width: "150px"
                    },
                    {
                        data: 'middle_name',
                        width: "150px"
                    },
                    {
                        data: 'sur_name',
                        width: "150px"

                    },
                    {
                        data: 'gender',
                        width: "150px"
                    },

                    {
                        data: 'employee_range',
                        width: "150px"
                    },
                    {
                        data: 'company_website',
                        width: "150px"
                    },
                    {
                        data: 'company_linkedin_link',
                        width: "150px"
                    },
                    {
                        data: 'company_hq_address',
                        width: "150px"
                    },
                    {
                        data: 'industry',
                        width: "150px"
                    },
                    {
                        data: 'revenue',
                        width: "150px"
                    },
                    {
                        data: 'street',
                        width: "150px"
                    },
                    {
                        data: 'zip_code',
                        width: "150px"
                    },
                    {
                        data: 'rating',
                        width: "150px"
                    },
                    // {
                    //     data: 'checked_by',
                    //     width: "150px"
                    // },
                    {
                        data: 'review',
                        width: "150px"
                    },
                    {
                        data: 'created_at',
                        render: function(data) {
                            return moment(data).format(
                                'DD-MMM-YYYY h:mm A'); // e.g., 26-Dec-2024 06:34 AM
                        },
                        width: "150px"
                    },
                    {
                        data: 'updated_at',
                        render: function(data) {
                            return moment(data).format(
                                'DD-MMM-YYYY h:mm A'); // e.g., 26-Dec-2024 06:34 AM
                        },
                        width: "150px"
                    },
                    {
                        data: 'id', // The ID will be used for Edit, Show, Delete actions
                        render: function(data, type, row) {
                            return `
                                <button type="button" data-id="${data}" class="delete-btn text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-3 py-1 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                            `;
                        },
                        orderable: false, // Disable sorting for the action column
                        searchable: false, // Disable searching for the action column
                        width: "100px"
                    }

                ],

                layout: {
                    topEnd: ['search'],
                    topStart: {
                        pageLength: true,
                        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'colvis', 'print']
                    }
                },
                initComplete: function() {
                    const api = this.api();

                    $('#filtersContainer .tagify').each(function() {
                        const input = this;
                        const columnName = $(input).attr(
                            'name'); // Get the name attribute to identify the column

                        // Initialize Tagify
                        const tagify = new Tagify(input, {
                            whitelist: [], // Start empty
                            dropdown: {
                                enabled: 1, // Show suggestions after 1 character
                                maxItems: 20, // Maximum items to display in dropdown
                                position: 'input', // Show dropdown near the input
                                closeOnSelect: false // Keep dropdown open after selecting
                            }
                        });

                        $(input).data('tagify',
                            tagify); // Attach the Tagify instance to the input

                        // Handle dynamic suggestions from the server
                        tagify.on('input', function(e) {
                            const searchTerm = e.detail.value;

                            fetch(
                                    `/leads/filters?column=${columnName}&term=${searchTerm}`
                                )
                                .then((res) => res.json())
                                .then((data) => {
                                    tagify.settings.whitelist = data[columnName] ||
                                        [];
                                    tagify.dropdown.show(
                                        searchTerm); // Show suggestions
                                })
                                .catch((err) => console.error(
                                    'Error fetching suggestions:', err));
                        });

                        // Reload DataTable on tag addition or removal
                        tagify.on('add', () => {
                            $('#dataTable').DataTable().ajax.reload();
                        });

                        tagify.on('remove', () => {
                            $('#dataTable').DataTable().ajax.reload();
                        });

                        // Add a button to remove all tags
                        document.getElementById('removeAllTagsButton').addEventListener('click', function () {
                            // Remove all tags
                            tagify.removeAllTags();

                            // Reload the DataTable
                            $('#dataTable').DataTable().ajax.reload();

                            // Clear and reset DataTable search field (if any exists)
                            const searchField = document.querySelector('#dt-search-0'); // Replace #dt-search-0 with the correct selector
                            if (searchField) {
                                searchField.value = ''; // Clear the search field value
                                searchField.dispatchEvent(new Event('input')); // Trigger input event for search
                            }

                            // Clear all DataTable filters and redraw the table
                            $('#dataTable').DataTable().search('').draw();
                        });
                    });

                    // Generates an array [1, 2, ..., 36]
                    const columnsToSearch = Array.from({ length: 35 }, (_, i) => i + 1); // Generates an array [1, 2, ..., 36]

                    // Add a second row for search filters
                    const tableHeader = $(api.table().header());
                    const searchRow = $('<tr class="search-row"></tr>'); // Add a class for easier styling
                    tableHeader.append(searchRow); // Append as the second row

                    api.columns().every(function(index) {
                        const column = this;

                        if (columnsToSearch.includes(index)) {
                            // Create a search input for searchable columns
                            const title = $(column.header()).text(); // Get column title
                            $('<th><input type="text" placeholder="" style="width:100%;padding: 1px;"/></th>')
                                .appendTo(searchRow)
                                .find('input')
                                .on('keyup change clear', function() {
                                    if (column.search() !== this.value) {
                                        column.search(this.value).draw(); // Trigger filtering
                                    }
                                });
                        } else {
                            $('<th></th>').appendTo(searchRow); // Add an empty cell for non-searchable columns
                        }
                    });

                }
            });
            // Handle Delete Button Clicks
            $(document).on('click', '.delete-btn', function() {
                var ID = $(this).data('id');

                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: '/lead-server/' + ID,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // Include CSRF token
                        },
                        success: function(response) {
                            alert('User deleted successfully!');
                            $('#dataTable').DataTable().ajax
                                .reload(); // Reload the table data after deletion
                        },
                        error: function() {
                            alert('An error occurred while deleting the user.');
                        }
                    });
                }
            });
        });
    </script>

</body>
<style>
    .dataTable th,
    .dataTable td {
        white-space: nowrap;
        /* Prevent text from wrapping */
        overflow: hidden;
        /* Hide overflowing text */
        text-overflow: ellipsis;
        /* Add ellipsis (...) for hidden text */
    }

    thead input {
        border-radius: 5px !important;
    }

    .dropdown {
        display: none;
        position: absolute;
        background: #fff;
        border: 1px solid #ccc;
        max-height: 150px;
        overflow-y: auto;
        z-index: 1000;
    }

    .dropdown-item {
        padding: 5px 10px;
        cursor: pointer;
    }

    .dropdown-item:hover {
        background-color: #f0f0f0;
    }

    /* .tagify {
        @apply text-gray-800 bg-gray-100;
        @apply dark:text-white dark:bg-gray-900;
    } */
    .tagify {
        --placeholder-color: #6b7280;
        /* Default placeholder color for light mode */
        --placeholder-color-focus: #6b7280;
    }

    .dark .tagify {
        --placeholder-color: #6e6e6e;
        /* Placeholder color for dark mode */
        --placeholder-color-focus: #6e6e6e;
        /* Placeholder color for dark mode */
    }

    table.dataTable {
        table-layout: fixed !important;
    }
</style>

</html>

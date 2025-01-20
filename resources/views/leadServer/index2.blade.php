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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script> --}}
    {{-- <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script> --}}



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
                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    User Management
                                </a>
                            </li>
                            <li>
                                <a href="/sheets"
                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Sheet List
                                </a>
                            </li>
                            <li>
                                <a href="/tickets"
                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Support Ticket
                                </a>
                            </li>
                        </ul>

                        <!-- Total Lead Section -->



                    </nav>

                    <div class="flex justify-end pr-10">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold rounded-full text-sm px-10 py-2 shadow-lg hover:shadow-xl">
                            <i class="fas fa-chart-line mr-2"></i>
                            Current Lead:<span class="ml-2 text-lg font-bold">{{$leadcount}}</span>
                        </div>
                    </div>

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
                                            <th class="p-2.5">ID</th>
                                            <th class="p-2.5">LinkedIn Link</th>
                                            <th class="p-2.5">Company Name</th>
                                            <th class="p-2.5">Contact Name</th>
                                            <th class="p-2.5">Full Name</th>
                                            <th class="p-2.5">First Name</th>
                                            <th class="p-2.5">Last Name</th>
                                            <th class="p-2.5">Email</th>
                                            <th class="p-2.5">Title Position</th>
                                            <th class="p-2.5">Person Location</th>
                                            <th class="p-2.5">Full Address</th>
                                            <th class="p-2.5">Company Phone</th>
                                            <th class="p-2.5">Company Head Count</th>
                                            <th class="p-2.5">Country</th>
                                            <th class="p-2.5">City</th>
                                            <th class="p-2.5">State</th>
                                            <th class="p-2.5">Tag</th>
                                            <th class="p-2.5">Source Link</th>
                                            <th class="p-2.5">Middle Name</th>
                                            <th class="p-2.5">Sur Name</th>
                                            <th class="p-2.5">Gender</th>
                                            <th class="p-2.5">Personal Phone</th>
                                            <th class="p-2.5">Employee Range</th>
                                            <th class="p-2.5">Company Website</th>
                                            <th class="p-2.5">Company LinkedIn Link</th>
                                            <th class="p-2.5">Company HQ Address</th>
                                            <th class="p-2.5">Industry</th>
                                            <th class="p-2.5">Revenue</th>
                                            <th class="p-2.5">Street</th>
                                            <th class="p-2.5">Name Prefix</th>
                                            <th class="p-2.5">Zip Code</th>
                                            <th class="p-2.5">Rating</th>
                                            <th class="p-2.5">Sheet Name</th>
                                            <th class="p-2.5">Job Link</th>
                                            <th class="p-2.5">Job Role</th>
                                            <th class="p-2.5">Checked By</th>
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

                            <div x-data="{ open: false, search: '', selectedUser: '', selectedUserId: '' }" class="relative">
                                <label for="user_id" class="block text-gray-700 dark:text-gray-300">User</label>

                                <!-- Input for search -->
                                <input type="text"
                                       x-model="search"
                                       @focus="open = true"
                                       @click="open = true"
                                       class="w-full mt-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm p-2"
                                       placeholder="Search User..."
                                       autocomplete="off">

                                <!-- Dropdown Menu -->
                                <div x-show="open"
                                     @click.outside="open = false"
                                     class="absolute mt-1 w-full bg-white dark:bg-gray-800 shadow-lg max-h-60 overflow-auto rounded-md z-10">
                                    <ul class="w-full py-1 text-sm text-gray-700 dark:text-gray-300">
                                        @foreach ($users as $user)
                                            <li x-show="search === '' || '{{ $user->name }}'.toLowerCase().includes(search.toLowerCase())">
                                                <a href="#"
                                                   class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700"
                                                   @click.prevent="
                                                        selectedUser = '{{ $user->name }}';
                                                        selectedUserId = '{{ $user->id }}';
                                                        search = selectedUser;  // Update the input field with the selected name
                                                        open = false;">
                                                    {{ $user->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                {{-- <!-- Selected User -->
                                <div x-show="selectedUser" class="mt-2 text-gray-600 dark:text-gray-300">
                                    <p>Selected User: <span x-text="selectedUser"></span></p>
                                </div> --}}

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

    {{-- <script>
        window.addEventListener('DOMContentLoaded', () => {
            const dataTable = $('#dataTable').DataTable({
                responsive: true,
                autoWidth: true,
                scrollX: true,
                scrollY: "75vh", // Corrected property name
                scrollCollapse: true,
                ajax: {
                    url: '/leads/data',
                    type: 'GET'
                    // type: 'GET',
                    // data: function(d) {
                    //     // Collect selected categories
                    //     d.category_id = [];
                    //     $('input[name="category_id[]"]:checked').each(function() {
                    //         d.category_id.push($(this).val());
                    //     });

                    //     d.brand_id = [];
                    //     $('input[name="brand_id[]"]:checked').each(function() {
                    //         d.brand_id.push($(this).val());
                    //     });

                    //     d.linkedin_link = [];
                    //     $('input[name="linkedin_link[]"]:checked').each(function() {
                    //         d.linkedin_link.push($(this).val());
                    //     });

                    //     d.company_name = [];
                    //     $('input[name="company_name[]"]:checked').each(function() {
                    //         d.company_name.push($(this).val());
                    //     });

                    //     d.contact_name = [];
                    //     $('input[name="contact_name[]"]:checked').each(function() {
                    //         d.contact_name.push($(this).val());
                    //     });

                    //     d.name_prefix = [];
                    //     $('input[name="name_prefix[]"]:checked').each(function() {
                    //         d.name_prefix.push($(this).val());
                    //     });

                    //     d.full_name = [];
                    //     $('input[name="full_name[]"]:checked').each(function() {
                    //         d.full_name.push($(this).val());
                    //     });

                    //     d.first_name = [];
                    //     $('input[name="first_name[]"]:checked').each(function() {
                    //         d.first_name.push($(this).val());
                    //     });

                    //     d.last_name = [];
                    //     $('input[name="last_name[]"]:checked').each(function() {
                    //         d.last_name.push($(this).val());
                    //     });

                    //     d.email = [];
                    //     $('input[name="email[]"]:checked').each(function() {
                    //         d.email.push($(this).val());
                    //     });

                    //     d.title_position = [];
                    //     $('input[name="title_position[]"]:checked').each(function() {
                    //         d.title_position.push($(this).val());
                    //     });

                    //     d.person_location = [];
                    //     $('input[name="person_location[]"]:checked').each(function() {
                    //         d.person_location.push($(this).val());
                    //     });

                    //     d.full_address = [];
                    //     $('input[name="full_address[]"]:checked').each(function() {
                    //         d.full_address.push($(this).val());
                    //     });

                    //     d.company_phone = [];
                    //     $('input[name="company_phone[]"]:checked').each(function() {
                    //         d.company_phone.push($(this).val());
                    //     });

                    //     d.company_head_count = [];
                    //     $('input[name="company_head_count[]"]:checked').each(function() {
                    //         d.company_head_count.push($(this).val());
                    //     });

                    //     d.country = [];
                    //     $('input[name="country[]"]:checked').each(function() {
                    //         d.country.push($(this).val());
                    //     });

                    //     d.city = [];
                    //     $('input[name="city[]"]:checked').each(function() {
                    //         d.city.push($(this).val());
                    //     });

                    //     d.state = [];
                    //     $('input[name="state[]"]:checked').each(function() {
                    //         d.state.push($(this).val());
                    //     });

                    //     d.tag = [];
                    //     $('input[name="tag[]"]:checked').each(function() {
                    //         d.tag.push($(this).val());
                    //     });

                    //     d.source_link = [];
                    //     $('input[name="source_link[]"]:checked').each(function() {
                    //         d.source_link.push($(this).val());
                    //     });

                    //     d.middle_name = [];
                    //     $('input[name="middle_name[]"]:checked').each(function() {
                    //         d.middle_name.push($(this).val());
                    //     });

                    //     d.sur_name = [];
                    //     $('input[name="sur_name[]"]:checked').each(function() {
                    //         d.sur_name.push($(this).val());
                    //     });

                    //     d.gender = [];
                    //     $('input[name="gender[]"]:checked').each(function() {
                    //         d.gender.push($(this).val());
                    //     });

                    //     d.personal_phone = [];
                    //     $('input[name="personal_phone[]"]:checked').each(function() {
                    //         d.personal_phone.push($(this).val());
                    //     });

                    //     d.employee_range = [];
                    //     $('input[name="employee_range[]"]:checked').each(function() {
                    //         d.employee_range.push($(this).val());
                    //     });

                    //     d.company_website = [];
                    //     $('input[name="company_website[]"]:checked').each(function() {
                    //         d.company_website.push($(this).val());
                    //     });

                    //     d.company_linkedin_link = [];
                    //     $('input[name="company_linkedin_link[]"]:checked').each(function() {
                    //         d.company_linkedin_link.push($(this).val());
                    //     });

                    //     d.company_hq_address = [];
                    //     $('input[name="company_hq_address[]"]:checked').each(function() {
                    //         d.company_hq_address.push($(this).val());
                    //     });

                    //     d.industry = [];
                    //     $('input[name="industry[]"]:checked').each(function() {
                    //         d.industry.push($(this).val());
                    //     });

                    //     d.revenue = [];
                    //     $('input[name="revenue[]"]:checked').each(function() {
                    //         d.revenue.push($(this).val());
                    //     });

                    //     d.street = [];
                    //     $('input[name="street[]"]:checked').each(function() {
                    //         d.street.push($(this).val());
                    //     });

                    //     d.zip_code = [];
                    //     $('input[name="zip_code[]"]:checked').each(function() {
                    //         d.zip_code.push($(this).val());
                    //     });

                    //     d.rating = [];
                    //     $('input[name="rating[]"]:checked').each(function() {
                    //         d.rating.push($(this).val());
                    //     });

                    //     d.sheet_name = [];
                    //     $('input[name="sheet_name[]"]:checked').each(function() {
                    //         d.sheet_name.push($(this).val());
                    //     });

                    //     d.job_link = [];
                    //     $('input[name="job_link[]"]:checked').each(function() {
                    //         d.job_link.push($(this).val());
                    //     });

                    //     d.job_role = [];
                    //     $('input[name="job_role[]"]:checked').each(function() {
                    //         d.job_role.push($(this).val());
                    //     });

                    //     d.checked_by = [];
                    //     $('input[name="checked_by[]"]:checked').each(function() {
                    //         d.checked_by.push($(this).val());
                    //     });

                    //     d.review = [];
                    //     $('input[name="review[]"]:checked').each(function() {
                    //         d.review.push($(this).val());
                    //     });
                    //     console.log('Categories:', d.category_id);
                    //     console.log('Brands:', d.brand_id);
                    }
                },
                columns: [{data: 'id'},{data: 'linkedin_link'},
                        {data: 'company_name'},
                        {data: 'contact_name'},
                        {data: 'name_prefix'},
                        {data: 'full_name'},
                        {data: 'first_name'},
                        {data: 'last_name'},
                        {data: 'email'},
                        {data: 'title_position'},
                        {data: 'person_location'},
                        {data: 'full_address'},
                        {data: 'company_phone'},
                        {data: 'company_head_count'},
                        {data: 'country'},
                        {data: 'city'},
                        {data: 'state'},
                        {data: 'tag'},
                        {data: 'source_link'},
                        {data: 'middle_name'},
                        {data: 'sur_name'},
                        {data: 'gender'},
                        {data: 'personal_phone'},
                        {data: 'employee_range'},
                        {data: 'company_website'},
                        {data: 'company_linkedin_link'},
                        {data: 'company_hq_address'},
                        {data: 'industry'},
                        {data: 'revenue'},
                        {data: 'street'},
                        {data: 'zip_code'},
                        {data: 'rating'},
                        {data: 'sheet_name'},
                        {data: 'job_link'},
                        {data: 'job_role'},
                        {data: 'checked_by'},
                        {data: 'review'},
                        {data: 'created_at',
                            render: function(data) {
                                return moment(data).format(
                                    'DD-MMM-YYYY h:mm A'); // e.g., 26-Dec-2024 06:34 AM
                            }
                        },
                        {data: 'updated_at',
                            render: function(data) {
                                return moment(data).format(
                                    'DD-MMM-YYYY h:mm A'); // e.g., 26-Dec-2024 06:34 AM
                            }
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
                    var columnsToSearch = [1, 2, 3, 5, 6]; // Indices of columns to include (0-based)
                    var api = this.api();

                    // Create a new search row and prepend it to the thead
                    var searchRow = $('<tr></tr>');
                    $(api.table().header()).prepend(searchRow);

                    // Loop through all columns
                    api.columns().every(function(index) {
                        var column = this;

                        if (columnsToSearch.includes(index)) {
                            // Add an input to searchable columns
                            var title = $(column.header()).text(); // Get column header text
                            $('<th><input type="text" placeholder="Search ' + title +
                                    '" style="width:100%;" /></th>')
                                .appendTo(searchRow)
                                .find('input')
                                .on('keyup change clear', function() {
                                    if (column.search() !== this.value) {
                                        column.search(this.value).draw();
                                    }
                                });
                        } else {
                            // Add an empty cell for non-searchable columns
                            $('<th></th>').appendTo(searchRow);
                        }
                    });
                }
            });
            $(document).on('change',
              'input[name="category_id[]"],
                input[name="brand_id[]"],
                input[name="linkedin_link[]"],
                input[name="company_name[]"],
                input[name="contact_name[]"],
                input[name="name_prefix[]"],
                input[name="full_name[]"],
                input[name="first_name[]"],
                input[name="last_name[]"],
                input[name="email[]"],
                input[name="title_position[]"],
                input[name="person_location[]"],
                input[name="full_address[]"],
                input[name="company_phone[]"],
                input[name="company_head_count[]"],
                input[name="country[]"],
                input[name="city[]"],
                input[name="state[]"],
                input[name="tag[]"],
                input[name="source_link[]"],
                input[name="middle_name[]"],
                input[name="sur_name[]"],
                input[name="gender[]"],
                input[name="personal_phone[]"],
                input[name="employee_range[]"],
                input[name="company_website[]"],
                input[name="company_linkedin_link[]"],
                input[name="company_hq_address[]"],
                input[name="industry[]"],
                input[name="revenue[]"],
                input[name="street[]"],
                input[name="zip_code[]"],
                input[name="rating[]"],
                input[name="sheet_name[]"],
                input[name="job_link[]"],
                input[name="job_role[]"],
                input[name="checked_by[]"],
                input[name="review[]"]',
                function() {
                    dataTable.ajax.reload();
                }
            );

        });
    </script> --}}

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
                responsive: true,
                autoWidth: true,
                scrollX: true,
                scrollY: "75vh",
                scrollCollapse: true,
                pageLength: 25, // Default number of rows per page
                lengthMenu: [25, 50, 100, 200], // Dropdown options for rows per page
                ajax: {
                    url: '/leads/data',
                    type: 'GET',
                    data: function(d) {
                        // // Collect sheet_id and user_id dynamically
                        // ['sheetIdFilter', 'userIdFilter'].forEach((filterId) => {
                        //     const value = $(`#${filterId}`).val();
                        //     if (value) {
                        //         d[filterId.replace('Filter', '').toLowerCase()] = value; // Add sheet_id or user_id dynamically
                        //     }
                        // });

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
                        // Ensure the Sheet ID input exists and retrieve its value
                        // const sheetId = $('#sheetIdFilter').val();
                        // if (sheetId) {
                        //     d.sheet_id = sheetId; // Add sheet_id to the DataTable's request payload
                        // } else {
                        //     d.sheet_id = null; // Default to null if no Sheet ID is provided
                        // }
                        // Dynamically collect selected filter values
                        $('#filtersContainer input[type="checkbox"]:checked').each(function() {
                            const columnName = $(this).attr('name').replace('[]',
                                ''); // Remove [] from the name
                            if (!d[columnName]) {
                                d[
                                    columnName
                                ] = []; // Initialize array for the column if not already set
                            }
                            d[columnName].push($(this)
                                .val()); // Add selected value to the column array
                        });

                        // Collect values from Tagify inputs
                        $('#filtersContainer .tagify').each(function() {
                            const tagify = $(this).data(
                                'tagify'); // Retrieve the Tagify instance
                            if (tagify) {
                                const columnName = $(this).attr(
                                    'name'); // Use the input's name as the column
                                d[columnName] = tagify.value.map(tag => tag
                                    .value); // Add Tagify values as an array
                            }
                        });
                        console.log('Filters being sent:', d); // Debug log for verification
                    }
                },
                columns: [
                    {
        data: null, // Use `null` as data is not tied to any column in the database
        render: function (data, type, row, meta) {
            return meta.row + 1; // meta.row starts from 0, so add 1 for 1-based indexing
        },
        orderable: false, // Disable sorting for the index column
        searchable: false, // Disable searching for the index column
    },
                    {
                        data: 'linkedin_link'
                    },
                    {
                        data: 'company_name'
                    },
                    {
                        data: 'contact_name'
                    },
                    {
                        data: 'name_prefix'
                    },
                    {
                        data: 'full_name'
                    },
                    {
                        data: 'first_name'
                    },
                    {
                        data: 'last_name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'title_position'
                    },
                    {
                        data: 'person_location'
                    },
                    {
                        data: 'full_address'
                    },
                    {
                        data: 'company_phone'
                    },
                    {
                        data: 'company_head_count'
                    },
                    {
                        data: 'country'
                    },
                    {
                        data: 'city'
                    },
                    {
                        data: 'state'
                    },
                    {
                        data: 'tag'
                    },
                    {
                        data: 'source_link'
                    },
                    {
                        data: 'middle_name'
                    },
                    {
                        data: 'sur_name'
                    },
                    {
                        data: 'gender'
                    },
                    {
                        data: 'personal_phone'
                    },
                    {
                        data: 'employee_range'
                    },
                    {
                        data: 'company_website'
                    },
                    {
                        data: 'company_linkedin_link'
                    },
                    {
                        data: 'company_hq_address'
                    },
                    {
                        data: 'industry'
                    },
                    {
                        data: 'revenue'
                    },
                    {
                        data: 'street'
                    },
                    {
                        data: 'zip_code'
                    },
                    {
                        data: 'rating'
                    },
                    {
                        data: 'sheet_name'
                    },
                    {
                        data: 'job_link'
                    },
                    {
                        data: 'job_role'
                    },
                    {
                        data: 'checked_by'
                    },
                    {
                        data: 'review'
                    },
                    {
                        data: 'created_at',
                        render: function(data) {
                            return moment(data).format(
                                'DD-MMM-YYYY h:mm A'); // e.g., 26-Dec-2024 06:34 AM
                        }
                    },
                    {
                        data: 'updated_at',
                        render: function(data) {
                            return moment(data).format(
                                'DD-MMM-YYYY h:mm A'); // e.g., 26-Dec-2024 06:34 AM
                        }
                    },
                    {
                        data: 'id', // The ID will be used for Edit, Show, Delete actions
                        render: function(data, type, row) {
                            return `
                                <button type="button" data-id="${data}" class="delete-btn text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-3 py-1 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                            `;
                        },
                        orderable: false, // Disable sorting for the action column
                        searchable: false // Disable searching for the action column
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

                    // Initialize Tagify for all inputs with the "tagify" class in filtersContainer
                    // $('#filtersContainer .tagify').each(function() {
                    //     const input = this;
                    //     const tagify = new Tagify(input);
                    //     $(input).data('tagify',
                    //     tagify); // Attach the Tagify instance to the input

                    //     // Handle Tagify events
                    //     tagify.on('add', (e) => {
                    //         console.log(`Tag added for input [${input.id}]:`, e.detail
                    //             .data);
                    //         dataTable.ajax.reload(); // Reload DataTable on tag addition
                    //     });

                    //     tagify.on('remove', (e) => {
                    //         console.log(`Tag removed for input [${input.id}]:`, e.detail
                    //             .data);
                    //         dataTable.ajax.reload(); // Reload DataTable on tag removal
                    //     });
                    // });
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
                    });

                    // Search Row for Filterable Columns
                    // const columnsToSearch = [1, 2, 3, 5, 6]; // Indices of columns to include (0-based)
                    // const searchRow = $('<tr></tr>');
                    // $(api.table().header()).prepend(searchRow);

                    // api.columns().every(function(index) {
                    //     const column = this;

                    //     if (columnsToSearch.includes(index)) {
                    //         // Add an input to searchable columns
                    //         const title = $(column.header()).text();
                    //         $('<th><input type="text" placeholder="Search ' + title +
                    //                 '" style="width:100%;" /></th>')
                    //             .appendTo(searchRow)
                    //             .find('input')
                    //             .on('keyup change clear', function() {
                    //                 if (column.search() !== this.value) {
                    //                     column.search(this.value).draw();
                    //                 }
                    //             });
                    //     } else {
                    //         $('<th></th>').appendTo(searchRow);
                    //     }
                    // });
                    const columnsToSearch = [1, 2, 3, 5, 4,
                        6
                    ]; // Indices of columns to include (0-based)

                    // Add a second row for search filters
                    const tableHeader = $(api.table().header());
                    const searchRow = $(
                        '<tr class="search-row"></tr>'); // Add a class for easier styling
                    tableHeader.append(searchRow); // Append as the second row

                    api.columns().every(function(index) {
                        const column = this;

                        if (columnsToSearch.includes(index)) {
                            // Create a search input for searchable columns
                            const title = $(column.header()).text(); // Get column title
                            $('<th><input type="text" placeholder=""style="width:100%;padding: 1px;"/></th>')
                                .appendTo(searchRow)
                                .find('input')
                                .on('keyup change clear', function() {
                                    if (column.search() !== this.value) {
                                        column.search(this.value)
                                            .draw(); // Trigger filtering
                                    }
                                });
                        } else {
                            $('<th></th>').appendTo(
                                searchRow); // Add an empty cell for non-searchable columns
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
    }

    /* table.dataTable>thead>tr:first-child>th {
        background: transparent !important;
    } */

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
</style>

</html>

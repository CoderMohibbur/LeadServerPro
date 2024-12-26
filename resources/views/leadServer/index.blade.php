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

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
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
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Lead Lists') }}
                </h2>
            </div>

        </div>

        <!-- Page Content -->
        <main>
            <div class="p-4 sm:ml-64">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                    <div class="container mx-auto py-8">

                        <!-- Table Section -->
                        <div class="w-full bg-white p-5 shadow-md rounded-lg dark:bg-gray-700">
                            <div class="overflow-x-auto">
                                <table id="dataTable" class="dataTable table-auto border-collapse w-full">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>LinkedIn Link</th>
                                            <th>Company Name</th>
                                            <th>Contact Name</th>
                                            <th>Name Prefix</th>
                                            <th>Full Name</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Title Position</th>
                                            <th>Person Location</th>
                                            <th>Full Address</th>
                                            <th>Company Phone</th>
                                            <th>Company Head Count</th>
                                            <th>Country</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Tag</th>
                                            <th>Source Link</th>
                                            <th>Middle Name</th>
                                            <th>Sur Name</th>
                                            <th>Gender</th>
                                            <th>Personal Phone</th>
                                            <th>Employee Range</th>
                                            <th>Company Website</th>
                                            <th>Company LinkedIn Link</th>
                                            <th>Company HQ Address</th>
                                            <th>Industry</th>
                                            <th>Revenue</th>
                                            <th>Street</th>
                                            <th>Zip Code</th>
                                            <th>Rating</th>
                                            <th>Sheet Name</th>
                                            <th>Job Link</th>
                                            <th>Job Role</th>
                                            <th>Checked By</th>
                                            <th>Review</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $leads->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @livewireScripts
    <script>
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
            },
            columns: [
                { data: 'id' },
                { data: 'linkedin_link' },
                { data: 'company_name' },
                { data: 'contact_name' },
                { data: 'name_prefix' },
                { data: 'full_name' },
                { data: 'first_name' },
                { data: 'last_name' },
                { data: 'email' },
                { data: 'title_position' },
                { data: 'person_location' },
                { data: 'full_address' },
                { data: 'company_phone' },
                { data: 'company_head_count' },
                { data: 'country' },
                { data: 'city' },
                { data: 'state' },
                { data: 'tag' },
                { data: 'source_link' },
                { data: 'middle_name' },
                { data: 'sur_name' },
                { data: 'gender' },
                { data: 'personal_phone' },
                { data: 'employee_range' },
                { data: 'company_website' },
                { data: 'company_linkedin_link' },
                { data: 'company_hq_address' },
                { data: 'industry' },
                { data: 'revenue' },
                { data: 'street' },
                { data: 'zip_code' },
                { data: 'rating' },
                { data: 'sheet_name' },
                { data: 'job_link' },
                { data: 'job_role' },
                { data: 'checked_by' },
                { data: 'review' },
                {
                    data: 'created_at',
                    render: function(data) {
                        return moment(data).format('DD-MMM-YYYY h:mm A'); // e.g., 26-Dec-2024 06:34 AM
                    }
                },
                {
                    data: 'updated_at',
                    render: function(data) {
                        return moment(data).format('DD-MMM-YYYY h:mm A'); // e.g., 26-Dec-2024 06:34 AM
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
            initComplete: function () {
            var columnsToSearch = [1, 2, 3, 5, 6]; // Indices of columns to include (0-based)
            var api = this.api();

            // Create a new search row and prepend it to the thead
            var searchRow = $('<tr></tr>');
            $(api.table().header()).prepend(searchRow);

            // Loop through all columns
            api.columns().every(function (index) {
                var column = this;

                if (columnsToSearch.includes(index)) {
                    // Add an input to searchable columns
                    var title = $(column.header()).text(); // Get column header text
                    $('<th><input type="text" placeholder="Search ' + title + '" style="width:100%;" /></th>')
                        .appendTo(searchRow)
                        .find('input')
                        .on('keyup change clear', function () {
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
    });
    </script>
</body>
<style>
.dataTable th, .dataTable td {
    white-space: nowrap;
}
table.dataTable > thead > tr:first-child > th {
    background: transparent !important;
}
thead input{
    padding: 2px 10px !important;
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

</style>
</html>

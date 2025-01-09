<x-app-layout>
    <x-slot name="header">
        <div class=" flex justify-between items-center">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users List') }}
            </h1>
            <a href="/User/create"
                class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                Create
            </a>
        </div>
    </x-slot>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

            {{-- <div id="custom-buttons" class="custom-buttons mb-4"></div> <!-- Custom Buttons Container --> --}}

            </div>
            <table id="UserTable" class="dataTable table-auto border-collapse w-full dark:bg-gray-700">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            $('#UserTable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: '/users/data', // The route returning JSON data
                    type: 'GET'
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created_at',
                        render: function(data) {
                            return moment(data).format(
                                'DD-MMM-YYYY h:mm A'); // e.g., 26-Dec-2024 06:34 AM
                        }
                    },
                    {
                        data: 'id', // The ID will be used for Edit, Show, Delete actions
                        render: function(data, type, row) {
                            return `
                                <a href="/User/${data}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-3 py-1 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Show</a>
                                <a href="/User/${data}/edit" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-3 py-1  text-center me-2 mb-2 dark:focus:ring-yellow-900">Edit</a>
                                <button type="button" data-id="${data}" class=" delete-btn text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-3 py-1 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
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
                }
            });

            // Handle Delete Button Clicks
            $(document).on('click', '.delete-btn', function() {
                var userId = $(this).data('id');

                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: '/User/' + userId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // Include CSRF token
                        },
                        success: function(response) {
                            alert('User deleted successfully!');
                            $('#UserTable').DataTable().ajax
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
</x-app-layout>

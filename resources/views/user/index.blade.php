<x-app-layout>
    <x-slot name="header">
        <div class=" flex justify-between items-center">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users List') }}
            </h1>
            {{-- <a href="/User/create"
                class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                Create
            </a> --}}

            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-auto"
                type="button">
                Upload
            </button>
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
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
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
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

                    {{-- <div class="mb-6 flex justify-between items-center">
                        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200"></h1>
                        <a href="/User/create"
                            class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                            Create
                        </a>
                    </div> --}}
                    {{-- <div id="custom-buttons" class="custom-buttons mb-4"></div> <!-- Custom Buttons Container --> --}}

                    <form method="POST" action="{{ route('User.store') }}" class="space-y-8">
                        @csrf

                        <div class=" grid grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input id="name" name="name" type="text" placeholder="Full Name"
                                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <input id="email" name="email" type="email" placeholder="example@mail.com"
                                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                                <input id="password" name="password" type="password" placeholder="******"
                                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm
                                    Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    placeholder="******"
                                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                @error('password_confirmation')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Country -->
                            <div>
                                <label for="country"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                                <select id="country" name="country"
                                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500">
                                    <option selected>United States</option>
                                    <option value="AU">Australia</option>
                                    <option value="UK">United Kingdom</option>
                                    <option value="IT">Italy</option>
                                    <option value="DE">Germany</option>
                                    <option value="ES">Spain</option>
                                    <option value="FR">France</option>
                                    <option value="CA">Canada</option>
                                </select>
                                @error('country')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Company Name -->
                            <div>
                                <label for="company_name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company
                                    Name</label>
                                <input id="company_name" name="company_name" type="text" placeholder="Company Name"
                                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                @error('company_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- LinkedIn URL -->
                            <div>
                                <label for="linkedin_url"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">LinkedIn
                                    URL</label>
                                <input id="linkedin_url" name="linkedin_url" type="url"
                                    placeholder="https://www.linkedin.com/in/example"
                                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                @error('linkedin_url')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone_number"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone
                                    Number</label>
                                <input id="phone_number" name="phone_number" type="tel" placeholder="+1234567890"
                                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                @error('phone_number')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- Actions -->
                        <div class="flex items-center mt-8 space-x-2">
                            <button type="submit"
                                class="px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                                {{ __('Create') }}
                            </button>
                            {{-- <button
                                type="button"
                                onclick="window.location.href='{{ route('User.index') }}'"
                                class="px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                                Back to List
                            </button> --}}
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal body -->
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
                        data: 'is_approved',
                        render: function(data, type, row) {
                            if (data) {
                                // Approved: Green button
                                return `
                                    <button
                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600"
                                        onclick="updateStatus(${row.id}, false)">
                                        Approved
                                    </button>
                                `;
                            } else {
                                // Pending: Red button
                                return `
                                    <button
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                        onclick="updateStatus(${row.id}, true)">
                                        Pending
                                    </button>
                                `;
                            }
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

        function updateStatus(id, status) {
    // Example AJAX request to update status
    fetch(`/update-status/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ is_approved: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Status updated successfully!');
            // Reload the table to reflect changes
            $('#UserTable').DataTable().ajax.reload();
        } else {
            alert('Failed to update status!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

    </script>
</x-app-layout>

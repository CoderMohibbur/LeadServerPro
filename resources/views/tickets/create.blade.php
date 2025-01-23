<x-app-layout>
    <x-slot name="header">
        <!-- Back to Tickets Button -->
        <div class="flex justify-between items-center">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Ticket') }}
            </h1>
            <a href="{{ route('tickets.index') }}"
                class="inline-block px-6 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 transition">
                &larr; Back to Tickets
            </a>
        </div>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <!-- Form Section -->
            <div class="bg-white dark:bg-gray-900 rounded-lg p-6 shadow">
                @if ($errors->any())
                    <div class="mb-4 p-4 text-red-700 bg-red-100 border border-red-200 rounded-lg dark:bg-red-900 dark:text-red-200">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route(auth()->user()->hasRole('admin') ? 'tickets.store' : 'client.tickets.store') }}" method="POST">
                    @csrf

                    <div>
                         <!-- Title Input -->
                        <div class="mb-6">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                class="block w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter ticket title"
                                required>
                        </div>

                        <!-- Description Input -->
                        <div class="mb-6">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                class="block w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Provide a detailed description"
                                required></textarea>
                        </div>
                    </div>


                    <!-- Submit Button -->
                    <div class="text-right">
                        <button
                            type="submit"
                            class="px-6 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-600 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 transition">
                            Create Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // JavaScript Debugging: Log form data to console before submission
        document.querySelector('form').addEventListener('submit', function(event) {
            // Log the title and description to console for debugging
            console.log('Form submission detected!');
            console.log('Title:', document.getElementById('title').value);
            console.log('Description:', document.getElementById('description').value);

            // Optional: Check if fields are filled before submitting
            if (!document.getElementById('title').value || !document.getElementById('description').value) {
                console.log('Error: Title or Description is missing');
            }
        });
    </script>
    @endpush
</x-app-layout>

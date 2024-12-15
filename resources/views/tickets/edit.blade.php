<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Ticket') }}
        </h2>
    </x-slot>

    <div class="p-6 sm:ml-64">
        <div class="p-4 border border-gray-300 rounded-lg bg-white dark:bg-gray-800">
            <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" id="ticket-form">
                @csrf
                @method('PUT') <!-- Use PUT for update -->

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $ticket->title) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <option value="Open" @if($ticket->status == 'Open') selected @endif>Open</option>
                        <option value="In Progress" @if($ticket->status == 'In Progress') selected @endif>In Progress</option>
                        <option value="Closed" @if($ticket->status == 'Closed') selected @endif>Closed</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="inline-block px-6 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 transition">
                        Update Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // JavaScript Debugging: Log form data to console before submission
        document.getElementById('ticket-form').addEventListener('submit', function(event) {
            // Log the title and status to console for debugging
            console.log('Form submission detected!');
            console.log('Title:', document.getElementById('title').value);
            console.log('Status:', document.getElementById('status').value);

            // Optional: Check if fields are filled before submitting
            if (!document.getElementById('title').value || !document.getElementById('status').value) {
                console.log('Error: Title or Status is missing');
            }
        });
    </script>
    @endpush
</x-app-layout>

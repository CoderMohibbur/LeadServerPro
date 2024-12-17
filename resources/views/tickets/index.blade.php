<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket Lists') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <!-- Create Ticket Button -->
            <div class="mb-6 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Lists</h1>
                <a href="{{ route('tickets.create') }}"
                    class="inline-block px-6 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 transition">
                    Create Support Ticket
                </a>
            </div>

            <!-- Tickets Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse border border-gray-200 dark:border-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="py-3 px-6 text-sm font-semibold border border-gray-200 dark:border-gray-700">Title</th>
                            <th class="py-3 px-6 text-sm font-semibold border border-gray-200 dark:border-gray-700">Status</th>
                            <th class="py-3 px-6 text-sm font-semibold border border-gray-200 dark:border-gray-700">Created At</th>
                            <th class="py-3 px-6 text-sm font-semibold border border-gray-200 dark:border-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800 dark:text-gray-200">
                        @forelse ($tickets as $ticket)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="py-3 px-6 border border-gray-200 dark:border-gray-700">{{ $ticket->title }}</td>
                                <td class="py-3 px-6 border border-gray-200 dark:border-gray-700">
                                    <span class="px-3 py-1 text-sm font-medium rounded-full
                                        @if($ticket->status === 'Open') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                        @elseif($ticket->status === 'In Progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                        @else bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100 @endif">
                                        {{ $ticket->status }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 border border-gray-200 dark:border-gray-700">{{ $ticket->created_at->format('d M Y') }}</td>
                                <td class="py-3 px-6 border border-gray-200 dark:border-gray-700">
                                    <!-- Edit, Delete, and Answer buttons -->
                                    <a href="{{ route('tickets.edit', $ticket->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a> |
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form> |
                                    <a href="{{ route('tickets.answer', $ticket->id) }}" class="text-green-500 hover:text-green-700">Answer</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-3 px-6 text-center border border-gray-200 dark:border-gray-700">No tickets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Debugging: Log all ticket data to console
        console.log('Tickets:', @json($tickets));

        // If no tickets are found
        @if($tickets->isEmpty())
            console.log('No tickets found in the database.');
        @endif
    </script>
    @endpush
</x-app-layout>

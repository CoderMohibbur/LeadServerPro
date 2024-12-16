<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <!-- Sidebar Content -->

        <li>
            <a href="/dashboard" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                    <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3">Dashboard</span>
            </a>
        </li>

        <!-- Filter Section -->
        <div class="flex flex-col md:flex-row mt-8">
            <!-- Filter Column -->
            <div class="w-full md:w-2/2 bg-gray shadow-lg rounded-lg p-6 space-y-6">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l-4-4m0 0l4-4m-4 4h16" />
                    </svg>
                    Filters
                </h2>
                <form action="" method="GET">
                    @php
                        $filters = [
                            'linkedin_link' => 'LinkedIn Link',
                            'company_name' => 'Company Name',
                            'contact_name' => 'Contact Name',
                            'email' => 'Email Address',
                            'title_position' => 'Title/Position',
                            'country' => 'Country',
                        ];
                    @endphp

                    <div class="space-y-4">
                        @foreach ($filters as $name => $label)
                            <div>
                                <label for="{{ $name }}" class="block text-sm font-semibold text-gray-600 dark:text-gray-300">{{ $label }}</label>
                                <input
                                    type="text"
                                    id="{{ $name }}"
                                    name="{{ $name }}"
                                    class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                                    placeholder="Enter {{ $label }}">
                            </div>
                        @endforeach
                    </div>

                    <button type="submit"
                        class="bg-blue-500 text-white font-medium py-3 px-6 rounded-lg w-full shadow-md hover:bg-blue-600 transition duration-300 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-500">
                        Apply Filters
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>

<script>
    // JavaScript to toggle dark mode and store the preference
    const themeToggleBtn = document.getElementById('theme-toggle'); // Button to toggle theme
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    function applyTheme() {
        const systemDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const savedTheme = localStorage.getItem('theme');

        if (savedTheme) {
            document.documentElement.classList.toggle('dark', savedTheme === 'dark');
        } else if (systemDarkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        if (document.documentElement.classList.contains('dark')) {
            darkIcon.classList.remove('hidden');
            lightIcon.classList.add('hidden');
        } else {
            darkIcon.classList.add('hidden');
            lightIcon.classList.remove('hidden');
        }
    }

    themeToggleBtn.addEventListener('click', () => {
        const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        if (currentTheme === 'dark') {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
        applyTheme();
    });

    // Initialize theme on page load
    applyTheme();
</script>

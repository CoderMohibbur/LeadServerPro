<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar" aria-hidden="false">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <!-- Sidebar Content -->
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/dashboard"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                      </svg>
                    <span class="ms-3">Bank To Home</span>
                </a>
            </li>
        </ul>

        <!-- Filter Section -->
        <div class="flex flex-col md:flex-row ">
            <!-- Filter Column -->
            <div class="w-full md:w-2/2 bg-gray shadow-lg rounded-lg space-y-6">
                <div>
                    <label for="linkedin">LinkedIn Link</label>
                    <input type="text" id="linkedin" class="filter-input" data-field="linkedin_link" placeholder="Enter LinkedIn Link" />
                    <div id="linkedin-dropdown" class="dropdown"></div>
                </div>
                <div>
                    <label for="company">Company Name</label>
                    <input type="text" id="company" class="filter-input" data-field="company_name" placeholder="Enter Company Name" />
                    <div id="company-dropdown" class="dropdown"></div>
                </div>
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
                                <label for="{{ $name }}"
                                    class="block text-sm font-semibold text-gray-600 dark:text-gray-300">{{ $label }}</label>
                                <input type="text" id="{{ $name }}" name="{{ $name }}"
                                    class="w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                                    placeholder="Enter {{ $label }}">
                            </div>
                        @endforeach
                    </div>

                    <button type="submit"
                        class="bg-blue-500 text-white font-medium py-3 px-6 mt-4 rounded-lg w-full shadow-md hover:bg-blue-600 transition duration-300 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-500">
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
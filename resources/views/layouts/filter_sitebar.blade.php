<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-30 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <!-- Sidebar Content -->
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route(auth()->user()->hasRole('admin') ? 'sheets.index' : 'client.sheets.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14M5 12l4-4m-4 4 4 4" />
                    </svg>
                    <span class="ms-3">Bank To Home</span>
                </a>
            </li>
        </ul>

        <!-- Filter Section -->
        <div class="flex flex-col md:flex-row ">
            <!-- Filter Column -->
            <div class="w-full md:w-2/2 bg-gray-100 dark:bg-gray-800 shadow-lg rounded-lg space-y-6">
                {{-- <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Title
                </label>
                <div style="margin-top: 5px" class="flex flex-row flex-wrap mt-0">
                    @foreach ($leads as $key => $label)
                        <div class="p-1 border border-gray-500 border-separate">
                            <input type="checkbox" name="category_id[]" value="{{ $key }}"
                                id="category-{{ $key }}"
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">

                            <label for="category-{{ $key }}"
                                class="text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ $label->first_name }}
                            </label>
                        </div>
                    @endforeach
                </div> --}}

                <div id="filtersContainer">
                    <div>
                        <label for="linkedin_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Linkedin Link
                        </label>
                        <input type="link" name="linkedin_link" id="linkedin_link" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>
                    <div>
                        <label for="industry" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Industry
                        </label>
                        <input type="link" name="industry" id="industry" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>
                    <div>
                        <label for="contact_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Contact Name
                        </label>
                        <input type="text" name="contact_name" id="contact_name" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>

                    <div class="hidden">
                        <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            First Name
                        </label>
                        <input type="text" name="first_name" id="first_name" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>

                    <div class="hidden">
                        <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Last Name
                        </label>
                        <input type="text" name="last_name" id="last_name" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>

                    <div class="hidden">
                        <label for="full_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Full Name
                        </label>
                        <input type="text" name="full_name" id="full_name" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>

                    <div>
                        <label for="person_location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Person Location
                        </label>
                        <input type="text" name="person_location" id="person_location" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>

                    <div class="hidden">
                        <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            City
                        </label>
                        <input type="text" name="city" id="city" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>
                    <div>
                        <label for="tag" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tag
                        </label>
                        <input type="text" name="tag" id="tag" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>

                    <div class="hidden">
                        <label for="source_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Source Link
                        </label>
                        <input type="text" name="source_link" id="source_link" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>
                    <div class="hidden">
                        <label for="personal_phone"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Personal Phone
                        </label>
                        <input type="text" name="personal_phone" id="personal_phone"
                            placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>
                    <div>
                        <label for="company_website"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Company Website
                        </label>
                        <input type="text" name="company_website" id="company_website"
                            placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>
                    <div class="hidden">
                        <label for="company_linkedin_link"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Company Linkedin Link
                        </label>
                        <input type="text" name="company_linkedin_link" id="company_linkedin_link"
                            placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>
                    <div>
                        <label for="company_hq_address"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Company HQ Address
                        </label>
                        <input type="text" name="company_hq_address" id="company_hq_address"
                            placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>
                    <div class="hidden">
                        <label for="zip_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Zip Code
                        </label>
                        <input type="text" name="zip_code" id="zip_code" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>
                    <div>
                        <label for="job_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Job Link
                        </label>
                        <input type="text" name="job_link" id="job_link" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>
                    <div class="hidden">
                        <label for="sheet_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Sheet Name
                        </label>
                        <input type="text" name="sheet_name" id="sheet_name" placeholder="Type and Select"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 tagify">
                    </div>
                </div>
                <button id="removeAllTagsButton"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-500 dark:text-gray-200 dark:hover:bg-gray-700 transition">
                    Remove All Tags
                </button>
                <input type="text" id="sheetIdFilter" class="form-input hidden" placeholder="Enter Sheet ID"
                    readonly />
                <input type="text" id="userIdFilter" class="form-input hidden" placeholder="Enter User ID"
                    readonly />

                <script>
                    // লগইন করা ইউজারের রোল এবং আইডি Blade থেকে পাস করা হচ্ছে
                    const userRole = "{{ auth()->user()->getRoleNames()->first() }}"; // ইউজারের রোল
                    const userId = "{{ auth()->user()->id }}"; // ইউজারের আইডি

                    // রোল চেক করে ইনপুট ফিল্ড আপডেট
                    if (userRole === 'user') {
                        const userIdFilter = document.getElementById('userIdFilter');
                        userIdFilter.value = userId;
                        // userIdFilter.classList.remove('hidden'); // hidden ক্লাস সরিয়ে ফেলা
                    }
                </script>
                {{-- <div id="filtersContainer"></div> --}}

                {{-- <script>
                    // Fetch filter values dynamically
                    fetch('/leads/filters')
                        .then(response => response.json())
                        .then(data => {
                            const container = document.getElementById('filtersContainer');

                            // Iterate over each column
                            Object.keys(data).forEach(column => {
                                const values = data[column];

                                if (values && values.length > 0) {
                                    // Create a wrapper div for the column
                                    const columnDiv = document.createElement('div');
                                    columnDiv.className = "mb-4";

                                    // Add a label for the column
                                    const label = document.createElement('label');
                                    label.className = "block text-sm font-medium text-gray-700 dark:text-gray-300";
                                    label.textContent = column.replace(/_/g, ' ').toUpperCase();
                                    columnDiv.appendChild(label);

                                    // Add checkboxes for each value
                                    const checkboxesDiv = document.createElement('div');
                                    checkboxesDiv.className = "flex flex-row flex-wrap mt-2";

                                    values.forEach(value => {
                                        const checkboxWrapper = document.createElement('div');
                                        checkboxWrapper.className = "p-1 border border-gray-500 border-separate";

                                        const checkbox = document.createElement('input');
                                        checkbox.type = "checkbox";
                                        checkbox.name = `${column}[]`;
                                        checkbox.value = value;
                                        checkbox.className =
                                            "h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600";

                                        const checkboxLabel = document.createElement('label');
                                        checkboxLabel.textContent = value;
                                        checkboxLabel.className =
                                            "ml-2 text-sm font-medium text-gray-900 dark:text-gray-300";

                                        checkboxWrapper.appendChild(checkbox);
                                        checkboxWrapper.appendChild(checkboxLabel);
                                        checkboxesDiv.appendChild(checkboxWrapper);
                                    });

                                    columnDiv.appendChild(checkboxesDiv);
                                    container.appendChild(columnDiv);
                                }
                            });
                        })
                        .catch(error => console.error('Error fetching filter values:', error));
                </script> --}}
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

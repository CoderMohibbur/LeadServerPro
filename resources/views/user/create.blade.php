<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users List') }}
        </h1>
    </x-slot>
    <div class="p-4 sm:ml-64">
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
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
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
                        <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                        <select id="country" name="country"
                            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500">
                            <option selected>United States</option>
                            <option value="UK">United Kingdom</option>
                            <option value="AU">Australia</option>
                            <option value="DE">Germany</option>
                            <option value="CA">Canada</option>
                            <option value="BD">Bangladesh</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AG">Antigua and Barbuda</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia</option>
                            <option value="BA">Bosnia and Herzegovina</option>
                            <option value="BW">Botswana</option>
                            <option value="BR">Brazil</option>
                            <option value="BN">Brunei</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CD">Democratic Republic of the Congo</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Côte d'Ivoire</option>
                            <option value="HR">Croatia</option>
                            <option value="CU">Cuba</option>
                            <option value="CW">Curaçao</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="SZ">Eswatini</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">North Korea</option>
                            <option value="KR">South Korea</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Laos</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macau</option>
                            <option value="MK">North Macedonia</option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="FM">Micronesia</option>
                            <option value="MD">Moldova</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="ME">Montenegro</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                        </select>
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
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">LinkedIn URL</label>
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
                    <button type="button" onclick="window.location.href='{{ route('User.index') }}'"
                        class="px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                        Back to List
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

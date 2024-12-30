<x-admin-layout title="Tambah User Baru">

    <div class=" mx-auto p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            {{-- page title --}}
            <h2 class="text-2xl font-semibold text-gray-700">Tambah User Baru</h2>
            {{-- back button --}}
            <a href=""
                class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-4 py-2 rounded hover:to-orange-500">Kembali</a>
        </div>


        {{-- form --}}
        <form action="{{ route('addUser.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-4" onsubmit="return validateForm()">
            @csrf

            {{-- Alert --}}
            @if (session('success'))
                <x-ui.alert type="success" :message="session('success')" />
            @elseif ($errors->any())
                @foreach ($errors->all() as $error)
                    <x-ui.alert type="error" :message="$error" />
                @endforeach
            @endif
            {{-- name --}}
            <div>
                <label for="fullname" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="fullname" id="fullname"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('fullname') }}" required>
            </div>

            {{-- email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('email') }}" required>
            </div>

            {{-- No HP --}}
            <div>
                <label for="noHP" class="block text-sm font-medium text-gray-700">No HP</label>
                <input type="text" name="nohp" id="nohp"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('nohp') }}" required oninput="validatePhoneNumber(this)">
            </div>

            {{-- No WA --}}
            <div>
                <label for="noWA" class="block text-sm font-medium text-gray-700">No WA</label>
                <input type="text" name="noWA" id="noWA"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('noWA') }}" required oninput="validatePhoneNumber(this)">
            </div>

            {{-- password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    required oninput="validatePassword(this)"/>
                <p id="password-error" class="text-red-500 text-sm mt-1 hidden">Password must be at least 8 characters long.</p>
            </div>

            {{-- role --}}
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Agent/User</option>
                    <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            {{-- submit --}}
            <button type="submit"
                class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-4 py-2 rounded hover:to-orange-500">Simpan</button>
        </form>
    </div>

    <script>
        function validatePassword(input) {
            const errorElement = document.getElementById('password-error');
            if (input.value.length < 8) {
                errorElement.classList.remove('hidden');
            } else {
                errorElement.classList.add('hidden');
            }
        }

        function validatePhoneNumber(input) {
            // Remove any non-numeric characters
            let value = input.value.replace(/\D/g, '');

            // If the user is deleting and the field becomes empty, stop adding "62"
            if (value === '') {
                input.value = ''; // Allow the input to remain empty
                input.setCustomValidity('');
                return;
            }

            // Ensure the number starts with "62"
            if (!value.startsWith('62')) {
                value = '62' + value;
            }

            // Limit the maximum length to 13 characters
            if (value.length > 13) {
                value = value.slice(0, 13);
            }

            // Update the input value
            input.value = value;

            // Clear any validation messages
            input.setCustomValidity('');
        }

        function validateForm() {
            const passwordInput = document.getElementById('password');
            const errorElement = document.getElementById('password-error');

            if (passwordInput.value.length < 8) {
                errorElement.classList.remove('hidden');
                passwordInput.focus(); // Focus the password field for user correction
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>

</x-admin-layout>

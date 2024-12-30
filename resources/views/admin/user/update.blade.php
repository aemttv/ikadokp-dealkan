<x-admin-layout>

    <div class=" mx-auto p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            {{-- page title --}}
            <h2 class="text-2xl font-semibold text-gray-700">Ubah User</h2>
            {{-- back button --}}
            <a href="{{ route('admin-users.profil') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kembali</a>
        </div>

        {{-- Alert --}}
        @if ($errors->any())
            <div class="">
                <ul>
                    @foreach ($errors->all() as $error)
                        <x-ui.alert type="error" :message="$error" />
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- form --}}
        <form action="{{route('updateUser.submit', $user->id)}}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- name --}}
            <div>
                <label for="fullname" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="fullname" id="fullname"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('fullname', $user->name) }}" required>
            </div>

            {{-- email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            {{-- no hp --}}
            <div>
                <label for="nohp" class="block text-sm font-medium text-gray-700">No HP</label>
                <input type="text" name="nohp" id="nohp"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('nohp', $user->nohp) }}" required oninput="validatePhoneNumber(this)">
            </div>

            {{-- no wa --}}
            <div>
                <label for="noWA" class="block text-sm font-medium text-gray-700">No WA</label>
                <input type="text" name="noWA" id="noWA"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value="{{ old('nowa', $user->nowa) }}" required oninput="validatePhoneNumber(this)">
            </div>

            {{-- password --}}
            <div class="relative">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer"
                    onclick="togglePasswordVisibility('password')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </span>
                <small class="text-gray-500">Kosongkan jika tidak ingin mengganti password</small>
            </div>

            {{-- role --}}
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="1" {{ old('role', $user->role) == '1' ? 'selected' : '' }}>User/Agen</option>
                    <option value="0" {{ old('role', $user->role) == '0' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            {{-- submit --}}
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
        </form>
    </div>

    <script>
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

        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
        }

        document.getElementById('nohp').addEventListener('input', function() {
            const phoneNumber = this.value;
            const regex = /^\+62\d*$/;
            if (!regex.test(phoneNumber)) {
                this.value = phoneNumber.replace(/[^0-9]/g, '');
            }
        });

        document.getElementById('noWA').addEventListener('input', function() {
            const phoneNumber = this.value;
            const regex = /^\+62\d*$/;
            if (!regex.test(phoneNumber)) {
                this.value = phoneNumber.replace(/[^0-9]/g, '');
            }
        });
    </script>

</x-admin-layout>

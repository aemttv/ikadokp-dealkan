<x-layout title="editProfil">
    <div class="flex flex-col items-center my-20 mx-auto max-w-4xl space-y-8 p-4">
        <form action="{{ route('user.edit', Auth::user()->id) }}" method="POST" id="profile-form"
            enctype="multipart/form-data"
            class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-8 w-full">
            @csrf

            <!-- Profile Picture -->
            <div class="flex flex-col items-center">
                <!-- Heading -->
                <h2 class="text-xl font-semibold text-gray-700 mb-2 text-left">Profile Picture</h2>
                <label for="profile-picture-input" class="cursor-pointer relative">
                    <div class="relative">
                        @if (Auth::user()->image)
                            <img id="profile-picture-preview" src="{{ asset('assets/' . Auth::user()->image) }}"
                                alt="Profile Picture" class="h-32 w-32 md:h-52 md:w-52 rounded-full object-cover shadow"
                                style="min-height: 128px; min-width: 128px;">
                        @else
                            <!-- Default SVG if no image is uploaded -->
                            <svg id="profile-picture-placeholder" class="h-32 w-32 md:h-52 md:w-52 rounded-full shadow"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        @endif
                        <!-- Camera Icon -->
                        <div
                            class="absolute bottom-0 right-0 bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-full p-2 shadow transform translate-x-1 translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                    </div>
                </label>
                <input type="file" id="profile-picture-input" name="image" class="hidden" accept="image/*">
            </div>

            <!-- Form Fields -->
            <div class="w-full">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Full Name</label>
                    <input type="text" name="fullname"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        value="{{ Auth::user()->name ?? '' }}">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        value="{{ Auth::user()->email ?? '' }}" oninput="validatePhoneNumber(this)">
                </div>
                <div class="mb-4 flex flex-col md:flex-row md:space-x-4">
                    <div class="w-full md:w-1/2">
                        <label class="block text-sm font-medium mb-1">No.HP</label>
                        <input type="text" name="nohp" id="nohp"
                            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            value="{{ Auth::user()->nohp ?? '' }}" oninput="validatePhoneNumber(this)">
                    </div>
                    <div class="w-full md:w-1/2">
                        <label class="block text-sm font-medium mb-1">No.WA</label>
                        <input type="text" name="noWA" id="noWA"
                            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            value="{{ Auth::user()->nowa ?? '' }}">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">New Password</label>
                    <div class="relative">
                        <input type="password" id="new-password-input"
                            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="Enter new password" name="password"
                            oninput="toggleConfirmPasswordVisibility()" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 cursor-pointer"
                            onclick="togglePasswordVisibility('new-password-input')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="mb-4" id="confirm-password-container" style="display: none;">
                    <label class="block text-sm font-medium mb-1">Confirm New Password</label>
                    <div class="relative">
                        <input type="password" id="confirm-password-input"
                            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="Enter new password" name="password_confirmation" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 cursor-pointer"
                            onclick="togglePasswordVisibility('confirm-password-input')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-6 py-3 rounded-lg shadow hover:to-orange-500 focus:ring-2 focus:ring-blue-400">Save
                        Changes</button>
                    <a href="{{ route('user.profil', Auth::user()->id) }}"
                        class="bg-gray-600 text-white px-6 py-3 rounded-lg shadow hover:bg-gray-700 focus:ring-2 focus:ring-gray-400">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <style>
        .invalid {
            border: 1px solid red;
            background-color: #f2dede;
        }
    </style>

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

        function toggleEditMode() {
            const profileView = document.getElementById('profile-view');
            const profileEdit = document.getElementById('profile-edit');
            const profilePictureInput = document.getElementById('profile-picture-input');

            profileView.classList.toggle('hidden');
            profileEdit.classList.toggle('hidden');

            // Enable or disable the file input based on the current mode
            profilePictureInput.disabled = profileEdit.classList.contains('hidden');
        }

        function toggleConfirmPasswordVisibility() {
            const newPasswordInput = document.getElementById('new-password-input');
            const confirmPasswordContainer = document.getElementById('confirm-password-container');
            if (newPasswordInput.value.trim() !== '') {
                confirmPasswordContainer.style.display = 'block';
            } else {
                confirmPasswordContainer.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('profile-form');
            const saveButton = document.getElementById('save-button');
            const initialFormData = new FormData(form);

            form.addEventListener('input', function() {
                const currentFormData = new FormData(form);
                let isChanged = false;

                for (let [key, value] of currentFormData.entries()) {
                    if (value !== initialFormData.get(key)) {
                        isChanged = true;
                        break;
                    }
                }

                saveButton.disabled = !isChanged;
                saveButton.classList.toggle('disabled:opacity-50', !isChanged);
            });
        });

        const profilePictureInput = document.getElementById('profile-picture-input');
        const profilePictureLabel = document.querySelector('label[for="profile-picture-input"]');

        profilePictureInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = (event) => {
                const imageData = event.target.result;
                profilePictureLabel.innerHTML = `
    <img src="${imageData}" class="h-20 w-20 rounded-full">
    `;
            };

            reader.readAsDataURL(file);
        });

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
</x-layout>

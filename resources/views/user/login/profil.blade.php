<x-layout title="profil">
    {{-- <div class="flex justify-center space-x-8 my-20 mx-auto max-w-4xl">
        <!-- Profile Details Card -->
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-xl">
            <h2 class="text-2xl font-bold mb-6">Edit Profile</h2>
            @if (Auth::check())
                <form action="{{ route('user.edit', Auth::user()->id) }}" method="POST" id="profile-form"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Profile Picture -->
                    <div class="relative">
                        <label for="profile-picture-input" class="cursor-pointer">
                            <div class="relative">
                                <img id="profile-picture-preview" src="https://via.placeholder.com/150"
                                    alt="Profile Picture"
                                    class="h-32 w-32 md:h-52 md:w-52 md:ml-10 rounded-full object-cover shadow">
                                <!-- Camera Icon -->
                                <div
                                    class="absolute bottom-0 right-0 bg-blue-600 text-white rounded-full p-2 shadow transform translate-x-1 translate-y-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </div>
                            </div>
                        </label>
                        <input type="file" id="profile-picture-input" name="profile_picture" class="hidden"
                            accept="image/*">
                    </div>
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
                            value="{{ Auth::user()->email ?? '' }}">
                    </div>
                    <div class="mb-4 flex space-x-4">
                        <div class="w-1/2">
                            <label class="block text-sm font-medium mb-1">No.HP</label>
                            <input type="text" name="nohp"
                                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                                value="{{ Auth::user()->nohp ?? '' }}">
                        </div>
                        <div class="w-1/2">
                            <label class="block text-sm font-medium mb-1">No.WA</label>
                            <input type="text" name="noWA"
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
                    <div class="flex justify-between">
                        <button type="button" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</button>
                        <button type="submit" id="save-button"
                            class="bg-orange-500 text-white px-4 py-2 rounded disabled:opacity-50" disabled>Save</button>
                    </div>
                </form>
            @endif
        </div>

        <!-- Profile Picture Card -->
        <div class="bg-white p-8 rounded-lg shadow-lg w-1/2 max-w-xs flex justify-center items-center">
            <div class="flex flex-col items-center">
                <label for="profile-picture-input" class="cursor-pointer relative">
                    @if (Auth::user()->image)
                        <img id="profile-picture-preview" src="{{ asset('assets/' . Auth::user()->image) }}"
                            class="h-40 w-40 object-cover" alt="Profile Picture">
                    @else
                        <!-- Default SVG if no image is uploaded -->
                        <svg id="profile-picture-placeholder" class="h-40 w-40"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    @endif
                </label>
                <input type="file" id="profile-picture-input" name="image" class="hidden" multiple>
            </div>
        </div>
    </div> --}}

    @if (Auth::check())
        <div class="flex flex-col items-center my-20 mx-auto max-w-4xl space-y-8">
            <!-- Profile Section -->
            <div
                class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                <!-- Profile Picture -->
                <div class="flex flex-col items-center">
                    <!-- Heading -->
                    <h2 class="text-2xl font-semibold text-gray-700 mb-2 text-left">Profile</h2>
                    <label for="profile-picture-input" class=" relative">
                        <div class="relative">
                            @if (Auth::user()->image)
                                <img id="profile-picture-preview" src="{{ asset('assets/' . Auth::user()->image) }}"
                                    alt="Profile Picture"
                                    class="h-32 w-32 md:h-52 md:w-52 rounded-full object-cover shadow"
                                    style="min-height: 128px; min-width: 128px;">
                            @else
                                <!-- Default SVG if no image is uploaded -->
                                <svg id="profile-picture-placeholder"
                                    class="h-32 w-32 md:h-52 md:w-52 rounded-full shadow"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            @endif
                            <!-- Camera Icon -->
                            <div
                                class="absolute bottom-0 right-0 bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-full p-2 shadow transform translate-x-1 translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </div>
                        </div>
                    </label>
                    <input type="file" id="profile-picture-input" name="profile_picture" class="hidden"
                        accept="image/*" disabled>
                </div>


                <!-- Profile Details -->
                <div class="flex-1 text-center md:text-left">
                    <div id="profile-view">
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Full Name</label>
                            <p class="text-sm text-gray-700">{{ Auth::user()->name ?? '' }}</p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <p class="text-sm text-gray-700">{{ Auth::user()->email ?? '' }}</p>
                        </div>
                        <div class="mb-4 flex flex-col md:flex-row md:space-x-4">
                            <div class="w-full md:w-1/2">
                                <label class="block text-sm font-medium mb-1">No.HP</label>
                                <p class="text-sm text-gray-700">{{ Auth::user()->nohp ?? '' }}</p>
                            </div>
                            <div class="w-full md:w-1/2">
                                <label class="block text-sm font-medium mb-1">No.WA</label>
                                <p class="text-sm text-gray-700">{{ Auth::user()->nowa ?? '' }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('user.profil.edit', Auth::user()->id) }}"
                                class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-6 py-3 rounded-lg shadow hover:to-orange-500 focus:ring-2 focus:ring-blue-400">
                                Edit Profile
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <style>
        /* Style for the disabled button */
        .disabled:opacity-50 {
            background-color: #e2e8f0;
            /* Tailwind's gray-200 */
            cursor: not-allowed;
        }

        .fixed-size {
            height: 128px;
            /* Fixed height */
            width: 128px;
            /* Fixed width */
            object-fit: cover;
            /* Maintain aspect ratio */
        }
    </style>

    <script>
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
    </script>
</x-layout>

<x-layout title="Update Primary">
    @if (Auth::check())
        <form class="max-w-md mt-20 mx-auto" action="{{ route('updatePrimaryUser.submit', $property->listingID) }}"
            method="POST" enctype="multipart/form-data">
            @csrf <!-- Include this for CSRF protection -->

            <div class="flex flex-col items-start space-y-4">
                <h1 class="text-xl font-bold">Update Primary Listing No. {{ $property->listingID }}</h1>
                <div class="w-full">
                    {{-- Alert --}}
                    @if (session('success'))
                        <x-ui.alert type="success" :message="session('success')" />
                    @elseif ($errors->any())
                        @foreach ($errors->all() as $error)
                            <x-ui.alert type="error" :message="$error" />
                        @endforeach
                    @endif
                </div>
                <div class="flex mb-5">
                    <!-- Large image upload box -->
                    <label for="large-image"
                        class="flex items-center text-center justify-center w-80 h-36 border-2 border-dashed rounded-lg bg-gray-50 text-gray-500 cursor-pointer relative">
                        @if ($property->image_main)
                            <img id="large-image-preview" class="absolute inset-0 w-full h-full object-cover"
                                src="{{ asset('assets/' . $property->image_main) }}" />
                        @else
                            <span id="large-image-placeholder">+<br>Masukkan Gambar</span>
                            <img id="large-image-preview" class="absolute inset-0 w-full h-full object-cover" />
                        @endif
                        <input id="large-image" type="file" accept="image/*" class="hidden"
                            onchange="handleFileUpload(event, 'large-image-preview', 'large-image-placeholder')"
                            name="image_main" />
                    </label>

                    <!-- Small image upload boxes -->
                    <div class="flex flex-col space-y-2 ml-4">
                        <label for="small-image-1"
                            class="flex items-center justify-center w-28 h-[68px] border-2 border-dashed rounded-lg bg-gray-50 text-gray-500 cursor-pointer relative">
                            @if ($property->image_second)
                                <img id="small-image-1-preview" class="absolute inset-0 w-full h-full object-cover"
                                    src="{{ asset('assets/' . $property->image_second) }}" />
                            @else
                                <span id="small-image-1-placeholder">+</span>
                                <img id="small-image-1-preview"
                                    class="absolute inset-0 w-full h-full object-cover hidden" />
                            @endif
                            <input id="small-image-1" type="file" accept="image/*" class="hidden"
                                onchange="handleFileUpload(event, 'small-image-1-preview', 'small-image-1-placeholder')"
                                name="image_second" />
                        </label>
                        <label for="small-image-2"
                            class="flex items-center justify-center w-28 h-[68px] border-2 border-dashed rounded-lg bg-gray-50 text-gray-500 cursor-pointer relative">
                            @if ($property->image_third)
                                <img id="small-image-2-preview" class="absolute inset-0 w-full h-full object-cover"
                                    src="{{ asset('assets/' . $property->image_third) }}" />
                            @else
                                <span id="small-image-2-placeholder">+</span>
                                <img id="small-image-2-preview"
                                    class="absolute inset-0 w-full h-full object-cover hidden" />
                            @endif
                            <input id="small-image-2" type="file" accept="image/*" class="hidden"
                                onchange="handleFileUpload(event, 'small-image-2-preview', 'small-image-2-placeholder')"
                                name="image_third" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="relative z-0 w-full mt-5 mb-5 group">
                <input type="text" name="title" id="floating_title"
                    class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                    placeholder=" " required value="{{ $property->title ?? '' }}" />
                <label for="floating_title"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
            </div>

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 mb-5 group">
                    <input type="number" name="hargaJual" id="floating_hargaJual"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        placeholder=" " required min="150000000" step="10000" max="999999999999999" placeholder="Rp."
                        value="{{ $property->hargaJual ?? '' }}" />
                    <label for="floating_hargaJual"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Harga
                        Mulai</label>
                </div>
                <div class="relative z-0 w-1/2 mb-5 group">
                    <input type="number" name="hargaJualMax" id="floating_hargaJual"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        placeholder=" " min="150000000" step="10000" max="999999999999999" placeholder="Rp."
                        value="{{ $property->hargaJualMax ?? '' }}" />
                    <label for="floating_hargaJualMax"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Harga
                        Maximum</label>
                </div>
            </div>
            <div class="relative z-0 w-full group mb-5">
                <select name="orientasiID" id="floating_orientasiID"
                    class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                    required>
                    <option value="1" {{ $property->orientasiID == 1 ? 'selected' : '' }}>Barat</option>
                    <option value="2" {{ $property->orientasiID == 2 ? 'selected' : '' }}>Selatan</option>
                    <option value="3" {{ $property->orientasiID == 3 ? 'selected' : '' }}>Timur</option>
                    <option value="4" {{ $property->orientasiID == 4 ? 'selected' : '' }}>Utara</option>
                </select>
                <label for="floating_orientasiID"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Orientasi</label>
            </div>

            {{-- <div class="relative z-0 w-full mb-5 group">
                <input type="url" name="link_drive" id="floating_linkDrive"
                    class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                    placeholder=" " value="{{ $property->link_drive ?? '' }}" required>
                <label for="floating_linkDrive"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Link
                    Drive</label>
            </div> --}}

            <div class="relative z-0 w-full mb-5 mt-5 group">
                <textarea type="text" name="deskripsi" id="floating_deskripsi"
                    class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer max-h-60 min-h-20"
                    placeholder=" " required>{{ $property->deskripsi }}</textarea>
                <label for="floating_deskripsi"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Deskripsi</label>
            </div>

            <div id="image_container">
                <!-- Images will be displayed here -->
            </div>

            <!-- Hidden input for statusListing -->
            <input type="hidden" name="statusListing" value="2">

            <button type="submit"
                class="w-full text-white mb-5 bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">Submit</button>
        </form>
    @else
        <div class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col items-center justify-center h-96 text-center">
            <!-- SVG Not Found -->
            <img src="{{ asset('assets/svg/not-found.svg') }}" alt="Not Found" class="mb-4 w-24 h-24" />
            <p class="text-lg font-semibold">Silakan Login Terlebih Dahulu.</p>

            <div class="mt-4">
                <a href="{{ url()->previous() }}"
                    class="inline-block  text-black border-b-2 border-orange-500 hover:text-orange-500 hover:border-orange-700 transition-colors">
                </a>
            </div>
        </div>
    @endif
    <script>
        function handleFileUpload(event, previewId, placeholderId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    const placeholder = document.getElementById(placeholderId);
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
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
    </script>
</x-layout>

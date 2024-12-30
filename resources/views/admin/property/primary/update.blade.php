<x-admin-layout>
    <div class=" mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            {{-- page title --}}
            <h2 class="text-2xl font-semibold text-gray-700">Update Primary Listing No. {{ $property->listingID }}</h2>
            {{-- back button --}}
            <a href="{{ route('propertyPrimary.view') }}"
                class="bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white px-4 py-2 rounded-lg">Kembali</a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <x-ui.alert type="success" :message="session('success')" />
        @elseif ($errors->any())
            @foreach ($errors->all() as $error)
                <x-ui.alert type="error" :message="$error" />
            @endforeach
        @endif

        {{-- form --}}
        <form class="max-w-sm mx-auto" action="{{ route('updatePrimary.submit', $property->listingID) }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            <label for="large-image" class="block text-sm font-medium text-gray-900 "> Gambar </label>
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
            <div class="mb-5">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Judul
                    Properti</label>
                <input type="name" id="title" name="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    value="{{ old('title', $property->title) }}" />
            </div>

            <div class="mb-5">
                <!-- Dropdown menu -->
                <div class="relative w-full group">
                    <a id="dropdown-button-agen"
                        class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        <span id="dropdown-label-agen" class="mr-2">Pilih Agen</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <div id="dropdown-menu-agen"
                        class="hidden absolute bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 p-2.5 rounded shadow-md mt-1 max-h-48 overflow-y-auto w-full z-10">
                        <!-- Search input -->
                        <input id="search-input-agen"
                            class="block w-full px-4 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 p-2.5 rounded-md  focus:outline-none"
                            type="text" placeholder="Search items" autocomplete="off">
                        <!-- Dropdown content -->
                        @foreach ($users as $user)
                            <a data-value="{{ $user->id }}" name="agentID"
                                class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">{{ $user->name }}</a>
                        @endforeach
                    </div>
                </div>

                <!-- Hidden Input (added dynamically) -->
                <input type="hidden" id="agentID" name="agentID" value="<?= htmlspecialchars($property->agentID) ?>">
            </div>

            <div class="flex space-x-4 mb-5">
                <div class="w-1/2 group">
                    <label for="hargaJual" class="block mb-2 text-sm font-medium text-gray-900 ">Harga Dimulai </label>
                    <input type="number" id="hargaJual" name="hargaJual"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="{{ old('hargaJual', $property->hargaJual) }}" min="0" step="10000"
                        max="999999999999999" />
                </div>
                <div class="w-1/2 group">
                    <label for="hargaJualMax" class="block mb-2 text-sm font-medium text-gray-900 ">Harga Maksimal
                    </label>
                    <input type="number" id="hargaJualMax" name="hargaJualMax"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        value="{{ $property->hargaJualMax }}" min="0" step="10000"
                        max="999999999999999" />
                </div>
            </div>
            <div class="mb-5">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Orientasi</label>
                <select name="orientasiID" id="floating_orientasiID"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="1" {{ $property->orientasiID == 1 ? 'selected' : '' }}>Barat</option>
                    <option value="2" {{ $property->orientasiID == 2 ? 'selected' : '' }}>Selatan</option>
                    <option value="3" {{ $property->orientasiID == 3 ? 'selected' : '' }}>Timur</option>
                    <option value="4" {{ $property->orientasiID == 4 ? 'selected' : '' }}>Utara</option>
                </select>
            </div>


            {{-- <div class="mb-5">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Link Drive</label>
                <input type="url" name="link_drive" id="floating_linkDrive"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder=" "
                    value="{{ old('link_drive', $property->link_drive) }}">
            </div> --}}

            <div class="mb-5">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Deskripsi
                    Properti</label>
                <textarea name="deskripsi" id="floating_deskripsi"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder=" ">{{ old('deskripsi', $property->deskripsi) }}</textarea>
            </div>

            <div class="mb-5">
                <label for="floating_statusListing"
                    class="block mb-2 text-sm font-medium text-gray-900">Status Keaktifan Listing</label>
                <select name="statusListing" id="floating_statusListing"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    <option value="1" {{ $property->statusListing == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $property->statusListing == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    <option value="2" {{ $property->statusListing == 2 ? 'selected' : '' }}>Menunggu Verifikasi</option>
                </select>
            </div>

            <button type="submit"
                class="text-white bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
        </form>
    </div>

    <script>
        //AGEN SEARCH
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdown-button-agen');
            const dropdownMenu = document.getElementById('dropdown-menu-agen');
            const dropdownItems = dropdownMenu.querySelectorAll('[data-value]');
            const dropdownText = dropdownButton.querySelector('span');
            const searchInput = document.getElementById('search-input-agen');
            const hiddenInput = document.getElementById('agentID'); // Hidden input field

            const initialValue = hiddenInput.value; // Get the initial value

            // Preselect the item based on lokasiID
            const selectedItem = [...dropdownItems].find(item => item.getAttribute('data-value') === initialValue);
            if (selectedItem) {
                dropdownText.textContent = selectedItem.textContent.trim();
            }

            // Toggle dropdown menu visibility
            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });

            // Handle item selection
            dropdownItems.forEach(item => {
                item.addEventListener('click', function() {
                    const selectedValue = this.getAttribute('data-value');
                    const selectedText = this.textContent.trim();

                    // Update button text
                    dropdownButton.innerHTML = `
                ${selectedText}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            `;

                    // Update hidden input value
                    hiddenInput.value = selectedValue;

                    // Close dropdown
                    dropdownMenu.classList.add('hidden');

                    // Optionally log the selected value
                    console.log(`Selected value: ${selectedValue}`);
                });
            });
            // Filter dropdown items based on search input
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const filter = searchInput.value.toLowerCase();
                    dropdownItems.forEach(item => {
                        const text = item.textContent.trim().toLowerCase();
                        if (text.includes(filter)) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });
                });
            }
        });

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
    </script>

</x-admin-layout>

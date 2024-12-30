<x-admin-layout>
    <div class=" mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            {{-- page title --}}
            <h2 class="text-2xl font-semibold text-gray-700">Tambah Buy Request Baru</h2>
            {{-- back button --}}
            <a href=""
                class="bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white px-4 py-2 rounded-lg">Kembali</a>
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
        <form class="max-w-sm mx-auto" action="{{route('requestBaru.submit', Auth::user()->id)}}" enctype="multipart/form-data" method="POST">
            @csrf

            <div class="mb-5">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Buyer Name</label>
                <input type="name" id="vendorName" name="vendorName"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    value="" required />
            </div>

            <label for="floating_alamat" class="block mb-2 text-sm font-medium text-gray-900">Lokasi</label>
            <div class="flex space-x-4 mb-5">
                <!-- Dropdown menu -->
                <div class="relative w-full group">
                    <a id="dropdown-button"
                        class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        <span id="dropdown-label" class="mr-2">Pilih Lokasi</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <div id="dropdown-menu"
                        class="hidden absolute bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 p-2.5 rounded shadow-md mt-1 max-h-48 overflow-y-auto w-full z-10">
                        <!-- Search input -->
                        <input id="search-input"
                            class="block w-full px-4 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 p-2.5 rounded-md  focus:outline-none"
                            type="text" placeholder="Search items" autocomplete="off">
                        <!-- Dropdown content -->
                        <a data-value="1" name="lokasiID"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Asemrowo</a>
                        <a data-value="2" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Benowo</a>
                        <a data-value="3" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Bubutan</a>
                        <a data-value="4" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Bulak</a>
                        <a data-value="5" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Dukuh
                            Pakis</a>
                        <a data-value="6" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Gayungan</a>
                        <a data-value="7" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Genteng</a>
                        <a data-value="8" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Gubeng</a>
                        <a data-value="9" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Gunung
                            Anyar</a>
                        <a data-value="10" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Jambangan</a>
                        <a data-value="11" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Karangpilang</a>
                        <a data-value="12" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Kenjeran</a>
                        <a data-value="13" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Krembangan</a>
                        <a data-value="14" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Lakarsantri</a>
                        <a data-value="15" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Mulyorejo</a>
                        <a data-value="16" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Pabean
                            Cantikan</a>
                        <a data-value="17" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Pakal</a>
                        <a data-value="18" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Rungkut</a>
                        <a data-value="19" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Sambikerep</a>
                        <a data-value="20" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Sawahan</a>
                        <a data-value="21" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Semampir</a>
                        <a data-value="22" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Simokerto</a>
                        <a data-value="23" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Sukolilo</a>
                        <a data-value="24" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Sukomanunggal</a>
                        <a data-value="25" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Tambaksari</a>
                        <a data-value="26" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Tandes</a>
                        <a data-value="27" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Tegalsari</a>
                        <a data-value="28" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Tenggilis
                            Mejoyo</a>
                        <a data-value="29" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Wiyung</a>
                        <a data-value="30" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Wonocolo</a>
                        <a data-value="31" name="lokasiID"
                            class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Wonokromo</a>
                    </div>
                </div>

                <!-- Hidden Input (added dynamically) -->
                <input type="hidden" name="lokasiID" id="lokasiID" value="lokasiID">
            </div>

            <!-- Hidden input for agentID -->
            <input type="hidden" name="agentID" value="{{ Auth::user()->id ?? '' }}">

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <label for="floating_transaksi" class="block mb-2 text-sm font-medium text-gray-900 ">Tipe
                        Transaksi</label>
                    <select name="transaksiID" id="floating_transaksiID"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        required>
                        <option value="1" selected>Dijual</option>
                        <option value="0">Disewa</option>
                    </select>
                </div>

                {{-- <div class="relative z-0 w-1/2 group">
                    <label for="floating_isPrimary" class="block mb-2 text-sm font-medium text-gray-900 ">Tipe
                        Properti</label>
                    <select name="isPrimary" id="floating_isPrimary"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        required>
                        <option value="0" selected>SECONDARY</option>
                    </select>
                </div> --}}
                <div class="relative z-0 w-1/2 group">
                    <label for="floating_isPrimary" class="block mb-2 text-sm font-medium text-gray-900 ">Tipe
                        Properti</label>
                    <select name="Tipe" id="floating_isPrimary"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        required>
                        <option value="1" name="Tipe" selected >Rumah</option>
                        <option value="3" name="Tipe">Apart</option>
                        <option value="5" name="Tipe">Office</option>
                        <option value="13"name="Tipe">Villa</option>
                        <option value="6" name="Tipe">Pabrik</option>
                        <option value="7" name="Tipe">Gudang</option>
                        <option value="9" name="Tipe">Soho</option>
                        <option value="10"name="Tipe" >Ruko</option>
                        <option value="4" name="Tipe">Hotel</option>
                        <option value="8" name="Tipe">Gedung</option>
                        <option value="11" name="Tipe">Tanah</option>
                        <option value="2" name="Tipe">Toko</option>
                    </select>
                </div>
            </div>
            <!-- Price Range -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                <div class="flex items-center space-x-2">
                    <div class="relative w-1/2">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">Rp.</span>
                        <input type="text" id="HargaTerendah" placeholder="Min"
                            class="w-full bg-gray-50 pl-10 border border-gray-300 px-3 py-2 rounded-lg text-sm"
                            name="HargaTerendah" required>
                    </div>
                    <span class="text-sm font-medium">-</span>
                    <div class="relative w-1/2">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">Rp.</span>
                        <input type="text" placeholder="Max" id="HargaTertinggi"
                            class="w-full bg-gray-50 pl-10 border border-gray-300 px-3 py-2 rounded-lg text-sm"
                            name="HargaTertinggi" required>
                    </div>
                </div>
            </div>

            <!-- Land Size Range -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Luas Tanah (m²)</label>
                <div class="flex items-center space-x-2">
                    <input type="text" id="LTMin" placeholder="Min"
                        class="w-1/2 border bg-gray-50 border-gray-300 px-3 py-2 rounded-lg text-sm" name="LTMin">
                    <span class="text-sm font-medium">-</span>
                    <input type="text" placeholder="Max" id="LTMax"
                        class="w-1/2 border bg-gray-50 border-gray-300 px-3 py-2 rounded-lg text-sm" name="LTMax">
                </div>
            </div>

            <!-- Building Size Range -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Luas Bangunan (m²)</label>
                <div class="flex items-center space-x-2">
                    <input type="text" placeholder="Min" id="LBMin"
                        class="w-1/2 border bg-gray-50 border-gray-300 px-3 py-2 rounded-lg text-sm" name="LBMin">
                    <span class="text-sm font-medium">-</span>
                    <input type="text" placeholder="Max" id="LBMax"
                        class="w-1/2 border bg-gray-50 border-gray-300 px-3 py-2 rounded-lg text-sm" name="LBMax">
                </div>
            </div>

            <!-- Kamar Tidur & Mandi -->
            <div class="mb-4">
                <div class="flex space-x-4">
                    <!-- Kamar Tidur -->
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kamar Tidur</label>
                        <div class="flex items-center space-x-2">
                            <input type="text" id="kamar_tidur"
                                class="w-full border bg-gray-50 border-gray-300 px-3 py-2 rounded-lg text-sm" name="kamar_tidur">
                        </div>
                    </div>
                    <!-- Kamar Mandi -->
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kamar Mandi</label>
                        <div class="flex items-center space-x-2">
                            <input type="text" id="kamar_mandi"
                                class="w-full border bg-gray-50 border-gray-300 px-3 py-2 rounded-lg text-sm" name="kamar_mandi">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden input for ownershipListingID-->
            <input type="hidden" name="ownershipListingID" value="{{ Auth::user()->id ?? '' }}">

            <!-- Hidden input for statusListing -->
            <input type="hidden" name="isPrimary" value="0">

            <!-- Hidden input for statusListing -->
            <input type="hidden" name="statusListing" value="2">

            <button type="submit"
                class="text-white bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
        </form>
    </div>

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

        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdown-button');
            const dropdownMenu = document.getElementById('dropdown-menu');
            const dropdownItems = dropdownMenu.querySelectorAll('[data-value]');
            const dropdownText = dropdownButton.querySelector('span');
            const searchInput = document.getElementById('search-input');

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

            dropdownItems.forEach(item => {
                item.addEventListener('click', function() {
                    const selectedValue = this.getAttribute('data-value');
                    const selectedText = this.textContent.trim();

                    // Update button text
                    dropdownButton.innerHTML =
                        `${selectedText} <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>`;

                    // Close dropdown
                    dropdownMenu.classList.add('hidden');

                    // Set the value of the hidden input field
                    const hiddenInput = document.getElementById('lokasiID');

                    // Set the value of the hidden input
                    hiddenInput.value = selectedValue;

                    // Optionally: log the selected value
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
    </script>
    @section('scripts')
        @vite('resources/js/filter.js')
    @endsection

</x-admin-layout>

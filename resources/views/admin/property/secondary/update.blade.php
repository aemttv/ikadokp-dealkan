<x-admin-layout>
    <div class=" mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            {{-- page title --}}
            <h2 class="text-2xl font-semibold text-gray-700">Update Secondary Listing No.{{ $property->listingID }}</h2>
            {{-- back button --}}
            <a href="{{ route('propertySecondary.view') }}"
                class="bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white px-4 py-2 rounded">Kembali</a>
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
        <form id="myForm" class="max-w-sm mx-auto" action="{{ route('updateSecondary.submit', $property->listingID) }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            <label for="large-image" class="block mb-2 text-sm font-medium text-gray-900 ">Gambar</label>
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

            <div class="flex space-x-4 mb-5">
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


            <div class="mb-5">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Judul
                    Properti</label>
                <input type="name" id="title" name="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    value="{{ old('title', $property->title) }}" required />
            </div>

            <!-- Hidden input for statusListing -->
            <input type="hidden" name="isPrimary" value="0">
            <input type="hidden" name="ownershipID" value="1">

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <label for="floating_transaksi" class="block mb-2 text-sm font-medium text-gray-900 ">Tipe
                        Transaksi</label>
                    <select name="transaksiID" id="floating_transaksiID"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        required>
                        <option value="1" {{ $property->transaksiID == 1 ? 'selected' : '' }}>Dijual</option>
                        <option value="0" {{ $property->transaksiID == 0 ? 'selected' : '' }}>Disewa</option>
                    </select>
                </div>
                <div class="relative z-0 w-1/2 group">
                    <label for="floating_listingType" class="block mb-2 text-sm font-medium text-gray-900">Tipe
                        Listing</label>
                    <select name="listingType" id="floating_listingType"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="1" {{ $property->listingType == 1 ? 'selected' : '' }}>Rumah</option>
                        <option value="2" {{ $property->listingType == 2 ? 'selected' : '' }}>Toko</option>
                        <option value="3" {{ $property->listingType == 3 ? 'selected' : '' }}>Apartemen</option>
                        <option value="4" {{ $property->listingType == 4 ? 'selected' : '' }}>Hotel</option>
                        <option value="5" {{ $property->listingType == 5 ? 'selected' : '' }}>Office</option>
                        <option value="6" {{ $property->listingType == 6 ? 'selected' : '' }}>Pabrik</option>
                        <option value="7" {{ $property->listingType == 7 ? 'selected' : '' }}>Gudang</option>
                        <option value="8" {{ $property->listingType == 8 ? 'selected' : '' }}>Gedung</option>
                        <option value="9" {{ $property->listingType == 9 ? 'selected' : '' }}>Soho</option>
                        <option value="10" {{ $property->listingType == 10 ? 'selected' : '' }}>Ruko</option>
                        <option value="11" {{ $property->listingType == 11 ? 'selected' : '' }}>Tanah</option>
                        <option value="12" {{ $property->listingType == 12 ? 'selected' : '' }}>Toko</option>
                        <option value="13" {{ $property->listingType == 13 ? 'selected' : '' }}>Villa</option>
                    </select>
                </div>
            </div>

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <label for="floating_sertifikatType" class="block mb-2 text-sm font-medium text-gray-900">Tipe
                        Sertifikat</label>
                    <select name="sertifikatType" id="floating_sertifikatType"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="1" {{ $property->sertifikatType == 1 ? 'selected' : '' }}>HAK MILIK
                        </option>
                        <option value="2" {{ $property->sertifikatType == 2 ? 'selected' : '' }}>HAK GUNA
                            BANGUNAN</option>
                        <option value="3" {{ $property->sertifikatType == 3 ? 'selected' : '' }}>HAK PAKAI
                        </option>
                        <option value="4" {{ $property->sertifikatType == 4 ? 'selected' : '' }}>PPJB</option>
                        <option value="5" {{ $property->sertifikatType == 5 ? 'selected' : '' }}>PETOK D</option>
                        <option value="6" {{ $property->sertifikatType == 6 ? 'selected' : '' }}>SURAT IJO
                        </option>
                        <option value="7" {{ $property->sertifikatType == 7 ? 'selected' : '' }}>STRATE TITLE
                        </option>
                        <option value="0" {{ $property->sertifikatType == 0 ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div class="relative z-0 w-1/2 group">
                    <label for="floating_kondisiType" class="block mb-2 text-sm font-medium text-gray-900">Kondisi
                        Properti</label>
                    <select name="kondisiType" id="floating_kondisiType"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="1" {{ $property->kondisiType == 1 ? 'selected' : '' }}>Baru</option>
                        <option value="2" {{ $property->kondisiType == 2 ? 'selected' : '' }}>Bagus</option>
                        <option value="3" {{ $property->kondisiType == 3 ? 'selected' : '' }}>Butuh Renovasi
                        </option>
                        <option value="4" {{ $property->kondisiType == 4 ? 'selected' : '' }}>Baru Renovasi
                        </option>
                    </select>
                </div>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="floating_komisi" class="block mb-2 text-sm font-medium text-gray-900">Komisi (%)</label>
                <input type="number" name="komisi" id="floating_komisi"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder=" " required min="1" max="50" value="{{ $property->komisi }}" />
            </div>

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <label for="floating_vendorName" class="block mb-2 text-sm font-medium text-gray-900">Vendor
                        Name</label>
                    <input type="text" name="vendorName" id="floating_vendorName"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder=" " required value="{{ $property->vendorName }}" />
                </div>

                <div class="relative z-0 w-1/2 group">
                    <label for="floating_VendorPhone" class="block mb-2 text-sm font-medium text-gray-900">Vendor
                        Phone</label>
                    <input type="text" name="VendorPhone" id="floating_VendorPhone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder=" " required oninput="validatePhoneNumber(this)"
                        value="{{ $property->VendorPhone }}" />
                </div>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="floating_alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                <input type="text" name="alamat" id="floating_alamat"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder=" " required value="{{ $property->alamat }}" />
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="floating_lantai" class="block mb-2 text-sm font-medium text-gray-900">Lantai</label>
                <input type="number" name="lantai" id="floating_lantai"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder=" " required min="0" max="165" value="{{ $property->lantai }}" />
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
                <input type="hidden" id="lokasiID" name="lokasiID"
                    value="<?= htmlspecialchars($property->lokasiID) ?>">

            </div>
            <div class="relative z-0 w-full mb-5 group">
                <label for="floating_orientasiID"
                    class="block mb-2 text-sm font-medium text-gray-900">Orientasi</label>
                <select name="orientasiID" id="floating_orientasiID"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    <option value="1" {{ $property->orientasiID == 1 ? 'selected' : '' }}>Barat</option>
                    <option value="2" {{ $property->orientasiID == 2 ? 'selected' : '' }}>Selatan</option>
                    <option value="3" {{ $property->orientasiID == 3 ? 'selected' : '' }}>Timur</option>
                    <option value="4" {{ $property->orientasiID == 4 ? 'selected' : '' }}>Utara</option>
                </select>

            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="floating_posisiID" class="block mb-2 text-sm font-medium text-gray-900">Posisi</label>
                <select name="posisiID" id="floating_posisiID"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    <option value="1" {{ $property->posisiID == 1 ? 'selected' : '' }}>Standart</option>
                    <option value="2" {{ $property->posisiID == 2 ? 'selected' : '' }}>Tusuk Sate</option>
                    <option value="3" {{ $property->posisiID == 3 ? 'selected' : '' }}>Hook</option>
                    <option value="4" {{ $property->posisiID == 4 ? 'selected' : '' }}>Kuldesak</option>
                </select>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="floating_hargaJual" class="block mb-2 text-sm font-medium text-gray-900">Harga
                    Jual</label>
                <input type="number" name="hargaJual" id="floating_hargaJual"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required min="0" step="10000" max="999999999999999" placeholder="Rp."
                    value="{{ $property->hargaJual }}" />
            </div>

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <label for="floating_luasTanah" class="block mb-2 text-sm font-medium text-gray-900">Luas
                        Tanah</label>
                    <input type="number" name="luasTanah" id="floating_luasTanah"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required min="0" value="{{ $property->luasTanah }}" />
                </div>

                <div class="relative z-0 w-1/2 group">
                    <label for="floating_luasBangunan" class="block mb-2 text-sm font-medium text-gray-900">Luas
                        Bangunan</label>
                    <input type="number" name="luasBangunan" id="floating_luasBangunan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required min="0" value="{{ $property->luasBangunan }}" />
                </div>
            </div>

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <label for="floating_dimensiMin" class="block mb-2 text-sm font-medium text-gray-900">Dimensi
                        Panjang</label>
                    <input type="number" name="dimPanjang" id="floating_dimensiMin"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required min="0" value="{{ $property->dimPanjang }}" />
                </div>

                <div class="relative z-0 w-1/2 group">
                    <label for="floating_dimensiMax" class="block mb-2 text-sm font-medium text-gray-900">Dimensi
                        Lebar</label>
                    <input type="number" name="dimLebar" id="floating_dimensiMax"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required min="0" value="{{ $property->dimLebar }}" />
                </div>
            </div>

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <label for="floating_ktUtama" class="block mb-2 text-sm font-medium text-gray-900">KT
                        Utama</label>
                    <input type="number" name="ktUtama" id="floating_ktUtama"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required min="0" value="{{ $property->ktUtama }}" />
                </div>

                <div class="relative z-0 w-1/2 group">
                    <label for="floating_ktLain" class="block mb-2 text-sm font-medium text-gray-900">KT Lain</label>
                    <input type="number" name="ktLain" id="floating_ktLain"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        min="0" value="{{ $property->ktLain }}" />
                </div>
            </div>

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <label for="floating_kmUtama" class="block mb-2 text-sm font-medium text-gray-900">KM
                        Utama</label>
                    <input type="number" name="kmUtama" id="floating_kmUtama"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required min="0" value="{{ $property->kmUtama }}" />
                </div>

                <div class="relative z-0 w-1/2 group">
                    <label for="floating_kmLain" class="block mb-2 text-sm font-medium text-gray-900">KM Lain</label>
                    <input type="number" name="kmLain" id="floating_kmLain"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        min="0" value="{{ $property->kmLain }}" />
                </div>
            </div>

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <label for="floating_kondisiPerabotanID"
                        class="block mb-2 text-sm font-medium text-gray-900">Kondisi Properti</label>
                    <select name="kondisiPerabotanID" id="floating_kondisiPerabotanID"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="1" {{ $property->kondisiPerabotanID == 1 ? 'selected' : '' }}>Furnished
                        </option>
                        <option value="2" {{ $property->kondisiPerabotanID == 2 ? 'selected' : '' }}>Semi
                            Furnished</option>
                        <option value="3" {{ $property->kondisiPerabotanID == 3 ? 'selected' : '' }}>Unfurnished
                        </option>
                    </select>
                </div>

                <div class="relative z-0 w-1/2 group">
                    <label for="floating_carport" class="block mb-2 text-sm font-medium text-gray-900">Carport</label>
                    <input type="number" name="carport" id="floating_carport"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        min="0" value="{{ $property->carport }}" />
                </div>

                <div class="relative z-0 w-1/2 group">
                    <label for="floating_listrikID"
                        class="block mb-2 text-sm font-medium text-gray-900">Listrik</label>
                    <select name="listrikID" id="floating_listrikID"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="1" {{ $property->listrikID == 1 ? 'selected' : '' }}>0</option>
                        <option value="2" {{ $property->listrikID == 2 ? 'selected' : '' }}>450</option>
                        <option value="3" {{ $property->listrikID == 3 ? 'selected' : '' }}>900</option>
                        <option value="4" {{ $property->listrikID == 4 ? 'selected' : '' }}>1300</option>
                        <option value="5" {{ $property->listrikID == 5 ? 'selected' : '' }}>2200</option>
                        <option value="6" {{ $property->listrikID == 6 ? 'selected' : '' }}>3500</option>
                        <option value="7" {{ $property->listrikID == 7 ? 'selected' : '' }}>4400</option>
                        <option value="8" {{ $property->listrikID == 8 ? 'selected' : '' }}>5500</option>
                        <option value="9" {{ $property->listrikID == 9 ? 'selected' : '' }}>6600</option>
                        <option value="10" {{ $property->listrikID == 10 ? 'selected' : '' }}>7600</option>
                        <option value="11" {{ $property->listrikID == 11 ? 'selected' : '' }}>7700</option>
                        <option value="12" {{ $property->listrikID == 12 ? 'selected' : '' }}>8000</option>
                        <option value="13" {{ $property->listrikID == 13 ? 'selected' : '' }}>9500</option>
                        <option value="14" {{ $property->listrikID == 14 ? 'selected' : '' }}>10000</option>
                        <option value="15" {{ $property->listrikID == 15 ? 'selected' : '' }}>10600</option>
                        <option value="16" {{ $property->listrikID == 16 ? 'selected' : '' }}>11000</option>
                        <option value="17" {{ $property->listrikID == 17 ? 'selected' : '' }}>12700</option>
                        <option value="18" {{ $property->listrikID == 18 ? 'selected' : '' }}>13200</option>
                        <option value="19" {{ $property->listrikID == 19 ? 'selected' : '' }}>13300</option>
                        <option value="20" {{ $property->listrikID == 20 ? 'selected' : '' }}>13900</option>
                    </select>
                </div>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="floating_deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                <textarea name="deskripsi" id="floating_deskripsi"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 max-h-60 min-h-20"
                    placeholder=" " required>{{ $property->deskripsi }}</textarea>
            </div>

            <div class="relative z-0 w-full">
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

            <div id="image_container">
                <!-- Images will be displayed here -->
            </div>

            <!-- Hidden input for statusListing -->
            <input type="hidden" name="ownershipListingID" value="{{ Auth::user()->id ?? '' }}">

            <!-- Hidden input for statusListing -->
            <input type="hidden" name="statusListing" value="2">
            <button type="submit"
                class="text-white bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mt-5">Simpan</button>
        </form>
    </div>

    <script>
        //LOKASI
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdown-button');
            const dropdownMenu = document.getElementById('dropdown-menu');
            const dropdownItems = dropdownMenu.querySelectorAll('[data-value]');
            const dropdownText = dropdownButton.querySelector('span');
            const searchInput = document.getElementById('search-input');
            const hiddenInput = document.getElementById('lokasiID'); // Hidden input field

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
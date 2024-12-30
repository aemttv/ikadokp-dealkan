<x-layout title="add">
    @if (Auth::check())
        <form class="max-w-md mt-20 mx-auto p-4" action="{{ route('add.submit') }}" method="POST" enctype="multipart/form-data"
            onsubmit="return validateForm()">
            @csrf <!-- Include this for CSRF protection -->

            <div class="flex flex-col items-start space-y-4">
                <h1 class="text-xl font-bold">Add Secondary Property</h1>
                {{-- Alert --}}
                @if (session('success'))
                    <x-ui.alert type="success" :message="session('success')" />
                @elseif ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-ui.alert type="error" :message="$error" />
                    @endforeach
                @endif
                <div class="flex md:p-0 p-1.5">
                    <!-- Large image upload box -->
                    <label for="large-image"
                        class="flex items-center text-center justify-center w-64 md:w-80 h-36 border-2 border-dashed rounded-lg bg-gray-50 text-gray-500 cursor-pointer relative">
                        <span id="large-image-placeholder">+<br>Masukkan Gambar</span>
                        <img id="large-image-preview" class="absolute inset-0 w-full h-full object-cover hidden" />
                        <input id="large-image" type="file" accept="image/*" class="hidden"
                            onchange="handleFileUpload(event, 'large-image-preview', 'large-image-placeholder')"
                            name="image_main" required />
                    </label>

                    <!-- Small image upload boxes -->
                    <div class="flex flex-col space-y-2 ml-1.5">
                        <label for="small-image-1"
                            class="flex items-center justify-center w-28 h-[68px] border-2 border-dashed rounded-lg bg-gray-50 text-gray-500 cursor-pointer relative">
                            <span id="small-image-1-placeholder">+</span>
                            <img id="small-image-1-preview"
                                class="absolute inset-0 w-full h-full object-cover hidden" />
                            <input id="small-image-1" type="file" accept="image/*" class="hidden"
                                onchange="handleFileUpload(event, 'small-image-1-preview', 'small-image-1-placeholder')"
                                name="image_second" />
                        </label>
                        <label for="small-image-2"
                            class="flex items-center justify-center w-28 h-[68px] border-2 border-dashed rounded-lg bg-gray-50 text-gray-500 cursor-pointer relative">
                            <span id="small-image-2-placeholder">+</span>
                            <img id="small-image-2-preview"
                                class="absolute inset-0 w-full h-full object-cover hidden" />
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
                    placeholder=" " required />
                <label for="floating_title"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
            </div>

            <!-- Hidden input for agentID -->
            <input type="hidden" name="agentID" value="{{ Auth::user()->id ?? '' }}">
            <!-- Hidden input for isPrimary-->
            <input type="hidden" name="isPrimary" value="0">

            <div class="flex space-x-4 mb-5">
                {{-- <div class="relative z-0 w-1/2 group">
                    <select name="isPrimary" id="floating_isPrimary"
                        class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        required disabled>
                        <option value="1" selected>PRIMARY</option>
                        <option value="0" selected>SECONDARY</option>
                    </select>
                    <label for="floating_isPrimary"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tipe
                        Properti</label>
                </div> --}}

                <div class="relative z-0 w-1/2 group">
                    <select name="transaksiID" id="floating_transaksiID"
                        class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none  focus:ring-0 focus:border-orange-500 peer"
                        required>
                        <option value="1" selected>Dijual</option>
                        <option value="0">Disewa</option>
                    </select>
                    <label for="floating_transaksi"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tipe
                        Transaksi</label>
                </div>

                <div class="relative z-0 w-1/2 group">
                    <select name="listingType" id="floating_listingType"
                        class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        required>
                        <option value="1" selected>Rumah</option>
                        <option value="2">Toko</option>
                        <option value="3">Apartemen</option>
                        <option value="4">Hotel</option>
                        <option value="5">Office</option>
                        <option value="6">Pabrik</option>
                        <option value="7">Gudang</option>
                        <option value="8">Gedung</option>
                        <option value="9">Soho</option>
                        <option value="10">Ruko</option>
                        <option value="11">Tanah</option>
                        <option value="12">Toko</option>
                        <option value="13">Villa</option>
                    </select>
                    <label for="floating_listingType"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tipe
                        Listing</label>
                </div>
            </div>

            <!-- Hidden input for statusListing -->
            <input type="hidden" name="ownershipID" value="1">
            {{-- <div class="relative z-0 w-full mb-5 group">
                <select name="ownershipID" id="floating_ownershipID"
                    class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                    required>
                    <option value="1" selected>Open</option>
                    <option value="2">Exclusive</option>
                </select>
                <label for="floating_ownership"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tipe
                    Ownership</label>
            </div> --}}
            <div class="flex space-x-4 mb-5">


                <div class="relative z-0 w-1/2 group">
                    <select name="sertifikatType" id="floating_sertifikatType"
                        class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        required>
                        <option value="1" selected>HAK MILIK</option>
                        <option value="2">HAK GUNA BANGUNAN</option>
                        <option value="3">HAK PAKAI</option>
                        <option value="4">PPJB</option>
                        <option value="5">PETOK D</option>
                        <option value="6">SURAT IJO</option>
                        <option value="7">STRATE TITLE</option>
                        <option value="0">Lainnya</option>
                    </select>
                    <label for="floating_sertifikat"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tipe
                        Sertifikat</label>
                </div>

                <div class="relative z-0 w-1/2  group">
                    <select name="kondisiType" id="floating_kondisiType"
                        class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        required>
                        <option value="1" selected>Baru</option>
                        <option value="2">Bagus</option>
                        <option value="3">Butuh Renovasi</option>
                        <option value="4">Baru Renovasi</option>
                    </select>
                    <label for="floating_kondisi"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kondisi
                        Properti</label>
                </div>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="komisi" id="floating_komisi"
                    class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                    placeholder=" " required min="1" max="3" />
                <label for="floating_komisi"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Komisi
                    (%)</label>
            </div>

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <input type="text" name="vendorName" id="floating_vendorName"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        placeholder=" " required />
                    <label for="floating_vendorName"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Vendor
                        Name</label>
                </div>

                <div class="relative z-0 w-1/2 group">
                    <input type="text" name="VendorPhone" id="floating_VendorPhone"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        placeholder=" " required oninput="validatePhoneNumber(this)" />
                    <label for="floating_VendorPhone"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Vendor
                        Phone</label>
                </div>
            </div>


            <div class="relative z-0 w-full mb-5 group">
                <textarea name="alamat" id="floating_alamat"
                    class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer max-h-60 min-h-20"
                    placeholder=" " required></textarea>
                <label for="floating_alamat"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Alamat</label>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="lantai" id="floating_lantai"
                    class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                    placeholder=" " required min="0" max="165" />
                <label for="floating_lantai"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Lantai</label>
            </div>

            <label for="floating_lokasi" class="block mb-2 text-sm font-medium text-gray-500">Lokasi</label>
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
            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <select name="posisiID" id="floating_posisiID"
                        class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        required>
                        <option value="1" selected>Standart</option>
                        <option value="2">Tusuk Sate</option>
                        <option value="3">Hook</option>
                        <option value="4">Kuldesak</option>
                    </select>
                    <label for="floating_posisiID"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Posisi</label>
                </div>
                <div class="relative z-0 w-1/2 group">

                    <select name="orientasiID" id="floating_orientasiID"
                        class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        required>
                        <option value="1" selected>Barat</option>
                        <option value="2">Selatan</option>
                        <option value="3">Timur</option>
                        <option value="4">Utara</option>
                    </select>
                    <label for="floating_orientasiID"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Orientasi(Hadap)</label>
                </div>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="hargaJual" id="floating_hargaJual"
                    class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                    placeholder=" " required min="15000000" step="10000" max="999999999999999"
                    placeholder="Rp." />
                <label for="floating_hargaJual"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Harga
                    Jual</label>
            </div>
            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <input type="number" name="luasTanah" id="floating_luasTanah"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        placeholder=" " required min="0" />
                    <label for="floating_luasTanah"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Luas
                        Tanah(m²)</label>
                </div>


                <div class="relative z-0 w-1/2 group">
                    <input type="number" name="luasBangunan" id="floating_luasBangunan"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        placeholder=" " required min="0" />
                    <label for="floating_luasBangunan"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Luas
                        Bangunan(m²)</label>
                </div>
            </div>

            {{-- <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <input type="number" name="dimPanjang" id="floating_dimensiMin"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        placeholder=" " required min="0" />
                    <label for="floating_dimensiMin"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dimensi
                        Panjang</label>
                </div>

                <div class="relative z-0 w-1/2 group">
                    <input type="number" name="dimLebar" id="floating_dimensiMax"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        placeholder=" " required min="0" />
                    <label for="floating_dimensiMax"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dimensi
                        Lebar</label>
                </div>
            </div> --}}

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <input type="number" name="ktUtama" id="floating_ktUtama"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        placeholder=" " required min="0" />
                    <label for="floating_ktUtama"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">KT
                        Utama</label>
                </div>

                <div class="relative z-0 w-1/2 group">
                    <input type="number" name="ktLain" id="floating_ktLain"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        placeholder=" " min="0" />
                    <label for="floating_ktLain"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">KT
                        Lain</label>
                </div>
            </div>

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <input type="number" name="kmUtama" id="floating_kmUtama"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        placeholder=" " required min="0" />
                    <label for="floating_kmUtama"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">KM
                        Utama</label>
                </div>

                <div class="relative z-0 w-1/2 group">
                    <input type="number" name="kmLain" id="floating_kmLain"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        placeholder=" " min="0" />
                    <label for="floating_kmLain"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">KM
                        Lain</label>
                </div>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="carport" id="floating_carport"
                    class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                    placeholder=" " min="0" />
                <label for="floating_carport"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Carport</label>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <textarea type="text" name="deskripsi" id="floating_deskripsi"
                    class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer max-h-60 min-h-20"
                    placeholder=" " required></textarea>
                <label for="floating_deskripsi"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Deskripsi</label>
            </div>

            <div class="flex space-x-4 mb-5">
                <div class="relative z-0 w-1/2 group">
                    <select name="kondisiPerabotanID" id="floating_kondisiPerabotanID"
                        class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        required>
                        <option value="1" selected>Furnished</option>
                        <option value="2">Semi Furnished</option>
                        <option value="3">Unfurnished</option>
                    </select>
                    <label for="floating_kondisiPerabotanID"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kondisi
                        Properti</label>
                </div>

                <div class="relative z-0 w-1/2 group">
                    <select name="listrikID" id="floating_listrikID"
                        class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer"
                        required>
                        <option value="1" selected>0</option>
                        <option value="2">450</option>
                        <option value="3">900</option>
                        <option value="4">1300</option>
                        <option value="5">2200</option>
                        <option value="6">3500</option>
                        <option value="7">4400</option>
                        <option value="8">5500</option>
                        <option value="9">6600</option>
                        <option value="10">7600</option>
                        <option value="11">7700</option>
                        <option value="12">8000</option>
                        <option value="13">9500</option>
                        <option value="14">10000</option>
                        <option value="15">10600</option>
                        <option value="16">11000</option>
                        <option value="17">12700</option>
                        <option value="18">13200</option>
                        <option value="19">13300</option>
                        <option value="20">13900</option>
                    </select>
                    <label for="floating_listrikID"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Listrik</label>
                </div>
            </div>

            <div id="image_container">
                <!-- Images will be displayed here -->
            </div>

            <!-- Hidden input for dimPanjang -->
            <input type="hidden" name="dimPanjang" value="0">
            <!-- Hidden input for dimLebar -->
            <input type="hidden" name="dimLebar" value="0">
            <!-- Hidden input for statusListing -->
            <input type="hidden" name="ownershipListingID" value="{{ Auth::user()->id ?? '' }}">

            <!-- Hidden input for statusListing -->
            <input type="hidden" name="statusListing" value="2">

            <div id="image-error" class="text-red-500 hidden">
                Harap unggah gambar utama sebelum melanjutkan.
            </div>
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
            if (!value.startsWith('628')) {
                value = '628' + value;
            }

            // Limit the maximum length to 13 characters
            if (value.length > 13) {
                value = value.slice(0, 13);
            }

            if (value.length < 12) { // 12 includes "62" + 10 digits
                input.setCustomValidity('Nomor telepon harus minimal 10 angka.');
                input.reportValidity();
            } else {
                input.setCustomValidity(''); // Clear the validity if the length is correct
            }
            // Update the input value
            input.value = value;
        }

        function validateForm() {
            const imageInput = document.getElementById('large-image');
            const errorElement = document.getElementById('image-error');

            if (!imageInput.files || imageInput.files.length === 0) {
                // Show an error message if no image is uploaded
                errorElement.classList.remove('hidden');
                imageInput.focus(); // Focus the image input field for user correction
                return false; // Prevent form submission
            }

            // Hide the error message if the image input is valid
            errorElement.classList.add('hidden');
            return true; // Allow form submission
        }
    </script>
</x-layout>

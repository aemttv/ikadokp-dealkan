<x-layout title="Create Buy Request">
    <x-section>
        @if (Auth::check())
            <form class="max-w-md mt-20 mx-auto p-4" action="{{ route('addRequest.submit', Auth::user()->id)}}" method="POST"
                enctype="multipart/form-data">
                @csrf <!-- Include this for CSRF protection -->

                <div class="flex flex-col items-start space-y-4">
                    <h1 class="text-xl font-bold">New Request</h1>
                </div>
                <div class="relative z-0 w-full group my-2">
                    <input type="text" name="vendorName" id="floating_vendorName"
                        class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="floating_vendorName"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Vendor
                        Name</label>
                </div>
                <!-- Location Input -->
                <div class="flex space-x-4 mb-5">
                    <div x-data="{
                        open: false,
                        search: '',
                        options: [
                            { id: 1, name: 'Asemrowo', subdistricts: ['Asemrowo', 'Genting', 'Kalianak', 'Tambak Sarioso'] },
                            { id: 2, name: 'Benowo', subdistricts: ['Kandangan', 'Romokalisari', 'Sememi', 'Tambak Osowilangun'] },
                            { id: 3, name: 'Bubutan', subdistricts: ['Alun-Alun Contong', 'Bubutan', 'Gundih', 'Jepara', 'Tembok Dukuh'] },
                            { id: 4, name: 'Bulak', subdistricts: ['Bulak', 'Kedungcowek', 'Kenjeran', 'Sukolilo Baru'] },
                            { id: 5, name: 'Dukuh Pakis', subdistricts: ['Dukuh Kupang', 'Dukuh Pakis', 'Gunung Sari', 'Pradah Kalikendal'] },
                            { id: 6, name: 'Gayungan', subdistricts: ['Dukuh Menanggal', 'Gayungan', 'Ketintang', 'Menanggal'] },
                            { id: 7, name: 'Genteng', subdistricts: ['Embong Kaliasin', 'Genteng', 'Kapasari', 'Ketabang', 'Peneleh'] },
                            { id: 8, name: 'Gubeng', subdistricts: ['Airlangga', 'Barata Jaya', 'Gubeng', 'Kertajaya', 'Mojo', 'Pucangsewu'] },
                            { id: 9, name: 'Gunung Anyar', subdistricts: ['Gunung Anyar', 'Gunung Anyar Tambak', 'Rungkut Menanggal', 'Rungkut Tengah'] },
                            { id: 10, name: 'Jambangan', subdistricts: ['Jambangan', 'Karah', 'Kebonsari', 'Pagesangan'] },
                            { id: 11, name: 'Karang Pilang', subdistricts: ['Karang Pilang', 'Kebraon', 'Kedurus', 'Warugunung'] },
                            { id: 12, name: 'Kenjeran', subdistricts: ['Bulakbanteng', 'Tambakwedi', 'Tanah Kalikedinding', 'Sidotopo Wetan'] },
                            { id: 13, name: 'Krembangan', subdistricts: ['Dupak', 'Kemayoran', 'Krembangan Selatan', 'Morokrembangan', 'Perak Barat'] },
                            { id: 14, name: 'Lakarsantri', subdistricts: ['Bangkingan', 'Jeruk', 'Lakarsantri', 'Lidah Kulon', 'Lidah Wetan', 'Sumur Welut'] },
                            { id: 15, name: 'Mulyorejo', subdistricts: ['Dukuh Sutorejo', 'Kalijudan', 'Kalisari', 'Kejawan Putih Tambak', 'Manyar Sabrangan', 'Mulyorejo'] },
                            { id: 16, name: 'Pabean Cantian', subdistricts: ['Bongkaran', 'Krembangan Utara', 'Nyamplungan', 'Tanjung Perak'] },
                            { id: 17, name: 'Pakal', subdistricts: ['Babat Jerawat', 'Benowo', 'Pakal', 'Sumberejo'] },
                            { id: 18, name: 'Rungkut', subdistricts: ['Kali Rungkut', 'Kedung Baruk', 'Medokan Ayu', 'Penjaringan Sari', 'Rungkut Kidul', 'Wonorejo'] },
                            { id: 19, name: 'Sambikerep', subdistricts: ['Bringin', 'Made', 'Lontar', 'Sambikerep'] },
                            { id: 20, name: 'Sawahan', subdistricts: ['Banyu Urip', 'Kupang Krajan', 'Pakis', 'Patemon', 'Putat Jaya', 'Sawahan'] },
                            { id: 21, name: 'Semampir', subdistricts: ['Ampel', 'Pegirian', 'Sidotopo', 'Ujung', 'Wonokusumo'] },
                            { id: 22, name: 'Simokerto', subdistricts: ['Kapasan', 'Sidodadi', 'Simokerto', 'Simolawang', 'Tambakrejo'] },
                            { id: 23, name: 'Sukolilo', subdistricts: ['Gebang Putih', 'Keputih', 'Klampisngasem', 'Medokan Semampir', 'Menur Pumpungan', 'Nginden Jangkungan', 'Semolowaru'] },
                            { id: 24, name: 'Sukomanunggal', subdistricts: ['Putatgede', 'Simomulyo', 'Simomulyo Baru', 'Sonokwijenan', 'Sukomanunggal', 'Tanjungsari'] },
                            { id: 25, name: 'Tambaksari', subdistricts: ['Dukuh Setro', 'Gading', 'Kapas Madya', 'Pacar Kembang', 'Pacar Keling', 'Ploso', 'Rangkah', 'Tambaksari'] },
                            { id: 26, name: 'Tandes', subdistricts: ['Balongsari', 'Banjar Sugihan', 'Karang Poh', 'Manukan Kulon', 'Manukan Wetan', 'Tandes'] },
                            { id: 27, name: 'Tegalsari', subdistricts: ['Dr. Sutomo', 'Kedungdoro', 'Keputran', 'Tegalsari', 'Wonorejo'] },
                            { id: 28, name: 'Tenggilis Mejoyo', subdistricts: ['Kendangsari', 'Kutisari', 'Panjang Jiwo', 'Tenggilis Mejoyo'] },
                            { id: 29, name: 'Wiyung', subdistricts: ['Babatan', 'Balasklumprik', 'Jajar Tunggal', 'Wiyung'] },
                            { id: 30, name: 'Wonocolo', subdistricts: ['Bendul Merisi', 'Jemur Wonosari', 'Margorejo', 'Sidosermo', 'Siwalan Kerto'] },
                            { id: 31, name: 'Wonokromo', subdistricts: ['Darmo', 'Jagir', 'Ngagel', 'Ngagelrejo', 'Sawunggaling', 'Wonokromo'] }
                        ],
                        selected: null
                    }" class="relative w-full group my-5">
                        <div class="relative">
                            <!-- Dropdown Trigger -->
                            <input type="text" x-model="search" @click="open = !open" @input="open = true"
                                class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600"
                                placeholder="Daerah Surabaya" />

                            <!-- Dropdown List -->
                            <div x-show="open" @click.away="open = false"
                                class="absolute bg-white border border-gray-300 rounded shadow-md mt-1 max-h-48 overflow-y-auto w-full z-10">
                                <template
                                    x-for="option in options.filter(o => o.name.toLowerCase().includes(search.toLowerCase()))"
                                    :key="option.id">
                                    <div @click="selected = option.id; search = option.name; open = false"
                                        class="px-4 py-2 cursor-pointer hover:bg-blue-100">
                                        <span x-text="option.name"></span>
                                    </div>
                                </template>
                                <div x-show="!options.filter(o => o.name.toLowerCase().includes(search.toLowerCase())).length"
                                    class="px-4 py-2 text-gray-500">No results found.</div>
                            </div>
                        </div>

                        <!-- Hidden Input -->
                        <input type="hidden" name="lokasiID" :value="selected">

                        <!-- Floating Label -->
                        <label
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">
                            Lokasi
                        </label>
                    </div>
                </div>

                <div class="flex space-x-4 mb-5">
                    <div class="relative z-0 w-full group">
                        <select name="transaksiID" id="floating_transaksiID"
                            class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            required>
                            <option value="1" selected>Dijual</option>
                            <option value="0">Disewa</option>
                        </select>
                        <label for="floating_transaksi"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tipe
                            Transaksi</label>
                    </div>
{{--
                    <div class="relative z-0 w-1/2 group">
                        <select name="isPrimary" id="floating_isPrimary"
                            class="block py-2.5 px-2 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            required>
                            <option value="0" selected>SECONDARY</option>
                        </select>
                        <label for="floating_isPrimary"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tipe
                            Properti</label>
                    </div> --}}
                </div>

                <!-- Property Type -->
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-700">Tipe Properti</h3>
                    <div id="property-type-group" class="grid grid-cols-5 gap-2 mt-2 md:gap-3">
                        <!-- Property Type Options -->
                        <label
                            class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                            <input type="radio" name="Tipe" value="1" class="hidden"> Rumah
                        </label>
                        <label
                            class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                            <input type="radio" name="Tipe" value="3" class="hidden"> Apart
                        </label>
                        <label
                            class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                            <input type="radio" name="Tipe" value="5" class="hidden"> Office
                        </label>
                        <label
                            class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                            <input type="radio" name="Tipe" value="13" class="hidden"> Villa
                        </label>
                        <label
                            class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                            <input type="radio" name="Tipe" value="6" class="hidden"> Pabrik
                        </label>
                        <label
                            class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                            <input type="radio" name="Tipe" value="7" class="hidden"> Gudang
                        </label>
                        <label
                            class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                            <input type="radio" name="Tipe" value="9" class="hidden"> Soho
                        </label>
                        <label
                            class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                            <input type="radio" name="Tipe" value="10" class="hidden"> Ruko
                        </label>
                        <label
                            class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                            <input type="radio" name="Tipe" value="4" class="hidden"> Hotel
                        </label>
                        <label
                            class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                            <input type="radio" name="Tipe" value="8" class="hidden"> Gedung
                        </label>
                        <label
                            class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                            <input type="radio" name="Tipe" value="11" class="hidden"> Tanah
                        </label>
                        <label
                            class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                            <input type="radio" name="Tipe" value="2" class="hidden"> Toko
                        </label>
                    </div>
                </div>

                <!-- Price Range -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                    <div class="flex items-center space-x-2">
                        <div class="relative w-1/2">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">Rp.</span>
                            <input type="text" id="HargaTerendah" placeholder="Min"
                                class="w-full pl-10 border border-gray-300 px-3 py-2 rounded-lg text-sm"
                                name="HargaTerendah" required>
                        </div>
                        <span class="text-sm font-medium">-</span>
                        <div class="relative w-1/2">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">Rp.</span>
                            <input type="text" placeholder="Max" id="HargaTertinggi"
                                class="w-full pl-10 border border-gray-300 px-3 py-2 rounded-lg text-sm"
                                name="HargaTertinggi" required>
                        </div>
                    </div>
                </div>

                <!-- Land Size Range -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Luas Tanah (m²)</label>
                    <div class="flex items-center space-x-2">
                        <input type="text" id="LTMin" placeholder="Min"
                            class="w-1/2 border border-gray-300 px-3 py-2 rounded-lg text-sm" name="LTMin">
                        <span class="text-sm font-medium">-</span>
                        <input type="text" placeholder="Max" id="LTMax"
                            class="w-1/2 border border-gray-300 px-3 py-2 rounded-lg text-sm" name="LTMax">
                    </div>
                </div>

                <!-- Building Size Range -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Luas Bangunan (m²)</label>
                    <div class="flex items-center space-x-2">
                        <input type="text" placeholder="Min" id="LBMin"
                            class="w-1/2 border border-gray-300 px-3 py-2 rounded-lg text-sm" name="LBMin">
                        <span class="text-sm font-medium">-</span>
                        <input type="text" placeholder="Max" id="LBMax"
                            class="w-1/2 border border-gray-300 px-3 py-2 rounded-lg text-sm" name="LBMax">
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
                                    class="w-full border border-gray-300 px-3 py-2 rounded-lg text-sm"
                                    name="kamar_tidur">
                            </div>
                        </div>
                        <!-- Kamar Mandi -->
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kamar Mandi</label>
                            <div class="flex items-center space-x-2">
                                <input type="text" id="kamar_mandi"
                                    class="w-full border border-gray-300 px-3 py-2 rounded-lg text-sm"
                                    name="kamar_mandi">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional fields from the active form -->
                <!-- Hidden input for statusListing -->
                <input type="hidden" name="isPrimary" value="0">
                <!-- Hidden input for statusListing -->
                <input type="hidden" name="agentID" value="{{ Auth::user()->id ?? '' }}">
                <button type="submit"
                    class="w-full text-white mb-5 bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">Submit</button>
            </form>
        @else
            <div
                class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col items-center justify-center h-96 text-center">
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
    </x-section>

    @section('scripts')
        @vite('resources/js/filter.js')
    @endsection
</x-layout>

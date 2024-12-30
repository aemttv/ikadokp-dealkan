<x-layout title="My Listing">

    <x-section>
        <div class="flex flex-col md:flex-row items-start md:space-x-8 pt-16 px-3"> <!-- Tambahkan pt-16 di sini -->
            <div class="md:w-1/2">
                @if (Auth::Check())
                    <h1 class="text-4xl font-bold text-gray-800">Listing Saya</h1>
                    <p class="text-gray-500 mt-2">
                        Temukan pilihan properti <br> Terbaik di Listing Saya.
                    </p>
                @endif

                <div class="mt-4">
                    <label class="text-gray-500 font-medium">Pencarian</label>
                    <div class="relative w-full md:max-w-md flex items-center">
                        <!-- Form for input and 'Cari' button -->
                        @if (Auth::Check())
                            <form class="flex items-center w-full md:w-auto"
                                action="{{ route('property.myListingSearch', ['id' => Auth::user()->id]) }}"
                                method="GET">
                                <input id="pencarian-input" type="text" name="Pencarian"
                                    placeholder="Lokasi, area, developer"
                                    class="px-4 py-3 w-full md:w-[20rem] rounded-md border border-gray-300 focus:outline-none focus:border-gray-500"
                                    value="">
                                <input type="hidden" name="source" value="listing">
                                <button type="submit"
                                    class="px-6 py-3 mx-2 bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-md shadow-lg hover:to-orange-500">
                                    Cari
                                </button>
                            </form>
                            <!-- 'Filter' button outside the form -->
                            <button id="filter-button"
                                class="flex items-center justify-center bg-white px-4 py-2 h-12 border border-gray-300 rounded-md shadow hover:bg-gray-200">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="#000000" viewBox="0 0 24 24">
                                    <path fill="#000000"
                                        d="M10.83 5a3.001 3.001 0 0 0-5.66 0H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17ZM4 11h9.17a3.001 3.001 0 0 1 5.66 0H20a1 1 0 1 1 0 2h-1.17a3.001 3.001 0 0 1-5.66 0H4a1 1 0 1 1 0-2Zm1.17 6H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17a3.001 3.001 0 0 0-5.66 0Z" />
                                </svg>
                                Filter
                            </button>
                    </div>
                    @endif
                </div>
                <!-- Filter Card Popup (Hidden by default) -->
                <div id="filter-card" class="hidden fixed inset-0 flex items-center justify-center z-30">
                    <div class="bg-black bg-opacity-50 absolute inset-0" onclick="toggleFilterCard()"></div>
                    <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg relative">
                        <!-- Close Button -->
                        <button class="absolute top-4 right-4 text-gray-600 hover:text-gray-800"
                            onclick="toggleFilterCard()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <form action="{{ route('property.myListingSearch', ['id' => Auth::user()->id]) }}"
                            method="GET">
                            <!-- Filter Title -->
                            <h2 class="text-2xl font-semibold mb-4 text-gray-800">FILTER</h2>
                            <!-- Location Input -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                                <input id="lokasi-input" type="text" placeholder="Masukkan lokasi, area, judul"
                                    class="w-full border border-gray-300 px-3 py-2 rounded-lg text-sm" name="Pencarian">
                            </div>
                            <!-- Property Type -->
                            <div class="mb-4">
                                <h3 class="text-lg font-medium text-gray-700">Tipe Properti</h3>
                                <div id="property-type-group" class="grid grid-cols-5 gap-2 mt-2 md:gap-3">
                                    <label
                                        class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                                        <input type="radio" name="Tipe" value="1" class="hidden">
                                        Rumah
                                    </label>

                                    <label
                                        class="property-type-label bg-white text-gray-700 border border-gray-300 py-2 px-4 rounded-lg text-sm font-medium flex justify-center items-center cursor-pointer">
                                        <input type="radio" name="Tipe" value="3" class="hidden">
                                        Apart
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
                                        <input type="radio" name="Tipe" value="12" class="hidden"> Toko
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
                                            name="HargaTerendah">
                                    </div>
                                    <span class="text-sm font-medium">-</span>
                                    <div class="relative w-1/2">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">Rp.</span>
                                        <input type="text" placeholder="Max" id="HargaTertinggi"
                                            class="w-full pl-10 border border-gray-300 px-3 py-2 rounded-lg text-sm"
                                            name="HargaTertinggi">
                                    </div>
                                </div>
                            </div>

                            <!-- Land Size Range -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Luas Tanah (m²)</label>
                                <div class="flex items-center space-x-2">
                                    <input type="text" id="LTMin" placeholder="Min"
                                        class="w-1/2 border border-gray-300 px-3 py-2 rounded-lg text-sm"
                                        name="LTMin">
                                    <span class="text-sm font-medium">-</span>
                                    <input type="text" placeholder="Max" id="LTMax"
                                        class="w-1/2 border border-gray-300 px-3 py-2 rounded-lg text-sm"
                                        name="LTMax">
                                </div>
                            </div>

                            <!-- Building Size Range -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Luas Bangunan
                                    (m²)</label>
                                <div class="flex items-center space-x-2">
                                    <input type="text" placeholder="Min" id="LBMin"
                                        class="w-1/2 border border-gray-300 px-3 py-2 rounded-lg text-sm"
                                        name="LBMin">
                                    <span class="text-sm font-medium">-</span>
                                    <input type="text" placeholder="Max" id="LBMax"
                                        class="w-1/2 border border-gray-300 px-3 py-2 rounded-lg text-sm"
                                        name="LBMax">
                                </div>
                            </div>

                            <!-- Reset and Apply Buttons -->
                            <div class="flex justify-between items-center mt-4">
                                <button id="reset-filter-btn" class="text-orange-500 text-sm font-medium">Reset
                                    Filter</button>
                                <button
                                    class="bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white py-2 px-4 rounded-lg text-sm font-medium">Terapkan</button>
                            </div>

                            <!-- Additional Close Button for Mobile -->
                            <button
                                class="md:hidden w-full mt-4 bg-gray-200 text-gray-800 py-2 rounded-lg text-sm font-medium flex items-center justify-center"
                                onclick="toggleFilterCard()" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                Close
                            </button>
                            <form>
                    </div>
                </div>
            </div>


            <!-- Image Section -->
            <div class="w-full md:w-1/2 mt-8 md:mt-0 flex justify-center md:justify-end">
                <div class="overflow-hidden rounded-lg shadow-lg w-full h-64 md:h-80"> <!-- Set fixed height -->
                    <img src="{{ asset('assets/images/Others/hospital.jpg') }}"
                        alt="Kantor Dealkan Surabaya Barat"
                        class="w-full h-full object-cover transition-opacity duration-500 ease-in-out opacity-0"
                        onload="this.classList.remove('opacity-0')" fetchpriority="high" />
                </div>
            </div>
        </div>

        <!-- Properti Baru Section -->
        <div class="container mx-auto my-10 px-10 md:px-6">
            <div class="flex justify-between items-center">
                <h2 id="orientasi" class="text-3xl font-semibold text-gray-800"> Daftar Properti
                    {{ Auth::user()->name }}
                </h2>
            </div>

            @if (!$listingActive == [])
                <p class="text-gray-600 mt-2">
                    Menampilkan {{ $listingActive->firstItem() }}-{{ $listingActive->lastItem() }} dari total
                    {{ $listingActive->total() }} properti
                </p>
            @else
                <p class="text-gray-600 mt-2">
                    Saat ini tidak ada properti.
                </p>
            @endif

            <hr class="my-4 border-gray-300">
        </div>


        {{-- CARD START --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 max-w-7xl mx-auto">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @isset($listingActive)
                @if (count($listingActive) == 0)
                    <!-- Menggunakan grid untuk menempatkan konten di tengah -->
                    <div
                        class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col items-center justify-center h-96 text-center">
                        <!-- SVG Not Found -->
                        <img src="{{ asset('assets/svg/not-found.svg') }}" alt="Not Found" class="mb-4 w-24 h-24" />
                        <p class="text-lg font-semibold">Tidak ada properti yang ditemukan.</p>

                        <div class="mt-4">
                            <a href="{{ url()->previous() }}"
                                class="inline-block  text-black border-b-2 border-orange-500 hover:text-orange-500 hover:border-orange-700 transition-colors">
                                Lihat Semua Properti
                            </a>
                        </div>
                    </div>
                @else
                    @foreach ($listingActive as $data)
                        @php
                            $listingTypeMap = [
                                0 => 'Unknown',
                                null => 'Unknown',
                                1 => 'Rumah',
                                3 => 'Apart', // Matches the value="3" for "Apart"
                                5 => 'Office', // Matches the value="5" for "Office"
                                13 => 'Villa', // Matches the value="13" for "Villa"
                                6 => 'Pabrik', // Matches the value="6" for "Pabrik"
                                7 => 'Gudang', // Matches the value="7" for "Gudang"
                                9 => 'Soho', // Matches the value="9" for "Soho"
                                10 => 'Ruko', // Matches the value="10" for "Ruko"
                                4 => 'Hotel', // Matches the value="4" for "Hotel"
                                8 => 'Gedung', // Matches the value="8" for "Gedung"
                                11 => 'Tanah', // Matches the value="11" for "Tanah"
                                12 => 'Toko', // Matches the value="12" for "Toko"
                            ];

                            $hadapType = [
                                1 => 'Barat',
                                2 => 'Selatan',
                                3 => 'Timur',
                                4 => 'Utara',
                            ];

                            $location = [
                                1 => 'Asemrowo',
                                2 => 'Benowo',
                                3 => 'Bubutan',
                                4 => 'Bulak',
                                5 => 'Dukuh Pakis',
                                6 => 'Gayungan',
                                7 => 'Genteng',
                                8 => 'Gubeng',
                                9 => 'Gunung Anyar',
                                10 => 'Jambangan',
                                11 => 'Karang Pilang',
                                12 => 'Kenjeran',
                                13 => 'Krembangan',
                                14 => 'Lakarsantri',
                                15 => 'Mulyorejo',
                                16 => 'Pabean Cantian',
                                17 => 'Pakal',
                                18 => 'Rungkut',
                                19 => 'Sambikerep',
                                20 => 'Sawahan',
                                21 => 'Semampir',
                                22 => 'Simokerto',
                                23 => 'Sukolilo',
                                24 => 'Sukomanunggal',
                                25 => 'Tambaksari',
                                26 => 'Tandes',
                                27 => 'Tegalsari',
                                28 => 'Tenggilis Mejoyo',
                                29 => 'Wiyung',
                                30 => 'Wonocolo',
                                31 => 'Wonokromo',
                            ];

                        @endphp

                        <div class="swiper-slide">
                            <a href="{{ route('property.detail', $data->listingID) }}" class="block group">
                                <div class="max-w-sm mx-auto p-4 transition-transform transform group-hover:scale-105">
                                    <img alt="{{ $data->title }} - Dealkan"
                                        src="{{ asset('assets/' . $data->image_main) }}"
                                        class="h-56 w-full rounded-xl object-cover shadow-xl transition-opacity duration-700 ease-in-out opacity-0 group-hover:grayscale-[50%]"
                                        loading="lazy" decoding="async" width="320" height="224"
                                        onload="this.classList.remove('opacity-0')" fetchpriority="high" />

                                    <!-- Price (Top Middle) -->
                                    <div
                                        class="absolute top-3 left-1/2 transform -translate-x-1/2  whitespace-nowrap items-center bg-gradient-to-r from-orange-400 to-orange-600 text-white px-3 py-1 rounded-full shadow-md z-10">
                                        @if ($data->isPrimary == 0)
                                            <span
                                                class="font-semibold text-sm">Rp.{{ number_format($data->hargaJual, 0, ',', '.') }}</span>
                                        @else
                                            <span class="font-semibold text-sm">Mulai dari
                                                Rp.{{ number_format($data->hargaJual, 0, ',', '.') }}</span>
                                        @endif
                                    </div>

                                    <div class="flex justify-between items-center mt-4">
                                        <h1 class="font-bold text-lg">{{ mb_strimwidth($data->title, 0, 20, '...') }}</h1>
                                        <span class="bg-orange-600 text-white px-6 py-1 rounded-lg text-sm">
                                            @if ($data->isPrimary == 1)
                                                {{ $data->isPrimary == 1 ? 'Primary' : '' }}
                                            @else
                                                {{ $listingTypeMap[$data->listingType] }}
                                            @endif
                                        </span>
                                    </div>

                                    <div class="flex items-center text-gray-700 text-base">
                                        <svg class="w-6 h-6 text-gray-500 mr-1" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M12 2C8.1 2 5 5.1 5 9c0 4.9 7 13 7 13s7-8.1 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5s2.5 1.1 2.5 2.5S13.4 11.5 12 11.5z" />
                                        </svg>
                                        <div>
                                            @if ($data->isPrimary == 1)
                                                Kota Surabaya {{ $hadapType[$data->orientasiID] }}
                                            @else
                                                {{ $location[$data->lokasiID] }}, Surabaya
                                                {{ $hadapType[$data->orientasiID] }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            @endisset
        </div>

        {{-- Navigasi Pagination --}}
        <div class="flex justify-center items-center my-10 overflow-x-auto max-w-full">
            {{ $listingActive->links('pagination::tailwind') }}
        </div>
    </x-section>

    @section('scripts')
        @vite('resources/js/filter.js')
        <script>
            const filterButton = document.getElementById('filter-button');
            const filterCard = document.getElementById('filter-card');

            function toggleFilterCard() {
                filterCard.classList.toggle('hidden'); // Toggle visibility
                if (!filterCard.classList.contains('hidden')) {
                    document.addEventListener('click', handleOutsideClick);
                    document.body.classList.add('overflow-hidden');
                } else {
                    document.removeEventListener('click', handleOutsideClick);
                    document.body.classList.remove('overflow-hidden');
                }
            }

            // Event listener untuk tombol filter
            filterButton.addEventListener('click', function(event) {
                event.stopPropagation(); // Mencegah klik ini menutup filter card
                toggleFilterCard();
            });

            // Fungsi untuk menutup filter card jika klik di luar filter card
            function handleOutsideClick(event) {
                const isClickInsideFilterCard = filterCard.contains(event.target);
                const isClickInsideButton = filterButton.contains(event.target);

                if (!isClickInsideFilterCard && !isClickInsideButton) {
                    filterCard.classList.add('hidden'); // Tutup filter card
                    document.removeEventListener('click', handleOutsideClick); // Hapus event listener
                }
            }

            function toggleFilterCard() {
                filterCard.classList.toggle('hidden'); // Toggle visibility
                if (!filterCard.classList.contains('hidden')) {
                    document.addEventListener('click', handleOutsideClick);
                    document.body.classList.add('overflow-hidden');
                } else {
                    document.removeEventListener('click', handleOutsideClick);
                    document.body.classList.remove('overflow-hidden');
                }
            }
        </script>
    @endsection
</x-layout>

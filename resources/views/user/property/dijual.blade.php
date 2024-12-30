<x-layout title="Dijual Property">
    <?php
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

    $listingType = [
        1 => 'Rumah',
        2 => 'Toko',
        3 => 'Apartemen',
        4 => 'Hotel',
        5 => 'Office',
        6 => 'Pabrik',
        7 => 'Gudang',
        8 => 'Gedung',
        9 => 'Soho',
        10 => 'Ruko',
        11 => 'Tanah',
        12 => 'Toko',
        13 => 'Villa',
    ];

    $sertiType = [
        1 => 'HAK MILIK',
        2 => 'HAK GUNA BANGUNAN',
        3 => 'HAK PAKAI',
        4 => 'PPJB',
        5 => 'PETOK D',
        6 => 'SURAT IJO',
        7 => 'STRATE TITLE',
        0 => 'Lainnya',
    ];

    $posisiType = [
        1 => 'Standart',
        2 => 'Tusuk Sate',
        3 => 'Hook',
        4 => 'Kuldesak',
    ];
    ?>
    <!-- Search Section -->
    <div class="relative bg-cover bg-center h-96"
        style="background-image: url('{{ asset('assets/images/Others/secondary/secondary_bg.webp') }}');">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="relative flex flex-col justify-center items-center h-full px-4">
            <!-- Filters Section (Responsive) -->
            <div class="container mx-auto mt-4 px-4">
                <div class="flex flex-col md:flex-row md:justify-center space-y-4 md:space-y-0 md:space-x-4">
                    <form action="{{ route('property.jualSearch') }}" class="flex items-center w-full md:w-auto" method="GET">
                        <input
                            id="pencarian-input"
                            type="text"
                            name="Pencarian"
                            placeholder="Cari judul, lokasi"
                            class="px-4 py-3 w-full md:w-[33rem] rounded-md border border-gray-300 focus:outline-none focus:border-gray-500"
                            value=""
                            autocomplete="off"
                        >
                        <input type="hidden" name="source" value="dijual">
                        <button
                            type="submit"
                            class="px-6 py-3 mx-2 bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-md shadow-lg hover:to-orange-500 "
                        >
                            Cari
                        </button>
                    </form>
                    {{-- <button id="filter-button"
                        class="flex items-center justify-center bg-white px-4 py-2 h-12 border border-gray-300 rounded-md shadow hover:bg-gray-200 ">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="#000000" viewBox="0 0 24 24">
                            <path fill="#000000"
                                d="M10.83 5a3.001 3.001 0 0 0-5.66 0H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17ZM4 11h9.17a3.001 3.001 0 0 1 5.66 0H20a1 1 0 1 1 0 2h-1.17a3.001 3.001 0 0 1-5.66 0H4a1 1 0 1 1 0-2Zm1.17 6H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17a3.001 3.001 0 0 0-5.66 0Z" />
                        </svg>
                        Filter
                    </button> --}}
                </div>
            </div>
        </div>

        <!-- Filter Card Popup (Hidden by default) -->
        <div id="filter-card" class="hidden fixed inset-0 flex items-center justify-center z-30">
            <div class="bg-black bg-opacity-50 absolute inset-0" onclick="toggleFilterCard()"></div>
            <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg relative">
                <!-- Close Button -->
                <button class="absolute top-4 right-4 text-gray-600 hover:text-gray-800" onclick="toggleFilterCard()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <form action="{{route('property.jualSearch')}}" method="GET">
                    <!-- Filter Title -->
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">FILTER</h2>
                    <!-- Location Input -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                        <input id="lokasi-input" type="text" placeholder="Masukkan kota/kecamatan..."
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

                    <!-- Reset and Apply Buttons -->
                    <div class="flex justify-between items-center mt-4">
                        <button id="reset-filter-btn" class="text-orange-500 text-sm font-medium">Reset
                            Filter</button>
                        <button
                            class="bg-orange-500 text-white py-2 px-4 rounded-lg text-sm font-medium">Terapkan</button>
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

        <!-- Harga Card Popup (Hidden by default) -->
        <div id="harga-card"
            class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg relative">
                <!-- Close Button -->
                <button class="absolute top-4 right-4 text-gray-600 hover:text-gray-800" onclick="toggleHargaCard()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>


                <!-- Price Range -->
                <div class="w-full max-w-xl mx-auto p-4">

                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Harga</h2>
                    <!-- Price Range -->
                    <div class="mb-4">
                        <div class="flex items-center space-x-2">
                            <div class="relative w-1/2">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">Rp.</span>
                                <input type="text" id="min-harga-a" placeholder="Min"
                                    class="w-full pl-10 border border-gray-300 px-3 py-2 rounded-lg text-sm">
                            </div>
                            <span class="text-sm font-medium">-</span>
                            <div class="relative w-1/2">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">Rp.</span>
                                <input type="text" placeholder="Max" id="max-harga-a"
                                    class="w-full pl-10 border border-gray-300 px-3 py-2 rounded-lg text-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Additional Close Button for Mobile -->
                <button
                    class="md:hidden w-full mt-4 bg-gray-200 text-gray-800 py-2 rounded-lg text-sm font-medium flex items-center justify-center"
                    onclick="toggleFilterCard()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Close
                </button>
            </div>
        </div>
    </div>
    </div>

    <!-- Dijual Section -->
    <div class="container md:mx-auto my-10 text-nowrap whitespace-nowrap md:px-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <!-- Title centered on mobile and left-aligned on md+ screens -->
            <h2 class="text-3xl font-semibold text-gray-800 text-center md:text-left mx-4 md:mx-32">
                Properti Dijual
            </h2>
        </div>

        <!-- Horizontal line -->
        <hr class="my-4 border-gray-300 mx-4 md:mx-32">

        <!-- Pagination Text -->
        @if (!$jual == [])
            <div class="flex justify-center md:justify-start mx-4 md:mx-32">
                <p class="text-gray-600 mt-2 text-center md:text-left">
                    Menampilkan {{ $jual->firstItem() }}-{{ $jual->lastItem() }} dari total
                    {{ $jual->total() }} properti
                </p>
            </div>
        @endif
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

        @isset($jual)
            @if ($jual->isEmpty())
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
            @elseif ($jual && $jual->isEmpty())
            <!-- No properties found -->
            <div
                class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col items-center justify-center h-96 text-center">
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
                @foreach ($jual as $data)
                    @php
                        // $subdistrictTitle = $data['Subdistrict']['Title'] ?? '';
                        // $cityTitle = $data['Subdistrict']['City']['Title'] ?? '';
                        // $provinceTitle = $data['Subdistrict']['City']['Province']['Title'] ?? '';
                    @endphp

                <x-card link="{{ route('property.detail', $data->listingID) }}"
                    title="{{ $data->title }}" image="{{ asset('assets/' . $data->image_main) }}"
                    location="{{ $location[$data->lokasiID] }},  Surabaya {{ $hadapType[$data->orientasiID] }}"
                    status="{{ $data->transaksiID === 1 ? 'Dijual' : 'Disewa' }}"
                    type="{{ $listingType[$data->listingType] }}"
                    price="{{ format_price($data->hargaJual) }}" detailKM="{{ $data->ktUtama }}"
                    detailKMLain="{{ $data->ktLain }}" detailKT="{{ $data->kmUtama }}"
                    detailKTLain="{{ $data->kmLain }}" detailAreas="{{ $data->luasTanah }}"
                    buildingArea="{{ $data->luasBangunan }}" href="/properti-detail"></x-card>
                                @endforeach
                            @endif
                        @endisset


                    </div>

    {{-- PAGINATION --}}
    @if ($jual)
        <div class="flex justify-center items-center my-10 overflow-x-auto max-w-full">
            {{ $jual->links('pagination::tailwind') }}
        </div>
    @endif

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
        </script>
    @endsection
</x-layout>

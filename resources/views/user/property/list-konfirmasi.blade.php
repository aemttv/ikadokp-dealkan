<x-layout title="List Konfirmasi">
    <x-section>

        <div class="flex flex-col md:flex-row items-start md:space-x-8 pt-16 px-3"> <!-- Tambahkan pt-16 di sini -->


            <!-- Image Section -->
            <div class="w-full md:w-full mt-8 md:mt-0 flex justify-center md:justify-end">
                <div class="overflow-hidden rounded-lg shadow-lg w-full h-64 md:h-80"> <!-- Set fixed height -->
                    <img src="{{ asset('assets/images/Others/house.jpg') }}"
                        alt="Kantor Dealkan Surabaya Barat"
                        class="w-full h-full object-cover transition-opacity duration-500 ease-in-out opacity-0"
                        onload="this.classList.remove('opacity-0')" fetchpriority="high" />
                </div>
            </div>
        </div>

        <!-- Properti Baru Section -->
        <div class="container mx-auto my-10 px-10 md:px-6">
            <div class="flex justify-between items-center">
                <h2 id="orientasi" class="text-3xl font-semibold text-gray-800"> Daftar Menunggu Konfirmasi
                </h2>
                {{-- @if (!$konfirmasi == [])
                    <p class="text-gray-600 mt-2">
                        Menampilkan {{ $konfirmasi->firstItem() }}-{{ $konfirmasi->lastItem() }} dari total
                        {{ $konfirmasi->total() }} properti
                    </p>
                @endif --}}
                <div class="hidden lg:block">
                    {{-- kiri --}}
                    <div
                        class="konfirmasi-swiper-button-prev inline-block rounded-full border border-orange-600 p-3 text-orange-600 hover:bg-hoverColor hover:text-white focus:outline-none focus:ring active:bg-orange-500">
                        <span class="sr-only">Sebelumnya</span>
                        <!-- Ikon Panah Kiri -->
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </div>

                    {{-- Kanan --}}
                    <div
                        class="konfirmasi-swiper-button-next inline-block rounded-full border border-orange-600 p-3 text-orange-600 hover:bg-hoverColor hover:text-white focus:outline-none focus:ring active:bg-orange-500">
                        <span class="sr-only">Berikutnya</span>
                        <!-- Ikon Panah Kanan -->
                        <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-gray-300">
        </div>


        {{-- Menunggu Konfirmasi START --}}
        <div class="swiper-container-konfirmasi relative overflow-hidden">
            @if (count($konfirmasi) == 0)
                    <!-- Menggunakan grid untuk menempatkan konten di tengah -->
                    <div
                        class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col items-center justify-center h-96 text-center">
                        <!-- SVG Not Found -->
                        <img src="{{ asset('assets/svg/not-found.svg') }}" alt="Not Found" class="mb-4 w-24 h-24" />
                        <p class="text-lg font-semibold">Tidak ada properti yang ditemukan.</p>
                    </div>
                @endif
            <div class="swiper-wrapper mb-5">
            @isset($konfirmasi)
                    @foreach ($konfirmasi as $data)
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
            @endisset
            </div>


        {{-- Navigasi Pagination --}}
        {{-- <div class="flex justify-center items-center my-10 overflow-x-auto max-w-full">
            {{ $konfirmasi->links('pagination::tailwind') }}
        </div> --}}

        <!-- Tertolak Section -->
        <div class="container mx-auto my-10 px-10 md:px-6">
            <div class="flex justify-between items-center">
                <h2 id="orientasi" class="text-3xl font-semibold text-gray-800"> Daftar Properti Tertolak
                </h2>
                {{-- @if (!$tolak == [])
                    <p class="text-gray-600 mt-2">
                        Menampilkan {{ $tolak->firstItem() }}-{{ $tolak->lastItem() }} dari total
                        {{ $tolak->total() }} properti
                    </p>
                @endif --}}
                <div class="hidden lg:block">
                    {{-- kiri --}}
                    <div
                        class="tolak-swiper-button-prev inline-block rounded-full border border-orange-600 p-3 text-orange-600 hover:bg-hoverColor hover:text-white focus:outline-none focus:ring active:bg-orange-500">
                        <span class="sr-only">Sebelumnya</span>
                        <!-- Ikon Panah Kiri -->
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </div>

                    {{-- Kanan --}}
                    <div
                        class="tolak-swiper-button-next inline-block rounded-full border border-orange-600 p-3 text-orange-600 hover:bg-hoverColor hover:text-white focus:outline-none focus:ring active:bg-orange-500">
                        <span class="sr-only">Berikutnya</span>
                        <!-- Ikon Panah Kanan -->
                        <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-gray-300">
        </div>

        {{-- Tolak START --}}
        <div class="swiper-container-tolak relative overflow-hidden">
            @if (count($tolak) == 0)
                <!-- Menggunakan grid untuk menempatkan konten di tengah -->
                <div
                    class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col items-center justify-center h-96 text-center">
                    <!-- SVG Not Found -->
                    <img src="{{ asset('assets/svg/not-found.svg') }}" alt="Not Found"
                        class="mb-4 w-24 h-24" />
                    <p class="text-lg font-semibold">Tidak ada properti yang ditemukan.</p>
                </div>
            @endif
            <div class="swiper-wrapper mb-5">
                @isset($tolak)
                        @foreach ($tolak as $data)
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
                                    0 => 'Unknown',
                                    null => 'Unknown',
                                    1 => 'Barat',
                                    2 => 'Selatan',
                                    3 => 'Timur',
                                    4 => 'Utara',
                                ];

                                $location = [
                                    0 => 'Unknown',
                                    null => 'Unknown',
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
                                <a href="{{ route('property.detail', $data->listingID) }}">
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
                @endisset
            </div>
        </div>
        {{-- Navigasi Pagination --}}
        {{-- <div class="swiper-pagination absolute bottom-0"></div> --}}
    </x-section>

    @section('scripts')
    @vite('resources/js/home/home.js')
    @vite('resources/js/home/tolak.js')
        <script>
        </script>
    @endsection
</x-layout>

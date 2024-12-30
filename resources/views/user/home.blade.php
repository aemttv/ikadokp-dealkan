<x-layout title="Home">
    @section('css')
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <style>
            .swiper-button-disabled {
                opacity: 0.35;
                pointer-events: none;
            }
        </style>
    @endsection

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

    {{-- Hero Section Start --}}
    <section class="relative E0E0E0 h-[70vh] md:h-[80vh]">
        <!-- SVG as External Image -->
        <img src="{{ asset('assets/svg/hero-bg.svg') }}" alt="Latar belakang untuk halaman hero Dealkan"
            class="absolute top-0 left-0 w-full h-full object-cover" />

        <!-- Section Content -->
        <div class="relative h-full flex flex-col items-center justify-center">
            <!-- Container for Content with Maximum Width and Centering -->
            <div class="max-w-screen-xl mx-auto sm:px-5 mt-3 md:mt-10 w-full text-center lg:text-left">
                <div class="flex flex-col lg:flex-row items-center justify-between">
                    <!-- Content Text -->
                    <div class="flex flex-col justify-center w-full lg:w-2/3 mb-8 lg:mb-0">
                        <h1 class="text-xl md:text-4xl font-medium mb-2">
                            <span class="text-orange-600 to-orange-800">Dealkan</span> Dan Temukan Properti <br>
                            Impian Anda Bersama <span class="text-orange-600 to-orange-800">Kami.</span>
                        </h1>
                        <p class="mb-4 md:mt-7 text-base text-slate-500">
                            Cari properti menjadi mudah dan menyenangkan. Temukan rumah <br>
                            idaman Anda hari ini!
                        </p>
                        <div class="w-full rounded-lg px-4 md:px-0">
                            <form action="{{ route('property.search') }}" method="GET">
                                <div class="flex flex-wrap justify-center md:justify-start mb-4 md:mt-7">
                                    <label id="label-dijual"
                                        class="cursor-pointer text-black border-b-2 mx-2 transition-all duration-300 border-orange-500">
                                        <input type="radio" name="category" value="Dijual" class="hidden"
                                            onchange="updateLabelBorder(this, 'label-dijual');" checked>
                                        Dijual
                                    </label>
                                    <label id="label-disewa"
                                        class="cursor-pointer text-black border-b-2 mx-2 transition-all duration-300 rounded hover:bg-hoverColor hover:underline md:hover:bg-transparent md:hover:text-hoverColor md:p-0">
                                        <input type="radio" name="category" value="Disewa" class="hidden"
                                            onchange="updateLabelBorder(this, 'label-disewa');">
                                        Disewa
                                    </label>

                                </div>
                                <div class="flex flex-col md:flex-row items-center justify-center w-full md:mt-7">
                                    <input type="text" id="searchInput" name="search" placeholder="Cari properti"
                                        class="w-full md:w-3/4 h-10 border border-black rounded-md mb-2 md:mb-0 md:mr-2" autocomplete="off">
                                    <button type="submit"
                                        class="w-full md:w-1/4 h-10 bg-gradient-to-r rounded-md from-orange-400 to-orange-600 hover:to-orange-500 text-white text-sm hover:bg-hoverColor focus:ring-4 focus:outline-none font-medium">Cari</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Positioned at Bottom Right -->
            <div class="absolute bottom-0 right-0 mb-0 mr-0 z-[-6] hidden md:block">
                <img src="{{ asset('assets/images/hero.png') }}" alt="Ilustrasi hero Dealkan" class="w-auto h-auto">
            </div>
        </div>
    </section>
    {{-- Hero Section End --}}

    {{-- LOGIN START --}}
    @if (Auth::Check())
        <x-section>
            @if (Auth::Check())
                <div class="py-10">
                    <!-- In the Kitchen section -->
                    <div class="mb-8 text-center md:text-left">
                        <h2 class="text-left text-4xl font-bold" id="greeting"
                            data-username="{{ explode(' ', ucwords(Auth::user()->name))[0] }}"> Hi User</h2>
                        <h2 class="text-2xl font-bold flex justify-center items-center md:text-nowrap md:text-left">
                            <span class="text-black ">Selamat Datang Kembali</span>
                            <div class="hidden md:block flex-1 border-t border-gray-400 mx-4 md:ml-80"></div>
                        </h2>
                    </div>

                    <!-- Icons and text -->
                    <div class="flex flex-wrap justify-center gap-6">
                        <a href="{{ route('addPrimary.view') }}"
                            class="flex flex-col items-center text-center bg-orange-50 bg-opacity-80 p-4 rounded-lg shadow-md hover:bg-orange-100 w-40 h-28">
                            <i class="fas fa-home text-orange-500 text-4xl"></i>
                            <p class="mt-2 font-medium">Add Primary</p>
                        </a>
                        <a href="{{ route('add.view') }}"
                            class="flex flex-col items-center text-center bg-orange-50 bg-opacity-80 p-4 rounded-lg shadow-md hover:bg-orange-100 w-40 h-28">
                            <i class="fa-solid fa-hotel text-orange-500 text-4xl"></i>
                            <p class="mt-2 font-medium">Add Secondary</p>
                        </a>
                        <a href="{{ route('myListing.view', Auth::user()->id) }}"
                            class="flex flex-col items-center text-center bg-orange-50 bg-opacity-80 p-4 rounded-lg shadow-md hover:bg-orange-100 w-40 h-28">
                            <i class="fa-solid fa-table-list text-orange-500 text-4xl"></i>
                            <p class="mt-2 font-medium">My Listing</p>
                        </a>
                        <a href="{{ route('listKonfirmasi.view', Auth::user()->id) }}"
                            class="flex flex-col items-center text-center bg-orange-50 bg-opacity-80 p-4 rounded-lg shadow-md hover:bg-orange-100 w-40 h-28">
                            <svg class="w-12 h-12 text-orange-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z" clip-rule="evenodd"/>
                            </svg>
                            <p class="mt-2 font-medium">Listing Status</p>
                        </a>
                        <a href="{{ route('BuyRequest.view', Auth::user()->id) }}"
                            class="flex flex-col items-center text-center bg-orange-50 bg-opacity-80 p-4 rounded-lg shadow-md hover:bg-orange-100 w-40 h-28">
                            <i class="fa-solid fa-people-arrows text-orange-500 text-4xl"></i>
                            <p class="mt-2 font-medium">Buy Request</p>
                        </a>
                        <a href="{{ route('matchListing.view', Auth::user()->id) }}"
                            class="flex flex-col items-center text-center bg-orange-50 bg-opacity-80 p-4 rounded-lg shadow-md hover:bg-orange-100 w-40 h-28">
                            <i class="fa-solid fa-people-carry-box text-orange-500 text-4xl"></i>
                            <p class="mt-2 font-medium">Match Listing</p>
                        </a>
                    </div>
            @endif
                <!-- Inspiration section -->
                <div class="text-center mt-12">
                    <h2 class="text-center md:text-right text-4xl font-bold text-orange-600 to-orange-800"> Strategis </h2>
                    <h2 class="text-2xl font-bold flex justify-center items-center md:text-nowrap md:text-right">
                        <div class="hidden md:block flex-1 border-t border-gray-400 mr-48"></div>
                        <span>Temukan Properti di Lokasi Strategis</span>
                    </h2>
                </div>
            </div>

        </x-section>
        <x-section>
            {{-- <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 lg:gap-8 px-4 mt-8"> --}}
            <div class="swiper-container-strategic p-2 overflow-hidden relative pb-8 mt-5">
                <div class="swiper-wrapper">

                    {{-- Barat --}}
                    <div
                        class="max-h-[450px] max-w-[400px] min-h-[250px] min-w-[200px] mx-auto overflow-hidden rounded-lg group swiper-slide">
                        <!-- Background Image -->
                        <img src="{{ asset('assets/images/Strategics/barat.webp') }}"
                            alt="Total Listing Properti Dealkan Di Surabaya Barat" crossorigin="anonymous"
                            loading="lazy"
                            srcset="{{ asset('assets/images/Strategics/barat.webp') }} 400w,
                                    {{ asset('assets/images/Strategics/barat@2x.webp') }} 800w"
                            sizes="(max-width: 400px) 100vw, 400px"
                            class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110 rounded-lg">

                        <!-- Overlay Card -->
                        <div class="absolute bottom-4 left-4 bg-white p-4 rounded-lg shadow-lg">
                            <h2 class="text-xl font-bold text-gray-800">Surabaya Barat</h2>
                            <p class="text-sm text-gray-600"> {{$baratCount}} Listings</p>
                        </div>
                    </div>

                    {{-- Selatan --}}
                    <div
                        class="max-h-[450px] max-w-[400px] min-h-[250px] min-w-[200px] mx-auto overflow-hidden rounded-lg group swiper-slide">
                        <!-- Background Image -->
                        <img src="{{ asset('assets/images/Strategics/selatan.webp') }}"
                            alt="Total Listing Properti Dealkan Di Surabaya Selatan" crossorigin="anonymous"
                            loading="lazy"
                            srcset="{{ asset('assets/images/Strategics/selatan.webp') }} 400w,
                                    {{ asset('assets/images/Strategics/selatan@2x.webp') }} 800w"
                            sizes="(max-width: 400px) 100vw, 400px"
                            class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110 rounded-lg">

                        <!-- Overlay Card -->
                        <div class="absolute bottom-4 left-4 bg-white p-4 rounded-lg shadow-lg">
                            <h2 class="text-xl font-bold text-gray-800">Surabaya Selatan</h2>
                            <p class="text-sm text-gray-600">{{$selatanCount}} Property Listings</p>
                        </div>
                    </div>

                    {{-- Timur --}}
                    <div
                        class="relative max-h-[450px] max-w-[400px] min-h-[250px] min-w-[200px] mx-auto overflow-hidden rounded-lg group swiper-slide">
                        <!-- Background Image -->
                        <img src="{{ asset('assets/images/Strategics/timur.webp') }}"
                            alt="Total Listing Properti Dealkan Di Surabaya Timur" crossorigin="anonymous"
                            loading="lazy"
                            srcset="{{ asset('assets/images/Strategics/timur.webp') }} 400w,
                                    {{ asset('assets/images/Strategics/timur@2x.webp') }} 800w"
                            sizes="(max-width: 400px) 100vw, 400px"
                            class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">

                        <!-- Overlay Card -->
                        <div class="absolute bottom-4 left-4 bg-white p-4 rounded-lg shadow-lg">
                            <h2 class="text-xl font-bold text-gray-800">Surabaya Timur</h2>
                            <p class="text-sm text-gray-600">{{$timurCount}} Property Listings</p>
                        </div>
                    </div>

                    {{-- Utara --}}
                    <div
                        class="relative max-h-[450px] max-w-[400px] min-h-[250px] min-w-[200px] mx-auto overflow-hidden rounded-lg group swiper-slide">
                        <!-- Background Image -->
                        <img src="{{ asset('assets/images/Strategics/utara.webp') }}"
                            alt="Total Listing Properti Dealkan Di Surabaya Utara" crossorigin="anonymous"
                            loading="lazy"
                            srcset="{{ asset('assets/images/Strategics/utara.webp') }} 400w,
                                    {{ asset('assets/images/Strategics/utara@2x.webp') }} 800w"
                            sizes="(max-width: 400px) 100vw, 400px"
                            class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">

                        <!-- Overlay Card -->
                        <div class="absolute bottom-4 left-4 bg-white p-4 rounded-lg shadow-lg">
                            <h2 class="text-xl font-bold text-gray-800">Surabaya Utara</h2>
                            <p class="text-sm text-gray-600">{{$utaraCount}} Property Listings</p>
                        </div>
                    </div>

                </div>
                <div class="swiper-pagination bottom-0 left-1/2"></div>
            </div>
            <!-- Pagination -->

            {{-- PRIMARY SECTION START --}}
            <x-section>
                <div class="p-5 text-center sm:text-start">
                    <div class="flex justify-between">
                        <div class="">
                            <h1 class="text-black text-xl font-bold">Proyek Baru</h1>
                            <p class="text-slate-500">Jelajahi proyek terbaru dari berbagai vendor, mulai dari rumah
                                minimalis,
                                ruko
                                <br>
                                strategis, hingga apartemen modern.
                            </p>
                        </div>

                        <div class="hidden lg:block">
                            {{-- kiri --}}
                            <div
                                class="primary-swiper-button-prev inline-block rounded-full border border-orange-600 p-3 text-orange-600 hover:bg-hoverColor hover:text-white focus:outline-none focus:ring active:bg-orange-500">
                                <span class="sr-only"> Download </span>
                                <!-- Ikon Panah Kiri -->
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                            </div>

                            {{-- Kanan --}}
                            <div
                                class="primary-swiper-button-next inline-block rounded-full border border-orange-600 p-3 text-orange-600 hover:bg-hoverColor hover:text-white focus:outline-none focus:ring active:bg-orange-500">
                                <span class="sr-only"> Download </span>

                                <svg class="size-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- Swiper Container -->
                <div class="swiper-container-primary relative overflow-hidden">
                    <div class="swiper-wrapper mb-5">
                        @isset($primary)
                            @if (count($primary) == 0)
                                <!-- Menggunakan grid untuk menempatkan konten di tengah -->
                                <div
                                    class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col items-center justify-center h-96 text-center">
                                    <!-- SVG Not Found -->
                                    <img src="{{ asset('assets/svg/not-found.svg') }}" alt="Not Found"
                                        class="mb-4 w-24 h-24" />
                                    <p class="text-lg font-semibold">Tidak ada properti yang ditemukan.</p>

                                </div>
                            @endif
                            @foreach ($primary as $data)
                                <div class="swiper-slide">
                                    <a href="{{ route('property.detail', $data->listingID) }}" class="block group">
                                        <div
                                            class="max-w-sm mx-auto p-4 transition-transform transform group-hover:scale-105">
                                            <img alt="{{ $data->title }} - Dealkan"
                                                src="{{ asset('assets/' . $data->image_main) }}"
                                                class="h-56 w-full rounded-xl object-cover shadow-xl transition-opacity duration-700 ease-in-out opacity-0 group-hover:grayscale-[50%]"
                                                loading="lazy" decoding="async" width="320" height="224"
                                                onload="this.classList.remove('opacity-0')" fetchpriority="high" />

                                            <div class="flex justify-between items-center mt-4">
                                                <h1 class="font-bold text-xl">{{ mb_strimwidth($data->title, 0, 22, '...') }}</h1>
                                                <span class="bg-orange-600 text-white px-6 py-1 rounded-lg">Baru</span>
                                            </div>

                                            <div class="flex items-center text-gray-700 text-base">
                                                <svg class="w-6 h-6 text-gray-500 mr-1" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 2C8.1 2 5 5.1 5 9c0 4.9 7 13 7 13s7-8.1 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5s2.5 1.1 2.5 2.5S13.4 11.5 12 11.5z" />
                                                </svg>
                                                <div>
                                                    Kota Surabaya {{ $hadapType[$data->orientasiID] }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination absolute bottom-0"></div>
                </div>

                {{-- button see all start --}}
                <div class="mx-auto text-center mt-5">
                    <a href="{{ route('pbaru.show') }}"
                        class="px-12 py-3 bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white font-semibold rounded-md shadow hover:bg-hoverColor focus:outline-none focus:ring-2 focus:ring-orange-400 active:bg-orange-700 transition duration-300 ease-in-out">
                        Lihat Semua Proyek
                    </a>
                </div>
                {{-- button see all end --}}
            </x-section>
            {{-- PRIMARY SECTION END --}}

            {{-- SECONDARY SECTION START --}}
            <x-section>
                <div class="p-5 text-center md:text-start">
                    <div class="flex justify-between">
                        <div class="">
                            <h1 class="text-black text-xl font-bold">Properti Baru</h1>
                            <p class="text-slate-500">Jelajahi properti dari rumah minimalis, ruko strategis, hingga
                                apartemen
                                modern.
                                <br> Temukan properti yang sesuai dengan kebutuhan Anda.
                            </p>
                        </div>
                        <div class="hidden lg:block">
                            {{-- kiri --}}
                            <div
                                class="secondary-swiper-button-prev inline-block rounded-full border border-orange-600 p-3 text-orange-600 hover:bg-hoverColor hover:text-white focus:outline-none focus:ring active:bg-orange-500">
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
                                class="secondary-swiper-button-next inline-block rounded-full border border-orange-600 p-3 text-orange-600 hover:bg-hoverColor hover:text-white focus:outline-none focus:ring active:bg-orange-500">
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
                </div>

                {{-- CARD START --}}
                <div class="swiper-container-secondary relative overflow-hidden">
                    <div class="swiper-wrapper mb-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @isset($secondary)
                            @if (count($secondary) == 0)
                                <!-- Menggunakan grid untuk menempatkan konten di tengah -->
                                <div
                                    class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col items-center justify-center h-96 text-center">
                                    <!-- SVG Not Found -->
                                    <img src="{{ asset('assets/svg/not-found.svg') }}" alt="Not Found"
                                        class="mb-4 w-24 h-24" />
                                    <p class="text-lg font-semibold">Tidak ada properti yang ditemukan.</p>

                                    <div class="mt-4">
                                        <a href="{{ url()->previous() }}"
                                            class="inline-block  text-black border-b-2 border-orange-500 hover:text-orange-500 hover:border-orange-700 transition-colors">
                                            Lihat Semua Properti
                                        </a>
                                    </div>
                                </div>
                            @else
                                @foreach ($secondary as $data)
                                <div class="swiper-slide">
                                    <x-card link="{{ route('property.detail', $data->listingID) }}"
                                        title="{{ $data->title }}" image="{{ asset('assets/' . $data->image_main) }}"
                                        location="{{ $location[$data->lokasiID] }},  Surabaya {{ $hadapType[$data->orientasiID] }}"
                                        status="{{ $data->transaksiID === 1 ? 'Dijual' : 'Disewa' }}"
                                        type="{{ $listingType[$data->listingType] }}"
                                        price="{{ format_price($data->hargaJual) }}" detailKM="{{ $data->ktUtama }}"
                                        detailKMLain="{{ $data->ktLain }}" detailKT="{{ $data->kmUtama }}"
                                        detailKTLain="{{ $data->kmLain }}" detailAreas="{{ $data->luasTanah }}"
                                        buildingArea="{{ $data->luasBangunan }}" href="/properti-detail"></x-card>
                                </div>
                                @endforeach
                            @endif
                        @endisset
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination absolute bottom-0"></div>
                </div>
                {{-- CARD END --}}
                {{-- button see all start --}}
                <div class="mx-auto text-center mt-10">
                    <a href="{{ route('djual.show') }}"
                        class="px-12 my-2 md:my-0 mx-5 py-2 text-nowrap bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white font-semibold rounded-md shadow hover:bg-hoverColor focus:outline-none focus:ring-2 focus:ring-orange-400 active:bg-orange-700 transition duration-300 ease-in-out block sm:inline-block">
                        Lihat Semua Properti Di Jual
                    </a>
                    <a href="{{ route('dsewa.show') }}"
                        class="px-12 my-2 md:my-0 mx-5 py-2 text-nowrap bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white font-semibold rounded-md shadow hover:bg-hoverColor focus:outline-none focus:ring-2 focus:ring-orange-400 active:bg-orange-700 transition duration-300 ease-in-out block sm:inline-block">
                        Lihat Semua Properti Di Sewa
                    </a>
                </div>
                {{-- button see all end --}}
            </x-section>
        </x-section>
        {{-- LOGIN SECTION END --}}
    @else
        {{-- NOT LOGIN SECTION --}}
        {{-- Strategic Section Start --}}
        <x-section>
            <div class="text-center">
                <h2 class="text-base font-semibold text-orange-600 tracking-wide uppercase">Strategis</h2>
                <h1 class="text-xl md:text-4xl font-bold">Temukan Properti di Lokasi Strategis</h1>
                <p class="text-xs text-gray-500 md:text-base whitespace-pre-line">
                    Lokasi yang tepat untuk investasi masa depan Anda,
                    memberikan kenyamanan serta potensi keuntungan jangka panjang.
                </p>
            </div>

            {{-- <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 lg:gap-8 px-4 mt-8"> --}}
            <div class="swiper-container-strategic p-2 overflow-hidden relative pb-8 mt-5">
                <div class="swiper-wrapper">

                    {{-- Barat --}}
                    <div
                        class="max-h-[450px] max-w-[400px] min-h-[250px] min-w-[200px] mx-auto overflow-hidden rounded-lg group swiper-slide">
                        <!-- Background Image -->
                        <img src="{{ asset('assets/images/Strategics/barat.webp') }}"
                            alt="Total Listing Properti Dealkan Di Surabaya Barat" crossorigin="anonymous"
                            loading="lazy"
                            srcset="{{ asset('assets/images/Strategics/barat.webp') }} 400w,
                                    {{ asset('assets/images/Strategics/barat@2x.webp') }} 800w"
                            sizes="(max-width: 400px) 100vw, 400px"
                            class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110 rounded-lg">

                        <!-- Overlay Card -->
                        <div class="absolute bottom-4 left-4 bg-white p-4 rounded-lg shadow-lg">
                            <h2 class="text-xl font-bold text-gray-800">Surabaya Barat</h2>
                            <p class="text-sm text-gray-600"> {{$baratCount}} Property Listings</p>
                        </div>
                    </div>

                    {{-- Selatan --}}
                    <div
                        class="max-h-[450px] max-w-[400px] min-h-[250px] min-w-[200px] mx-auto overflow-hidden rounded-lg group swiper-slide">
                        <!-- Background Image -->
                        <img src="{{ asset('assets/images/Strategics/selatan.webp') }}"
                            alt="Total Listing Properti Dealkan Di Surabaya Selatan" crossorigin="anonymous"
                            loading="lazy"
                            srcset="{{ asset('assets/images/Strategics/selatan.webp') }} 400w,
                                    {{ asset('assets/images/Strategics/selatan@2x.webp') }} 800w"
                            sizes="(max-width: 400px) 100vw, 400px"
                            class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110 rounded-lg">

                        <!-- Overlay Card -->
                        <div class="absolute bottom-4 left-4 bg-white p-4 rounded-lg shadow-lg">
                            <h2 class="text-xl font-bold text-gray-800">Surabaya Selatan</h2>
                            <p class="text-sm text-gray-600"> {{$selatanCount}} Property Listings</p>
                        </div>
                    </div>

                    {{-- Timur --}}
                    <div
                        class="relative max-h-[450px] max-w-[400px] min-h-[250px] min-w-[200px] mx-auto overflow-hidden rounded-lg group swiper-slide">
                        <!-- Background Image -->
                        <img src="{{ asset('assets/images/Strategics/timur.webp') }}"
                            alt="Total Listing Properti Dealkan Di Surabaya Timur" crossorigin="anonymous"
                            loading="lazy"
                            srcset="{{ asset('assets/images/Strategics/timur.webp') }} 400w,
                                    {{ asset('assets/images/Strategics/timur@2x.webp') }} 800w"
                            sizes="(max-width: 400px) 100vw, 400px"
                            class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">

                        <!-- Overlay Card -->
                        <div class="absolute bottom-4 left-4 bg-white p-4 rounded-lg shadow-lg">
                            <h2 class="text-xl font-bold text-gray-800">Surabaya Timur</h2>
                            <p class="text-sm text-gray-600"> {{$timurCount}} Property Listings</p>
                        </div>
                    </div>

                    {{-- Utara --}}
                    <div
                        class="relative max-h-[450px] max-w-[400px] min-h-[250px] min-w-[200px] mx-auto overflow-hidden rounded-lg group swiper-slide">
                        <!-- Background Image -->
                        <img src="{{ asset('assets/images/Strategics/utara.webp') }}"
                            alt="Total Listing Properti Dealkan Di Surabaya Utara" crossorigin="anonymous"
                            loading="lazy"
                            srcset="{{ asset('assets/images/Strategics/utara.webp') }} 400w,
                                    {{ asset('assets/images/Strategics/utara@2x.webp') }} 800w"
                            sizes="(max-width: 400px) 100vw, 400px"
                            class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">

                        <!-- Overlay Card -->
                        <div class="absolute bottom-4 left-4 bg-white p-4 rounded-lg shadow-lg">
                            <h2 class="text-xl font-bold text-gray-800">Surabaya Utara</h2>
                            <p class="text-sm text-gray-600"> {{$utaraCount}} Property Listings</p>
                        </div>
                    </div>

                </div>
                <div class="swiper-pagination bottom-0 left-1/2"></div>
            </div>
            <!-- Pagination -->
        </x-section>
        {{-- Strategic Section End --}}

        {{-- Carousel Section Start --}}
        <section class="mt-3 md:mt-10">
            <div class="w-full">
                <img src="{{ asset('assets/images/Banners/vision.webp') }}" class="w-full object-cover h-44 md:h-72"
                    alt="Visi Dealkan" srcset="">
            </div>
        </section>
        {{-- Carousel Section End --}}

        {{-- PRIMARY SECTION START --}}
        <x-section>
            <div class="p-5 text-center sm:text-start">
                <div class="flex justify-between">
                    <div class="">
                        <h1 class="text-black text-xl font-bold">Proyek Baru</h1>
                        <p class="text-slate-500">Jelajahi proyek terbaru dari berbagai vendor, mulai dari rumah
                            minimalis,
                            ruko
                            <br>
                            strategis, hingga apartemen modern.
                        </p>
                    </div>

                    <div class="hidden lg:block">
                        {{-- kiri --}}
                        <div
                            class="primary-swiper-button-prev inline-block rounded-full border border-orange-600 p-3 text-orange-600 hover:bg-hoverColor hover:text-white focus:outline-none focus:ring active:bg-orange-500">
                            <span class="sr-only"> Download </span>
                            <!-- Ikon Panah Kiri -->
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </div>

                        {{-- Kanan --}}
                        <div
                            class="primary-swiper-button-next inline-block rounded-full border border-orange-600 p-3 text-orange-600 hover:bg-hoverColor hover:text-white focus:outline-none focus:ring active:bg-orange-500">
                            <span class="sr-only"> Download </span>

                            <svg class="size-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Swiper Container -->
            <div class="swiper-container-primary relative overflow-hidden">
                <div class="swiper-wrapper mb-5">
                    @isset($primary)
                        @if (count($primary) == 0)
                            <!-- Menggunakan grid untuk menempatkan konten di tengah -->
                            <div
                                class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col items-center justify-center h-96 text-center">
                                <!-- SVG Not Found -->
                                <img src="{{ asset('assets/svg/not-found.svg') }}" alt="Not Found"
                                    class="mb-4 w-24 h-24" />
                                <p class="text-lg font-semibold">Tidak ada properti yang ditemukan.</p>

                            </div>
                        @endif
                        @foreach ($primary as $data)
                            <div class="swiper-slide">
                                <a href="{{ route('property.detail', $data->listingID) }}" class="block group">
                                    <div class="max-w-sm mx-auto p-4 transition-transform transform group-hover:scale-105">
                                        <img alt="{{ $data->title }} - Dealkan"
                                            src="{{ asset('assets/' . $data->image_main) }}"
                                            class="h-56 w-full rounded-xl object-cover shadow-xl transition-opacity duration-700 ease-in-out opacity-0 group-hover:grayscale-[50%]"
                                            loading="lazy" decoding="async" width="320" height="224"
                                            onload="this.classList.remove('opacity-0')" fetchpriority="high" />

                                        <div class="flex justify-between items-center mt-4">
                                            <h1 class="font-bold text-xl">{{ mb_strimwidth($data->title, 0, 22, '...') }}</h1>
                                            <span class="bg-orange-600 text-white px-6 py-1 rounded-lg">Baru</span>
                                        </div>

                                        <div class="flex items-center text-gray-700 text-base">
                                            <svg class="w-6 h-6 text-gray-500 mr-1" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M12 2C8.1 2 5 5.1 5 9c0 4.9 7 13 7 13s7-8.1 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5s2.5 1.1 2.5 2.5S13.4 11.5 12 11.5z" />
                                            </svg>
                                            <div>
                                                Kota Surabaya {{ $hadapType[$data->orientasiID] }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endisset
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination absolute bottom-0"></div>
            </div>

            {{-- button see all start --}}
            <div class="mx-auto text-center mt-5">
                <a href="{{ route('pbaru.show') }}"
                    class="px-12 py-3 bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white font-semibold rounded-md shadow hover:bg-hoverColor focus:outline-none focus:ring-2 focus:ring-orange-400 active:bg-orange-700 transition duration-300 ease-in-out">
                    Lihat Semua Proyek
                </a>
            </div>
            {{-- button see all end --}}
        </x-section>
        {{-- PRIMARY SECTION END --}}

        {{-- SECONDARY SECTION START --}}
        <x-section>
            <div class="p-5 text-center md:text-start">
                <div class="flex justify-between">
                    <div class="">
                        <h1 class="text-black text-xl font-bold">Properti Baru</h1>
                        <p class="text-slate-500">Jelajahi properti dari rumah minimalis, ruko strategis, hingga
                            apartemen
                            modern.
                            <br> Temukan properti yang sesuai dengan kebutuhan Anda.
                        </p>
                    </div>
                    <div class="hidden lg:block">
                        {{-- kiri --}}
                        <div
                            class="secondary-swiper-button-prev inline-block rounded-full border border-orange-600 p-3 text-orange-600 hover:bg-hoverColor hover:text-white focus:outline-none focus:ring active:bg-orange-500">
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
                            class="secondary-swiper-button-next inline-block rounded-full border border-orange-600 p-3 text-orange-600 hover:bg-hoverColor hover:text-white focus:outline-none focus:ring active:bg-orange-500">
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
            </div>

            {{-- CARD START --}}
            <div class="swiper-container-secondary relative overflow-hidden">
                <div class="swiper-wrapper mb-5">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @isset($secondary)
                        @if (count($secondary) == 0)
                            <!-- Menggunakan grid untuk menempatkan konten di tengah -->
                            <div
                                class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col items-center justify-center h-96 text-center">
                                <!-- SVG Not Found -->
                                <img src="{{ asset('assets/svg/not-found.svg') }}" alt="Not Found"
                                    class="mb-4 w-24 h-24" />
                                <p class="text-lg font-semibold">Tidak ada properti yang ditemukan.</p>

                                <div class="mt-4">
                                    <a href="{{ url()->previous() }}"
                                        class="inline-block  text-black border-b-2 border-orange-500 hover:text-orange-500 hover:border-orange-700 transition-colors">
                                        Lihat Semua Properti
                                    </a>
                                </div>
                            </div>
                        @else
                            @foreach ($secondary as $data)
                                <div class="swiper-slide">
                                    <x-card link="{{ route('property.detail', $data->listingID) }}"
                                        title="{{ $data->title }}" image="{{ asset('assets/' . $data->image_main) }}"
                                        location="{{ $location[$data->lokasiID] }},  Surabaya {{ $hadapType[$data->orientasiID] }}"
                                        status="{{ $data->transaksiID === 1 ? 'Dijual' : 'Disewa' }}"
                                        type="{{ $listingType[$data->listingType] }}"
                                        price="{{ format_price($data->hargaJual) }}" detailKM="{{ $data->kmUtama }}"
                                        detailKMLain="{{ $data->kmLain }}" detailKT="{{ $data->ktUtama }}"
                                        detailKTLain="{{ $data->ktLain }}" detailAreas="{{ $data->luasTanah }}"
                                        buildingArea="{{ $data->luasBangunan }}" href="/properti-detail"></x-card>
                                </div>
                            @endforeach
                        @endif
                    @endisset
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination absolute bottom-0"></div>
            </div>
            {{-- CARD END --}}
            {{-- button see all start --}}
            <div class="mx-auto text-center mt-10">
                <a href="{{ route('djual.show') }}"
                    class="px-12 my-2 md:my-0 mx-5 py-3 bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white font-semibold rounded-md shadow hover:bg-hoverColor focus:outline-none focus:ring-2 focus:ring-orange-400 active:bg-orange-700 transition duration-300 ease-in-out block sm:inline-block">
                    Lihat Semua Properti Di Jual
                </a>
                <a href="{{ route('dsewa.show') }}"
                    class="px-12 my-2 md:my-0 mx-5 py-3 bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white font-semibold rounded-md shadow hover:bg-hoverColor focus:outline-none focus:ring-2 focus:ring-orange-400 active:bg-orange-700 transition duration-300 ease-in-out block sm:inline-block">
                    Lihat Semua Properti Di Sewa
                </a>
            </div>
            {{-- button see all end --}}
        </x-section>
    @endif
    {{-- NOT LOGIN YET END --}}


    {{-- Hubungi Kami Section START --}}
    <x-hubungi></x-hubungi>
    {{-- Hubungi Kami Section END --}}

    <style>
        .orange-text {
            color: orange;
        }
    </style>


    @section('scripts')
        @vite('resources/js/home/home.js')
        <script>
            // Update Label Border
            function updateLabelBorder(inputElement, labelId) {
                document.querySelectorAll('label').forEach(function(label) {
                    label.classList.remove('border-orange-500');
                });

                const label = document.getElementById(labelId);
                label.classList.add('border-orange-500');
            }

            // JavaScript to set the current date in the format "DD - MMMM - YYYY"
            document.addEventListener('DOMContentLoaded', function() {
                const currentDateElement = document.getElementById('current-date');
                const options = {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                };

                const today = new Date().toLocaleDateString('id-ID', options).replace(/\s/g, ' - ');
                currentDateElement.textContent = today;
            });

            // JavaScript to set the greeting based on the time of day
            const greetingElement = document.getElementById('greeting');
            const currentHour = new Date().toLocaleString('en-US', {
                timeZone: 'Asia/Jakarta',
                hour: '2-digit',
                hour12: false
            });

            let greeting;
            const username = greetingElement.getAttribute('data-username'); // Get the username from the HTML element

            if (currentHour >= 0 && currentHour < 10) {
                greeting = `Pagi, ${username}!`;
            } else if (currentHour >= 11 && currentHour < 12) {
                greeting = `Siang, ${username}!`;
            } else if (currentHour >= 13 && currentHour < 18) {
                greeting = `Sore, ${username}!`;
            } else {
                greeting = `Malam, ${username}!`;
            }

            // Set the greeting text content
            greetingElement.textContent = greeting;
            greetingElement.className = 'text-orange-600 to-orange-800 text-4xl font-bold';
        </script>
    @endsection
</x-layout>

<x-layout title="Detail">
    {{-- SECONDARY --}}
    @if ($property->isPrimary == 0)
        <div class="bg-white font-sans leading-normal tracking-normal">
            <div class="max-w-7xl mx-auto p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-16 md:mt-14">
                    @isset($property)
                        <!-- Main Image -->
                        @if ($property->image_second || $property->image_third)
                            <div class="lg:col-span-2 relative">
                                <a href="{{ url()->previous() != url()->current() ? url()->previous() : url('/') }}"
                                    class="absolute top-3 left-3 bg-white text-gray-800 px-3 py-1 rounded-full shadow-md hover:bg-gray-200 z-10 transition duration-300">
                                    ← Kembali
                                </a>
                                <div class="w-full h-[400px] overflow-hidden rounded-lg">
                                    <img class="w-full h-full object-cover rounded-lg shadow-xl transition-all duration-500 ease-in-out"
                                        src="{{ $property->image_main ? asset('assets/' . $property->image_main) : asset('images/default-placeholder.png') }}"
                                        alt="Property" onload="this.classList.remove('opacity-50', 'grayscale')"
                                        loading="lazy" fetchpriority="high" />
                                </div>
                            </div>
                        @else
                            <div class="lg:col-span-3 relative">
                                <a href="{{ url()->previous() != url()->current() ? url()->previous() : url('/') }}"
                                    class="absolute top-3 left-3 bg-white text-gray-800 px-3 py-1 rounded-full shadow-md hover:bg-gray-200 z-10 transition duration-300">
                                    ← Kembali
                                </a>
                                <div class="w-full h-[400px] overflow-hidden rounded-lg">
                                    <img class="w-full h-full object-cover rounded-lg shadow-xl transition-all duration-500 ease-in-out"
                                        src="{{ $property->image_main ? asset('assets/' . $property->image_main) : asset('images/default-placeholder.png') }}"
                                        alt="Property" onload="this.classList.remove('opacity-50', 'grayscale')"
                                        loading="lazy" fetchpriority="high" />
                                </div>
                            </div>
                        @endif
                        <!-- Side Images -->
                        @if ($property->image_second || $property->image_third)
                            <div class="lg:col-span-1 space-y-6">
                                @if ($property->image_second)
                                    <div class="relative group overflow-hidden rounded-lg">
                                        <img class="w-full h-[190px] object-cover "
                                            src="{{ asset('assets/' . $property->image_second) }}" alt="Gambar Kecil 1"
                                            loading="lazy" fetchpriority="high" />
                                    </div>
                                @endif

                                @if ($property->image_third)
                                    <div class="relative group overflow-hidden rounded-lg">
                                        <img class="w-full h-[190px] object-cover "
                                            src="{{ asset('assets/' . $property->image_third) }}" alt="Gambar Kecil 2"
                                            loading="lazy" fetchpriority="high" />
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endisset
                </div>
            </div>
            {{-- DETAIL PROPERTY --}}
            <div class="bg-white font-sans leading-normal tracking-normal">
                <div class="max-w-7xl mx-auto ">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">
                        <!-- Bagian Bawah: Deskripsi, Rating, Harga, Tombol -->
                        <div class="lg:col-span-2 space-y-4">
                            <div class="bg-white p-6 rounded-lg shadow-xl w-full">
                                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                                    <!-- Title Section -->
                                    <div class="w-full lg:w-auto space-y-2">
                                        <h1 class="text-xl md:text-2xl font-bold text-gray-800">
                                            {{ $property->title }}
                                        </h1>
                                    </div>

                                    <!-- Status Section -->
                                    <div class="sm:flex sm:flex-col sm:gap-2 md:flex-row lg:flex-row md:space-x-4 lg:gap-4">
                                        @if ($property->statusListing == 0 || $property->statusListing == 2)
                                        <p class="inline-block text-white border bg-gradient-to-r from-red-400 to-red-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            {{ $property->statusListing == 1 ? 'Terverifikasi' : ($property->statusListing == 2 ? 'Menunggu Verifikasi' : 'Tidak Valid') }}
                                        </p>
                                        @endif

                                        <p class="inline-block text-orange-600 border border-orange-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            {{ $property->kondisiPerabotanID == 1 ? 'Furnished' : ($property->kondisiPerabotanID == 2 ? 'Semi-Furnished' : 'Unfurnished') }}
                                        </p>

                                        <p class="inline-block text-orange-600 border border-orange-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            {{ $property->isPrimary == 0 ? 'Secondary' : 'Primary' }}
                                        </p>
                                    </div>
                                </div>


                                @php
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
                                <p class="flex text-sm text-gray-600 mb-4 mt-4">
                                    <svg class="w-6 h-6 text-gray-500 mr-2" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M12 2C8.1 2 5 5.1 5 9c0 4.9 7 13 7 13s7-8.1 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5s2.5 1.1 2.5 2.5S13.4 11.5 12 11.5z" />
                                    </svg>
                                    {{ $location[$property->lokasiID] ?? 'Unknown' }}, Kota Surabaya,
                                    {{ $property->orientasiID === 0 ? 'Surabaya' : 'Jawa Timur' }}
                                </p>
                                <hr class="my-4">

                                {{-- Start of Detail Property --}}

                                @php
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

                                    $listrik = [
                                        1 => '0',
                                        2 => '450',
                                        3 => '900',
                                        4 => '1300',
                                        5 => '2200',
                                        6 => '3500',
                                        7 => '4400',
                                        8 => '5500',
                                        9 => '6600',
                                        10 => '7600',
                                        11 => '7700',
                                        12 => '8000',
                                        13 => '9500',
                                        14 => '10000',
                                        15 => '10600',
                                        16 => '11000',
                                        17 => '12700',
                                        18 => '13200',
                                        19 => '13300',
                                        20 => '13900',
                                    ];

                                    $hadapType = [
                                        1 => 'Barat',
                                        2 => 'Selatan',
                                        3 => 'Timur',
                                        4 => 'Utara',
                                    ];

                                    $posisiType = [
                                        1 => 'Standart',
                                        2 => 'Tusuk Sate',
                                        3 => 'Hook',
                                        4 => 'Kuldesak',
                                    ];

                                @endphp

                                <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-700">
                                    @if ($property->transaksiID == 0 || $property->transaksiID == 1)
                                        <div class="flex justify-start ">
                                            <div class="w-1/2">Type:</div>
                                            <div class="w-1/2">
                                                <strong>{{ $listingType[$property->listingType] ?? 'Unknown' }}</strong>
                                            </div>
                                        </div>

                                        <div class="flex justify-start ">
                                            <div class="w-1/2">Surat:</div>
                                            <div class="w-1/2">
                                                <strong>{{ $sertiType[$property->sertifikatType] ?? 'Tidak tersedia surat' }}</strong>
                                            </div>
                                        </div>

                                        <div class="flex justify-start ">
                                            <div class="w-1/2">Kamar Tidur:</div>
                                            <div class="w-1/2"> <strong>{{ $property->ktUtama }} @if (!empty($property->ktLain))
                                                        + {{ $property->ktLain }}
                                                    @endif
                                                </strong>
                                            </div>
                                        </div>

                                        <div class="flex justify-start ">
                                            <div class="w-1/2">Kamar Mandi:</div>
                                            <div class="w-1/2"> <strong>{{ $property->kmUtama }} @if (!empty($property->kmLain))
                                                        + {{ $property->kmLain }}
                                                    @endif
                                                </strong></div>
                                        </div>

                                        <div class="flex justify-start ">
                                            <div class="w-1/2">Transaksi:</div>
                                            @if ($property->transaksiID == 1)
                                                <div class="w-1/2"> <strong>Dijual</strong></div>
                                            @elseif($property->transaksiID == 0)
                                                <div class="w-1/2"> <strong>Disewa</strong></div>
                                            @endif
                                        </div>

                                        <div class="flex justify-start ">
                                            <div class="w-1/2">Lantai:</div>
                                            <div class="w-1/2"> <strong>{{ $property->lantai }}</strong></div>
                                        </div>
                                        <div class="flex justify-start ">
                                            <div class="w-1/2">Luas Tanah:</div>
                                            <div class="w-1/2">
                                                @if (!empty($property->luasTanah))
                                                    <strong>{{ $property->luasTanah }} m<sup>2</sup></strong>
                                                @else
                                                    <strong>Tidak tersedia</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex justify-start ">
                                            <div class="w-1/2">Luas Bangunan:</div>
                                            <div class="w-1/2"> <strong>{{ $property->luasBangunan }}
                                                    m<sup>2</sup></strong>
                                            </div>
                                        </div>

                                        <div class="flex justify-start ">
                                            <div class="w-1/2">Carport:</div>
                                            <div class="w-1/2">
                                                @if (!empty($property->carport))
                                                    <strong>{{ $property->carport }}</strong>
                                                @else
                                                    <strong>Tidak tersedia</strong>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex justify-start ">
                                            <div class="w-1/2">Listrik:</div>
                                            <div class="w-1/2"> <strong>{{ $listrik[$property->listrikID] }}</strong>
                                            </div>
                                        </div>

                                        <div class="flex justify-start ">
                                            <div class="w-1/2">Hadap:</div>
                                            <div class="w-1/2">
                                                <strong>{{ $hadapType[$property->orientasiID] }}</strong>
                                            </div>
                                        </div>

                                        <div class="flex justify-start ">
                                            <div class="w-1/2">Posisi:</div>
                                            <div class="w-1/2">
                                                <strong>{{ $posisiType[$property->posisiID] }}</strong>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                {{-- End --}}

                                <hr class="my-4">

                                <h2 class="text-lg font-semibold mb-2">DESKRIPSI</h2>
                                <p class="text-gray-600 text-lg">
                                    {!! nl2br(e($property->deskripsi)) !!}
                                </p>
                                @if ($property->statusListing == 0)
                                    <br>
                                    <hr class="my-4">

                                    <h2 class="text-lg font-semibold mb-2">ALASAN TOLAK</h2>
                                    <p class="text-gray-600 text-lg">
                                        {!! nl2br(e($property->alasan)) !!}
                                    </p>
                                @endif
                            </div>

                        </div>

                        <div class="space-y-4">
                            <div class="bg-white p-6 rounded-lg shadow-lg  lg:block mx-auto">
                                <h2
                                    class="text-2xl font-bold text-black-500 mb-4 text-center md:text-left md:text-3xl">
                                    Rp.
                                    {{ number_format($property->hargaJual, 0, ',', '.') }}</h2>
                                <div
                                    class="inline-flex items-center mb-4 justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg   peer-checked:border-blue-600 peer-checked:text-blue-600 ">
                                    <div class="flex flex-col">
                                        <p class="text-xl text-gray-800 font-semibold">KPR</p>
                                        <p class="text-gray-500 text-xs dark:text-gray-400">
                                            Pilihan bank dan suku bunga
                                        </p>
                                    </div>

                                    <div class="flex flex-col leading-normal">
                                        <div class="">
                                            <a href="#kpr"
                                                class="bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-sm sm:text-sm text-white w-30 py-2 p-6 rounded block text-center">
                                                Ajukan KPR
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="inline-flex items-center justify-between mb-4 w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg">

                                    @if($property->user->image != null)
                                    <img class="w-10 h-10 rounded-full"
                                    src="{{ asset('assets/' . $property->user->image) }}" alt="">
                                    @endif

                                    {{-- Cek apakah 'Name' ada di dalam $agentPrimary --}}
                                    @if ($property->user)
                                        <?php $firstTwoNames = implode(' ', array_slice(explode(' ', ucwords($property->user->name)), 0, 2));?>
                                        <p class="text-black text-lg">
                                            <strong>{{ $firstTwoNames }}</strong>
                                        </p>
                                    @else
                                        <p class="text-black">Nama agen tidak tersedia</p>
                                    @endif


                                    <div class="flex flex-col leading-normal">
                                        <a href="https://wa.me/{{ '62' . $property->user->nowa }}?text={{ urlencode('Halo, saya tertarik dengan seputar properti di daerah Surabaya') }}"
                                            class="bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-sm text-white w-30 py-2 p-6 rounded"
                                            target="_blank">Hubungi</a>
                                    </div>

                                </div>
                                @if ($property->user == Auth::user())
                                    <a href="{{ route('updateSecondaryUser.view', [$property->listingID, auth()->user()->id]) }}"
                                        class="inline-flex items-center w-full p-3 bg-white border border-gray-200 rounded-lg bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white text-center justify-center cursor-pointer">
                                        Edit Properti
                                    </a>
                                @endif

                            </div>
                        </div>

                    </div>
                    <div class="p-6">
                        <div id="kpr">
                            <x-kpr value="{{ $property->hargaJual }}"></x-kpr>
                        </div>
                    </div>
                </div>



            </div>

            {{-- PRIMARY --}}
        @elseif ($property->isPrimary == 1)
            <?php
            $hadapType = [
                1 => 'Barat',
                2 => 'Selatan',
                3 => 'Timur',
                4 => 'Utara',
            ];
            ?>
            <div class="max-w-7xl mx-auto p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-16 md:mt-14">
                    @isset($property)
                        <!-- Main Image -->
                        @if ($property->image_second || $property->image_third)
                            <div class="lg:col-span-2 relative">
                                <a href="{{ url()->previous() != url()->current() ? url()->previous() : url('/') }}"
                                    class="absolute top-3 left-3 bg-white text-gray-800 px-3 py-1 rounded-full shadow-md hover:bg-gray-200 z-10 transition duration-300">
                                    ← Kembali
                                </a>
                                <div class="w-full h-[400px] overflow-hidden rounded-lg">
                                    <img class="w-full h-full object-cover rounded-lg shadow-xl transition-all duration-500 ease-in-out"
                                        src="{{ $property->image_main ? asset('assets/' . $property->image_main) : asset('images/default-placeholder.png') }}"
                                        alt="Property" onload="this.classList.remove('opacity-50', 'grayscale')"
                                        loading="lazy" fetchpriority="high" />
                                </div>
                            </div>
                        @else
                            <div class="lg:col-span-3 relative">
                                <a href="{{ url()->previous() != url()->current() ? url()->previous() : url('/') }}"
                                    class="absolute top-3 left-3 bg-white text-gray-800 px-3 py-1 rounded-full shadow-md hover:bg-gray-200 z-10 transition duration-300">
                                    ← Kembali
                                </a>
                                <div class="w-full h-[400px] overflow-hidden rounded-lg">
                                    <img class="w-full h-full object-cover rounded-lg shadow-xl transition-all duration-500 ease-in-out"
                                        src="{{ $property->image_main ? asset('assets/' . $property->image_main) : asset('images/default-placeholder.png') }}"
                                        alt="Property" onload="this.classList.remove('opacity-50', 'grayscale')"
                                        loading="lazy" fetchpriority="high" />
                                </div>
                            </div>
                        @endif
                        <!-- Side Images -->
                        @if ($property->image_second || $property->image_third)
                            <div class="lg:col-span-1 space-y-6">
                                @if ($property->image_second)
                                    <div class="relative group overflow-hidden rounded-lg">
                                        <img class="w-full h-[190px] object-cover "
                                            src="{{ asset('assets/' . $property->image_second) }}" alt="Gambar Kecil 1"
                                            loading="lazy" fetchpriority="high" />
                                    </div>
                                @endif

                                @if ($property->image_third)
                                    <div class="relative group overflow-hidden rounded-lg">
                                        <img class="w-full h-[190px] object-cover "
                                            src="{{ asset('assets/' . $property->image_third) }}" alt="Gambar Kecil 2"
                                            loading="lazy" fetchpriority="high" />
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endisset
                </div>
            </div>
            {{-- DETAIL PROPERTY --}}
            <div class="max-w-7xl mx-auto ">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">
                    <!-- Bagian Bawah: Deskripsi, Rating, Harga, Tombol -->
                    <div class="lg:col-span-2 space-y-4">
                        <div class="bg-white p-6 rounded-lg shadow-xl w-full">
                            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                                <div class="lg:col-span-2 space-y-2">
                                    <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-4">
                                        {{ $property->title }}
                                    </h1>
                                </div>
                                <div class="flex space-x-4">
                                    @if ($property->statusListing == 0 || $property->statusListing == 2)
                                        <p class="inline-block text-white w-30 border bg-gradient-to-r from-red-400 to-red-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-3 text-center">
                                            {{ $property->statusListing == 1 ? 'Terverifikasi' : ($property->statusListing == 2 ? 'Menunggu Verifikasi' : 'Tidak Valid') }}
                                        </p>
                                    @endif
                                    <p class="inline-block text-orange-600 w-30 border border-orange-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-3 text-center">
                                        {{ $property->isPrimary ? 'Primary' : 'Secondary' }}
                                    </p>
                                    <p class="inline-block text-orange-600 w-30 border border-orange-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-3 text-center">
                                        BARU
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center text-gray-700 text-base mt-4">
                                <svg class="w-6 h-6 text-gray-500 mr-1" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12 2C8.1 2 5 5.1 5 9c0 4.9 7 13 7 13s7-8.1 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5s2.5 1.1 2.5 2.5S13.4 11.5 12 11.5z" />
                                </svg>
                                <div x-data=",
                                }" x-init="console.log(lokasiNames[lokasiID])">
                                    <div>
                                        Kota Surabaya {{ $hadapType[$property->orientasiID] }}
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">

                            {{-- Start of Detail Property --}}

                            {{-- End --}}

                            <hr class="my-4">

                            <h2 class="text-lg font-semibold mb-2">DESKRIPSI</h2>
                            <p class="text-gray-600 text-lg">
                                {!! nl2br(e($property->deskripsi)) !!}
                            </p>
                            @if ($property->statusListing == 0)
                                <br>
                                <hr class="my-4">

                                <h2 class="text-lg font-semibold mb-2">ALASAN TOLAK</h2>
                                <p class="text-gray-600 text-lg">
                                    {!! nl2br(e($property->alasan ?? '-')) !!}
                                </p>
                            @endif

                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-white p-6 rounded-lg shadow-lg  lg:block mx-auto">
                            <h2 class="text-2xl font-bold text-black-500 mb-4 text-center md:text-left md:text-3xl">
                                @if ($property->hargaJualMax != 0 || $property->hargaJualMax != null)
                                    Rp.{{ number_format($property->hargaJual, 0, ',', '.') }} - Rp.{{ number_format($property->hargaJualMax, 0, ',', '.') }}
                                @else
                                    Rp.{{ number_format($property->hargaJual, 0, ',', '.') }}
                                @endif
                                </h2>
                            <div
                                class="inline-flex items-center mb-4 justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg   peer-checked:border-blue-600 peer-checked:text-blue-600 ">
                                <div class="flex flex-col">
                                    <p class="text-xl text-gray-800 font-semibold">KPR</p>
                                    <p class="text-gray-500 text-xs dark:text-gray-400">
                                        Pilihan bank dan suku bunga
                                    </p>
                                </div>

                                <div class="flex flex-col leading-normal">
                                    <div class="">
                                        <a href="#kpr"
                                            class="bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-sm sm:text-sm text-white w-30 py-2 p-6 rounded block text-center">
                                            Ajukan KPR
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg mb-4">

                                @if($property->user->image != null)
                                    <img class="w-10 h-10 rounded-full"
                                    src="{{ asset('assets/' . $property->user->image) }}" alt="">
                                @endif

                                {{-- Cek apakah 'Name' ada di dalam $agentPrimary --}}
                                @if ($property->user)
                                    <?php $firstTwoNames = implode(' ', array_slice(explode(' ', ucwords($property->user->name)), 0, 2));?>
                                    <p class="text-black text-lg">
                                        <strong>{{ $firstTwoNames}}</strong>
                                    </p>
                                @else
                                    <p class="text-black">Nama agen tidak tersedia</p>
                                @endif


                                <div class="flex flex-col leading-normal">
                                    <a href="https://wa.me/{{ '62' . $property->user->nowa }}?text={{ urlencode('Halo, saya tertarik dengan seputar properti di daerah Surabaya') }}"
                                        class="bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-sm text-white w-30 py-2 p-6 rounded"
                                        target="_blank">Hubungi</a>
                                </div>

                            </div>
                            @if ($property->user == Auth::user())
                            <a href="{{ route('updatePrimaryUser.view', [$property->listingID, auth()->user()->id]) }}"
                                class="inline-flex items-center w-full p-3 bg-white border border-gray-200 rounded-lg bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white text-center justify-center cursor-pointer">
                                Edit Properti
                            </a>
                        @endif

                        </div>
                    </div>
                </div>

            </div>
        </div>

    @endif


    @section('scripts')
        @vite(['resources/js/property-detail.js', 'resources/js/kpr-simulation.js']);
    @endsection
</x-layout>

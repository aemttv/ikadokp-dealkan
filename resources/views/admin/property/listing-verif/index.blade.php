{{-- Primary Verifikasi --}}
<x-admin-layout>
    {{-- Title --}}
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold">Verifikasi Properti Utama Anda dengan Standar Tertinggi</h1>
            <p class="text-gray-600">Validasi properti dengan proses terpercaya, memastikan kualitas di setiap langkah.</p>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <x-ui.alert type="success" :message="session('success')" />
    @elseif (session('error'))
        <x-ui.alert type="error" :message="session('error')" />
    @endif

    <?php
    $hadapType = [
        null => "Unknown",
        0 => "Unknown",
        1 => 'Barat',
        2 => 'Selatan',
        3 => 'Timur',
        4 => 'Utara',
    ];

    $location = [
        null => "Unknown",
        0 => "Unknown",
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
    ?>

    {{-- PRIMARY SECTION --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm text-center">
            {{-- Column --}}
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">ID</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Nama Agen</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Judul</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Orientasi</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Harga Mulai</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Harga Maksimum</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Gambar</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Interaksi</th>
                </tr>
            </thead>
            {{-- Row --}}
            <tbody class="divide-y divide-gray-200">
                @if ($primaryVerif->isEmpty())
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900" colspan="10">Tidak Ada Data
                        </td>
                    </tr>
                @endif
                @foreach ($primaryVerif as $data)
                    <tr class="odd:bg-gray-100 rounded-lg">
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">{{ $data->listingID }}</td>
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">{{ mb_strimwidth($data->name, 0, 15, '...') }}</td>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">{{ mb_strimwidth($data->title, 0, 40, '...') }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 ">
                            {{ $hadapType[$data->orientasiID] ?? 'Unknown' }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 ">Rp. {{ format_price($data->hargaJual) }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 ">Rp.
                            {{ format_price($data->hargaJualMax) }}</td>

                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                            <a href="javascript:void(0)"
                                class="inline-block rounded bg-yellow-500 px-4 py-2 text-xs font-medium text-white hover:bg-yellow-600"
                                onclick="openModalPrimary({{ $data->listingID }})">
                                Lihat Gambar
                            </a>
                        </td>

                        <!-- Modal -->
                        <div id="imageModalPrimary-{{ $data->listingID }}" tabindex="1"
                            class="flex fixed inset-0 z-50 hidden items-center justify-center text-center bg-black bg-opacity-50">
                            <div class="relative w-full max-w-6xl">
                                <div class="bg-white rounded-lg shadow-md">
                                    <!-- Modal Header -->
                                    <div class="flex justify-between items-center p-4 border-b">
                                        <h3 class="text-lg font-medium text-gray-900">Gallery</h3>
                                        <button type="button" onclick="closeModalPrimary({{ $data->listingID }})"
                                            class="text-gray-400 hover:text-gray-900">
                                            &times;
                                        </button>
                                    </div>

                                    {{-- Carousel --}}
                                    <div id="animation-carousel" class="relative w-full" data-carousel="static">
                                        <!-- Carousel wrapper -->
                                        <div class="relative h-56 overflow-hidden md:h-[650px]">
                                            @if ($data->image_main && $data->image_second && $data->image_third)
                                                <!-- Show all three images -->
                                                <!-- Item 1 -->
                                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                                    <img src="{{ asset('assets/' . $data->image_main) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                                <!-- Item 2 -->
                                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                                    <img src="{{ asset('assets/' . $data->image_second) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                                <!-- Item 3 -->
                                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                                    <img src="{{ asset('assets/' . $data->image_third) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                            @elseif($data->image_main && $data->image_second)
                                                <!-- Show main and second -->
                                                <!-- Item 1 -->
                                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                                    <img src="{{ asset('assets/' . $data->image_main) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                                <!-- Item 2 -->
                                                <div class="hidden duration-200 ease-linear"
                                                    data-carousel-item="active">
                                                    <img src="{{ asset('assets/' . $data->image_second) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                            @elseif($data->image_main && $data->image_third)
                                                <!-- Show main and third -->
                                                <!-- Item 1 -->
                                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                                    <img src="{{ asset('assets/' . $data->image_main) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                                <!-- Item 2 -->
                                                <div class="hidden duration-200 ease-linear"
                                                    data-carousel-item="active">
                                                    <img src="{{ asset('assets/' . $data->image_third) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                            @elseif($data->image_main)
                                                <!-- Show only main image -->
                                                <!-- Item 1 -->
                                                <div class="hidden duration-200 ease-linear"
                                                    data-carousel-item="active">
                                                    <img src="{{ asset('assets/' . $data->image_main) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Slider controls -->
                                        <button type="button"
                                            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                            data-carousel-prev>
                                            <span
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
                                                <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                                                </svg>
                                                <span class="sr-only">Previous</span>
                                            </span>
                                        </button>
                                        <button type="button"
                                            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                            data-carousel-next>
                                            <span
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
                                                <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                                </svg>
                                                <span class="sr-only">Next</span>
                                            </span>
                                        </button>
                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="flex justify-end p-4 border-t">
                                        <button type="button" onclick="closeModalPrimary({{ $data->listingID }})"
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action -->
                        <td class="whitespace-nowrap px-2 py-2 flex space-x-2 justify-center items-center">
                            <!-- Button SETUJU -->
                            <form action="{{ route('acceptPrimary', $data->listingID) }}" method="POST"
                                class="inline" onsubmit="return confirm('Are you sure this property is VALID ?');">
                                @csrf
                                {{-- @method('DELETE') --}}
                                <button type="submit"
                                    class="inline-block rounded bg-green-500 px-4 py-2 text-xs font-medium text-white hover:bg-green-600">
                                    SETUJU
                                </button>
                            </form>
                            <!-- Button Delete -->
                            <button onclick="openModalRejectPrimary({{ $data->listingID }})"
                                class="inline-block rounded bg-red-500 px-4 py-2 text-xs font-medium text-white hover:bg-red-600">
                                TOLAK
                            </button>

                        </td>
                    </tr>
                    <!-- Modal -->
                    <div id="rejectModalPrimary-{{ $data->listingID }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white w-96 rounded-lg shadow-lg p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">Isi Alasan Penolakan</h2>
                            <form id="rejectForm" action="{{ route('rejectPrimary', $data->listingID) }}" method="POST">
                                @csrf
                                <p> Alasan Penolakan Listing No. {{ $data->listingID }}</p>
                                <textarea
                                id="alasan"
                                name="alasan"
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-red-300 max-h-60 min-h-20"
                                placeholder="Masukkan alasan penolakan"
                                required autocomplete="off"
                                ></textarea>
                                <div class="flex justify-end mt-4">
                                <button
                                    type="button"
                                    class="bg-gray-300 text-gray-700 py-2 px-4 rounded-lg mr-2 hover:bg-gray-400"
                                    onclick="closeModalRejectPrimary({{ $data->listingID }})"
                                >
                                    Batal
                                </button>
                                <button
                                    type="submit"
                                    class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600" onsubmit="return confirm('Apakah anda yakin mau menolak listing properti ini ?');"
                                >
                                    Kirim
                                </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination Links --}}
        <div class="flex mt-4 justify-center ">
            {{ $primaryVerif->links() }}
        </div>
    </div>

    <hr class="my-4 border-gray-300">

    {{-- SECONDARY SECTION --}}
    {{-- Title --}}
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold">Daftar Properti Sekunder untuk Proses Verifikasi Akurat</h1>
            <p class="text-gray-600">Pastikan properti sekunder Anda memenuhi standar kualitas terbaik.</p>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm text-center">
            {{-- Column --}}
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">ID</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Nama Agen</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Judul</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Alamat</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Transaksi</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Lokasi - Orientasi</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Harga</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Total (K.Tidur / K.Mandi)</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">L.Bangunan / L.Lahan</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Gambar</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Interaksi</th>
                </tr>
            </thead>

            {{-- Row --}}
            <tbody class="divide-y divide-gray-200">
                @if ($secondaryVerif->isEmpty())
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900" colspan="12">Tidak Ada
                            Data
                        </td>
                    </tr>
                @endif
                @foreach ($secondaryVerif as $data)
                    <tr class="odd:bg-gray-100 rounded-lg">
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">{{ $data->listingID }}</td>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">{{ mb_strimwidth($data->name, 0, 15, '...') }}</td>
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">{{ mb_strimwidth($data->title, 0, 40, '...') }}</td>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">{{ mb_strimwidth($data->alamat, 0, 40, '...') }}</td>
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">
                            {{ $data->transaksiID == 1 ? 'Jual' : 'Sewa' }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-left">
                            {{ $location[$data->lokasiID] }} -
                            {{ $hadapType[$data->orientasiID] }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-left">Rp.
                            {{ format_price($data->hargaJual) }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 ">
                            {{ $data->ktUtama + $data->kmLain }} / {{ $data->kmUtama + $data->kmLain }}</td>

                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                            {{ $data->luasBangunan }} m<sup>2</sup> / {{ $data->luasTanah }} m<sup>2</sup>
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                            <a href="javascript:void(0)"
                                class="inline-block rounded bg-yellow-500 px-4 py-2 text-xs font-medium text-white hover:bg-yellow-600"
                                onclick="openModalSecondary({{ $data->listingID }})">
                                Lihat Gambar
                            </a>
                        </td>

                        <!-- Modal -->
                        <div id="imageModalSecondary-{{ $data->listingID }}" tabindex="1"
                            class="flex fixed inset-0 z-50 hidden items-center justify-center text-center bg-black bg-opacity-50">
                            <div class="relative w-full max-w-6xl">
                                <div class="bg-white rounded-lg shadow-md">
                                    <!-- Modal Header -->
                                    <div class="flex justify-between items-center p-4 border-b">
                                        <h3 class="text-lg font-medium text-gray-900">Gallery</h3>
                                        <button type="button" onclick="closeModalSecondary({{ $data->listingID }})"
                                            class="text-gray-400 hover:text-gray-900">
                                            &times;
                                        </button>
                                    </div>

                                    {{-- Carousel --}}
                                    <div id="animation-carousel" class="relative w-full" data-carousel="static">
                                        <!-- Carousel wrapper -->
                                        <div class="relative h-56 overflow-hidden md:h-[650px]">
                                            @if ($data->image_main && $data->image_second && $data->image_third)
                                                <!-- Show all three images -->
                                                <!-- Item 1 -->
                                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                                    <img src="{{ asset('assets/' . $data->image_main) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                                <!-- Item 2 -->
                                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                                    <img src="{{ asset('assets/' . $data->image_second) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                                <!-- Item 3 -->
                                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                                    <img src="{{ asset('assets/' . $data->image_third) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                            @elseif($data->image_main && $data->image_second)
                                                <!-- Show main and second -->
                                                <!-- Item 1 -->
                                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                                    <img src="{{ asset('assets/' . $data->image_main) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                                <!-- Item 2 -->
                                                <div class="hidden duration-200 ease-linear"
                                                    data-carousel-item="active">
                                                    <img src="{{ asset('assets/' . $data->image_second) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                            @elseif($data->image_main && $data->image_third)
                                                <!-- Show main and third -->
                                                <!-- Item 1 -->
                                                <div class="hidden duration-200 ease-linear" data-carousel-item>
                                                    <img src="{{ asset('assets/' . $data->image_main) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                                <!-- Item 2 -->
                                                <div class="hidden duration-200 ease-linear"
                                                    data-carousel-item="active">
                                                    <img src="{{ asset('assets/' . $data->image_third) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                            @elseif($data->image_main)
                                                <!-- Show only main image -->
                                                <!-- Item 1 -->
                                                <div class="hidden duration-200 ease-linear"
                                                    data-carousel-item="active">
                                                    <img src="{{ asset('assets/' . $data->image_main) }}"
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        alt="...">
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Slider controls -->
                                        <button type="button"
                                            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                            data-carousel-prev>
                                            <span
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
                                                <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                                                </svg>
                                                <span class="sr-only">Previous</span>
                                            </span>
                                        </button>
                                        <button type="button"
                                            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                            data-carousel-next>
                                            <span
                                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
                                                <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                                </svg>
                                                <span class="sr-only">Next</span>
                                            </span>
                                        </button>
                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="flex justify-end p-4 border-t">
                                        <button type="button" onclick="closeModalSecondary({{ $data->listingID }})"
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <td class="whitespace-nowrap px-2 py-2 flex space-x-2 justify-center items-center">
                            <!-- Button SETUJU -->
                            <form action="{{ route('acceptSecondary', $data->listingID) }}" method="POST"
                                class="inline" onsubmit="return confirm('Are you sure this property is VALID ?');">
                                @csrf
                                {{-- @method('DELETE') --}}
                                <button type="submit"
                                    class="inline-block rounded bg-green-500 px-4 py-2 text-xs font-medium text-white hover:bg-green-600">
                                    SETUJU
                                </button>
                            </form>
                            <!-- Button Delete -->

                            {{-- @method('DELETE') --}}
                            <button onclick="openModalReject({{ $data->listingID }})"
                                class="inline-block rounded bg-red-500 px-4 py-2 text-xs font-medium text-white hover:bg-red-600">
                                TOLAK
                            </button>

                        </td>
                    </tr>
                    <!-- Modal -->
                    <div id="rejectModal-{{ $data->listingID }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white w-96 rounded-lg shadow-lg p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">Isi Alasan Penolakan</h2>
                            <form id="rejectForm" action="{{ route('rejectProperty', $data->listingID) }}" method="POST">
                                @csrf
                                <p> Alasan Penolakan Listing No. {{ $data->listingID }}</p>
                                <textarea
                                id="alasan"
                                name="alasan"
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-red-300 max-h-60 min-h-20"
                                placeholder="Masukkan alasan penolakan"
                                required autocomplete="off"
                                ></textarea>
                                <div class="flex justify-end mt-4">
                                <button
                                    type="button"
                                    class="bg-gray-300 text-gray-700 py-2 px-4 rounded-lg mr-2 hover:bg-gray-400"
                                    onclick="closeModalReject({{ $data->listingID }})"
                                >
                                    Batal
                                </button>
                                <button
                                    type="submit"
                                    class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600" onsubmit="return confirm('Apakah anda yakin mau menolak listing properti ini ?');"
                                >
                                    Kirim
                                </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
                            </tbody>
                        </table>
                        {{-- Pagination Links --}}
                        <div class="flex mt-4 justify-center ">
                            {{ $secondaryVerif->links() }}
                        </div>
                    </div>




    <script>
        //IMAGE PRIMARY
        function openModalPrimary(listingID) {
            // Dynamically get the modal for the specific listing
            const modal = document.getElementById(`imageModalPrimary-${listingID}`);
            if (modal) {
                modal.classList.remove('hidden');
            } else {
                console.error(`Modal for listingID ${listingID} not found.`);
            }
        }
        function closeModalPrimary(listingID) {
            const modal = document.getElementById(`imageModalPrimary-${listingID}`);
            if (modal) {
                modal.classList.add('hidden');
            } else {
                console.error(`Modal for listingID ${listingID} not found.`);
            }
        }
        //IMAGE SECONDARY
        function openModalSecondary(listingID) {
            // Dynamically get the modal for the specific listing
            const modal = document.getElementById(`imageModalSecondary-${listingID}`);
            if (modal) {
                modal.classList.remove('hidden');
            } else {
                console.error(`Modal for listingID ${listingID} not found.`);
            }
        }
        function closeModalSecondary(listingID) {
            const modal = document.getElementById(`imageModalSecondary-${listingID}`);
            if (modal) {
                modal.classList.add('hidden');
            } else {
                console.error(`Modal for listingID ${listingID} not found.`);
            }
        }

        //REJECT Primary
        function openModalRejectPrimary(listingID) {
            const modal = document.getElementById(`rejectModalPrimary-${listingID}`);
            if(modal) {
                modal.classList.remove('hidden');
            }
            else {
                console.error(`Modal for listingID ${listingID} not found.`);
            }
        }
        function closeModalRejectPrimary(listingID) {
            const modal = document.getElementById(`rejectModalPrimary-${listingID}`);
            if(modal) {
                modal.classList.add('hidden');
            }
            else {
                console.error(`Modal for listingID ${listingID} not found.`);
            }
        }
        //REJECT SECONDARY
        function openModalReject(listingID) {
            const modal = document.getElementById(`rejectModal-${listingID}`);
            if(modal) {
                modal.classList.remove('hidden');
            }
            else {
                console.error(`Modal for listingID ${listingID} not found.`);
            }
        }
        function closeModalReject(listingID) {
            const modal = document.getElementById(`rejectModal-${listingID}`);
            if(modal) {
                modal.classList.add('hidden');
            }
            else {
                console.error(`Modal for listingID ${listingID} not found.`);
            }
        }


    </script>
</x-admin-layout>

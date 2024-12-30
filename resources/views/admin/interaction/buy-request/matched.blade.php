{{-- Buy Request --}}
<x-admin-layout>
    <?php
    $hadapType = [
        null => 'Unknown',
        0 => 'Unknown',
        1 => 'Barat',
        2 => 'Selatan',
        3 => 'Timur',
        4 => 'Utara',
    ];

    $location = [
        null => 'Unknown',
        0 => 'Unknown',
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
    ?>
    {{-- Title --}}
    <div class="p-6min-h-screen">

        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Kumpulan Properti Sesuai Kriteria No. {{$buyRequest->requestID}}</h2>

                <p class="mt-4 text-gray-500 sm:text-xl">
                    Temukan pilihan properti terbaik yang sesuai kebutuhan Anda dengan mudah dan cepat hari ini.
                </p>
            </div>

            <dl
                class="mg-6 grid grid-cols-1 gap-4 divide-y divide-gray-100 sm:mt-8 sm:grid-cols-2 sm:divide-x sm:divide-y-0 lg:grid-cols-4">
                <div class="flex flex-col px-4 py-8 text-center">
                    <dt class="order-last text-lg font-medium text-gray-500">Harga Tertinggi</dt>

                    <dd class="text-4xl font-extrabold text-orange-600 md:text-2xl">
                        @if (isset($buyRequest->hargaJualMax))
                        Rp. {{ format_price($buyRequest->hargaJualMax) }}
                    @else
                        0
                    @endif</dd>
                </div>

                <div class="flex flex-col px-4 py-8 text-center">
                    <dt class="order-last text-lg font-medium text-gray-500">Transaksi - Daftar</dt>

                    <dd class="text-4xl font-extrabold text-orange-600 md:text-2xl">
                    @if ($buyRequest->transaksiID == 1)
                        Dijual
                    @elseif ($buyRequest->transaksiID == 0)
                        Disewa
                    @else
                        Unknown
                    @endif - {{$listingType[$buyRequest->listingType] ?? 'Unknown'}}</dd>
                </div>

                <div class="flex flex-col px-4 py-8 text-center">
                    <dt class="order-last text-lg font-medium text-gray-500">Lokasi </dt>

                    <dd class="text-4xl font-extrabold text-orange-600 md:text-2xl">{{ $location[$buyRequest->lokasiID] ?? 'Unknown' }}</dd>
                </div>

                <div class="flex flex-col px-4 py-8 text-center">
                    <dt class="order-last text-lg font-medium text-gray-500">Luas Lahan(Max) / Luas Bangunan(Max)</dt>

                    <dd class="text-4xl font-extrabold text-orange-600 md:text-2xl">
                        @if (isset($buyRequest->luasTanahMax) && isset($buyRequest->luasBangunanMax))
                        {{ $buyRequest->luasTanahMax }} m<sup>2</sup> / {{ $buyRequest->luasBangunanMax }}
                        m<sup>2</sup>
                    @else
                        0 m<sup>2</sup>
                    @endif</dd>
                </div>
            </dl>
        </div>
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
        null => 'Unknown',
        0 => 'Unknown',
        1 => 'Barat',
        2 => 'Selatan',
        3 => 'Timur',
        4 => 'Utara',
    ];

    $location = [
        null => 'Unknown',
        0 => 'Unknown',
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
    ?>

    {{-- VIEW MATCHED SECTION --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm text-center mt-4">
            {{-- Column --}}
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">ID</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Judul</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Lokasi</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Properti</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Transaksi</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Harga</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Total (K.Tidur / K.Mandi)</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">L.Bangunan / L.Lahan</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Gambar</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Interaksi</th>
                </tr>
            </thead>
            {{-- Row --}}
            <tbody class="divide-y divide-gray-200">
                @if ($matchedRequests->isEmpty())
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900" colspan="10">Tidak Ada Data
                        </td>
                    </tr>
                @endif
                @foreach ($matchedRequests as $data)
                    <tr class="odd:bg-gray-100 rounded-lg">
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">{{ $data->listingID }}</td>
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">
                            {{ mb_strimwidth($data->title, 0, 40, '...') }}</td>
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">
                            {{ $location[$data->lokasiID] ?? 'Unknown' }}</td>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">
                            {{ $listingType[$data->listingType] ?? 'Unknown' }}</td>
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">
                            @if ($data->transaksiID == 1)
                                Dijual
                            @elseif ($data->transaksiID == 0)
                                Disewa
                            @else
                                Unknown
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">
                            @if (isset($data->hargaJualMin))
                                Rp.{{ format_price($data->hargaJual) }}
                            @else
                                0
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">
                            {{ $data->ktUtama + $data->kmLain ?? 'Unknown' }} /
                            {{ $data->kmUtama + $data->kmLain ?? 'Unknown' }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">
                            {{ $data->luasBangunan ?? 'Unknown' }} m<sup>2</sup> / {{ $data->luasTanah ?? 'Unknown' }}
                            m<sup>2</sup>
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                            <div class="flex items-center justify-center">
                                @if ($data->image_main > 0)
                                    <a onclick="openModalPrimary({{ $data->listingID }})"
                                        class="inline-block rounded bg-yellow-500 px-4 py-2 text-xs font-medium text-white hover:bg-yellow-600 cursor-pointer">
                                        Lihat Detail
                                    </a>
                                @else
                                    <span class="inline-block rounded px-4 py-2 text-xs font-medium text-red-500">
                                        Gambar Tidak Tersedia
                                    </span>
                                @endif
                            </div>
                        </td>

                        <!-- Modal -->
                        <div id="imageModal" tabindex="1"
                            class="flex fixed inset-0 z-50 hidden items-center justify-center text-center bg-black bg-opacity-50">
                            <div class="relative w-full max-w-6xl">
                                <div class="bg-white rounded-lg shadow-md">
                                    <!-- Modal Header -->
                                    <div class="flex justify-between items-center p-4 border-b">
                                        <h3 class="text-lg font-medium text-gray-900">Gallery</h3>
                                        <button type="button" onclick="closeModalPrimary()"
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
                                                <div class="hidden duration-200 ease-linear"
                                                    data-carousel-item="active">
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
                                        <button type="button" onclick="closeModalPrimary()"
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action -->
                        <td class="whitespace-nowrap px-2 py-2 flex space-x-2 justify-center items-center">
                            <!-- Button Delete -->
                            <a href="https://wa.me/{{ '62' . Auth::user()->nowa }}?text={{ urlencode('Halo, saya tertarik dengan seputar properti di daerah Surabaya') }}"
                                class="inline-block rounded bg-green-500 px-4 py-2 text-xs font-medium text-white hover:bg-green-600">
                                Kontak Agen
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination Links --}}
        <div class="flex mt-4 justify-center ">
            {{ $matchedRequests->links() }}
        </div>
    </div>


    <script>
        function openModalPrimary() {
            document.getElementById('imageModal').classList.remove('hidden');
            showSlide(currentIndex); // Reset to the current image
        }

        function closeModalPrimary() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        function openModal(listingID) {
            // Dynamically get the modal for the specific listing
            const modal = document.getElementById(`imageModal-${listingID}`);
            if (modal) {
                modal.classList.remove('hidden');
            } else {
                console.error(`Modal for listingID ${listingID} not found.`);
            }
        }

        function closeModal(listingID) {
            const modal = document.getElementById(`imageModal-${listingID}`);
            if (modal) {
                modal.classList.add('hidden');
            } else {
                console.error(`Modal for listingID ${listingID} not found.`);
            }
        }
    </script>
</x-admin-layout>

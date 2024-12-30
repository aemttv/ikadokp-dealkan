<x-admin-layout title="Primary Property">
    {{-- Title --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Properti Utama Dealkan, Langkah Menuju Sukses</h1>
            <p class="text-gray-600">Pastikan properti utama Anda menjadi pilihan unggul di pasar!</p>
        </div>
    </div>

    {{-- Search Form --}}
    <div class="w-full flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
        <form method="GET" action="{{route('propertyPrimary.search')}}" class="">
            <div class="flex">
                <input type="text" name="Pencarian" value=""
                    class="form-input w-full px-4 py-2 border rounded-l-md"
                    placeholder="Cari Properti">
                <button type="submit"
                    class="bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-r-md hover:to-blue-500">
                    Cari
                </button>
            </div>
        </form>

        <a href="{{route('addProperty.view')}}"
            class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-4 py-2.5 rounded hover:to-orange-500 text-center">
            Tambah Properti
        </a>
    </div>
    <div class="hidden sm:block">
        @if (!$primary == [])
        <nav class="text-gray-600 justify-center items-end text-right">
            <a href="/dashboard" class="hover:text-gray-800">Home</a>
            <span> &gt; </span>
            <a href="/property-primary" class="hover:text-gray-800">Properti</a>
            <span> &gt; </span>
            <a href="/property-primary" class="hover:text-gray-800">Daftar Utama</a>
        </nav>
            <p class="text-gray-600 justify-center items-end text-right">
                Menampilkan {{ $primary->firstItem() }}-{{ $primary->lastItem() }} dari total
                {{ $primary->total() }} properti
            </p>

        @endif
    </div>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <x-ui.alert type="success" :message="session('success')" />
    @elseif ($errors->any())
        @foreach ($errors->all() as $error)
            <x-ui.alert type="error" :message="$error" />
        @endforeach
    @endif
    {{-- Naming --}}
    <?php
    $hadapType = [
        0 => 'Unknown',
        null => 'Unknown',
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


    <div class="overflow-x-auto">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm text-center mt-2">
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">ID</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Nama Agen</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Judul</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Orientasi</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Kisaran Harga</th>
                    {{-- <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Link</th> --}}
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Gambar</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Interaksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @if ($primary->isEmpty())
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900" colspan="8">Tidak Ada Data
                        </td>
                    </tr>
                @endif
                @foreach ($primary as $data)
                    <tr class="odd:bg-gray-100">
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">{{ $data->listingID }}</td>
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">{{ mb_strimwidth($data->name, 0, 15, '...') }}</td>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 text-left">{{ mb_strimwidth($data->title, 0, 40, '...') }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 ">{{ $hadapType[$data->orientasiID] }}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">
                            @if($data->hargaJualMax == null)
                                Rp. {{ format_price($data->hargaJual) }}
                            @else
                                Rp. {{ format_price($data->hargaJual) }} - Rp. {{ format_price($data->hargaJualMax) }}
                            @endif
                        </td>
                            </td>

                        {{-- <td class="whitespace-nowrap px-4 py-2 text-blue-600 ">
                            @if ($data->link_drive)
                                <a href="{{ $data->link_drive ?? '#' }}" class="hover:underline">Link Tersedia</a>
                            @else
                                Tidak Ada Link
                            @endif
                        </td> --}}
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                            <a href="javascript:void(0)"
                                class="inline-block rounded bg-yellow-500 px-4 py-2 text-xs font-medium text-white hover:bg-yellow-600"
                                onclick="openModal({{ $data->listingID }})">
                                Lihat Gambar
                            </a>
                        </td>

                        <!-- Modal -->
                        <div id="imageModal-{{ $data->listingID }}" tabindex="1"
                            class="flex fixed inset-0 z-50 hidden items-center justify-center text-center bg-black bg-opacity-50">
                            <div class="relative w-full max-w-6xl">
                                <div class="bg-white rounded-lg shadow-md">
                                    <!-- Modal Header -->
                                    <div class="flex justify-between items-center p-4 border-b">
                                        <h3 class="text-lg font-medium text-gray-900">Gallery</h3>
                                        <button type="button" onclick="closeModal({{ $data->listingID }})"
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
                                        <button type="button" onclick="closeModal({{ $data->listingID }})"
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <td class="whitespace-nowrap px-4 py-2 flex space-x-2 justify-center items-center">
                            <!-- Button Edit -->
                            <a href="{{route('updateProperty.view', $data->listingID)}}"
                                class="inline-block rounded bg-blue-500 px-4 py-2 text-xs font-medium text-white hover:bg-blue-600">
                                Ubah
                            </a>

                            <!-- Button Delete -->
                            <form action="{{ route('deleteListPrimary', $data->listingID) }}" method="POST"
                                class="inline"
                                onsubmit="return confirm('Are you sure you want to delete this primary property? This action cannot be undone.');">
                                @csrf
                                {{-- @method('DELETE') --}}
                                <button type="submit"
                                    class="inline-block rounded bg-red-500 px-4 py-2 text-xs font-medium text-white hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination Links --}}
    <div class="flex mt-4 justify-center ">
        {{ $primary->links() }}
    </div>

    <script>
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

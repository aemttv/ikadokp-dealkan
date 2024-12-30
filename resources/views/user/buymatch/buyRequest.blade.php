<x-layout title="Buy Request">
    <x-section>

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

        <div class="flex justify-between items-center mb-16">
            {{-- <h1 class="text-2xl font-bold">List Buy Request</h1> --}}
        </div>
        <div class="flex justify-between items-center mb-4">
            {{-- <h1 class="text-2xl font-bold">List Buy Request</h1> --}}
        </div>

        {{-- BUY REQUEST SECTION --}}
        <div class="overflow-x-auto overflow-y-auto mb-10 rounded-2xl">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm text-center rounded-2xl">
                {{-- Column --}}
                <thead class="ltr:text-left rtl:text-right">
                    <tr class="bg-gray-200 text-center justify-center items-center">
                        <th class="p-3 rounded-tl-2xl text-3xl border-gray-300" colspan="12">
                            <h1>Buy Request</h1>
                        </th>
                        <th class="p-3 rounded-tr-2xl border-gray-300 text-right">
                            <a href="{{ route('addRequest.view', Auth::user()->id) }}"
                                class="whitespace-nowrap bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 text-white font-bold py-2 px-4 rounded">
                                New Request
                            </a>
                        </th>
                    </tr>
                    <tr class="bg-gray-200 text-center justify-center items-center">
                        <th colspan="13">
                            {{-- Alert --}}
                            @if (session('success'))
                                <x-ui.alert type="success" :message="session('success')" />
                            @elseif (session('error'))
                                <x-ui.alert type="error" :message="session('error')" />
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">No</th>
                        <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Buyer Name</th>
                        <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Lokasi</th>
                        <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Transaksi</th>
                        <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Listing</th>
                        <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Harga Sekitar</th>
                        <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">LT</th>
                        <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">LB</th>
                        <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">KT</th>
                        <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">KM</th>
                        <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Matched</th>
                        <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Date</th>
                        <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Action</th>
                    </tr>
                </thead>
                {{-- Row --}}
                <tbody class="divide-y divide-gray-200">
                    @if ($buyRequest->isEmpty())
                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900" colspan="12">Tidak Ada
                                Data
                            </td>
                        </tr>
                    @endif
                    @foreach ($buyRequest as $data)
                        <tr class="odd:bg-gray-100 rounded-lg">
                            <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">{{ $data->requestID }}
                            </td>
                            <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">{{ $data->buyerName }}
                            </td>
                            <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">
                                {{ $location[$data->lokasiID] ?? 'Unknown' }}</td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">
                                @if ($data->transaksiID == 1)
                                    Dijual
                                @elseif ($data->transaksiID == 0)
                                    Disewa
                                @else
                                    Unknown
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">
                                {{ $listingType[$data->listingType] ?? 'Unknown' }}</td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">
                                @if (isset($data->hargaJualMin) && isset($data->hargaJualMax))
                                    Rp.{{ format_price($data->hargaJualMin) }}<br> -
                                    <br>Rp.{{ format_price($data->hargaJualMax) }}
                                @else
                                    0
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 ">
                                @if (isset($data->luasTanahMin) && isset($data->luasTanahMax))
                                    {{ $data->luasTanahMin }} m<sup>2</sup><br> -
                                    <br>{{ $data->luasTanahMax }}
                                    m<sup>2</sup>
                                @else
                                    0 m<sup>2</sup>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 ">
                                @if (isset($data->luasBangunanMin) && isset($data->luasBangunanMax))
                                    {{ $data->luasBangunanMin }} m<sup>2</sup><br> -
                                    <br>{{ $data->luasBangunanMax }} m<sup>2</sup>
                                @else
                                    0 m<sup>2</sup>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->kamar_tidur ?? 'Unknown' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $data->kamar_mandi ?? 'Unknown' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <div class="flex items-center justify-center">
                                    @if ($data->isMatched == 1)
                                        <a href="{{ route('viewMatched', [Auth::user()->id, $data->requestID]) }}"
                                            class="inline-block rounded px-4 py-2 text-xs font-medium text-white">
                                            <svg width="48px" height="48px" viewBox="0 0 24.00 24.00" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" stroke="#2eff62"
                                                transform="matrix(1, 0, 0, 1, 0, 0)" style="cursor: pointer">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.3344 2.75024H7.66537C4.64437 2.75024 2.75037 4.88924 2.75037 7.91624V16.0842C2.75037 19.1112 4.63537 21.2502 7.66537 21.2502H16.3334C19.3644 21.2502 21.2504 19.1112 21.2504 16.0842V7.91624C21.2504 4.88924 19.3644 2.75024 16.3344 2.75024Z"
                                                        stroke="#1bc045" stroke-width="0.672" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path opacity="0.4"
                                                        d="M8.43982 12.0002L10.8138 14.3732L15.5598 9.6272"
                                                        stroke="#1bc045" stroke-width="0.672" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </a>
                                    @else
                                    <svg fill="#ff2e2e" width="38px" height="38px"
                                    viewBox="0 0 32.31 32.31"
                                    xmlns="http://www.w3.org/2000/svg" stroke="#ff2e2e"
                                    stroke-width="0.00032311000000000004"
                                    style="cursor: pointer">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                        stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g transform="translate(-96.951 -642.343)">
                                            <path
                                                d="M125.2,644.343a2.062,2.062,0,0,1,2.06,2.059v24.191a2.062,2.062,0,0,1-2.06,2.06H101.011a2.063,2.063,0,0,1-2.06-2.06V646.4a2.063,2.063,0,0,1,2.06-2.059H125.2m0-2H101.011a4.059,4.059,0,0,0-4.06,4.059v24.191a4.06,4.06,0,0,0,4.06,4.06H125.2a4.06,4.06,0,0,0,4.06-4.06V646.4a4.059,4.059,0,0,0-4.06-4.059Z">
                                            </path>
                                            <path
                                                d="M120.862,667.253a1,1,0,0,1-.707-.293l-15.511-15.51a1,1,0,0,1,1.414-1.414l15.511,15.51a1,1,0,0,1-.707,1.707Z">
                                            </path>
                                            <path
                                                d="M105.351,667.253a1,1,0,0,1-.707-1.707l15.511-15.51a1,1,0,0,1,1.414,1.414l-15.511,15.51A1,1,0,0,1,105.351,667.253Z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>

                                    @endif
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{mb_strimwidth($data->created_at, 0, 10)}}
                            </td>

                            <!-- Action -->
                            <td class="whitespace-nowrap px-2 py-2 flex space-x-2 justify-center items-center mt-4">
                                <!-- Button Delete -->
                                <form action="{{ route('BuyRequest.delete', $data->requestID) }}" method="POST"
                                    class="inline" enctype="multipart/form-data"
                                    onsubmit="return confirm('Are you sure you want to Delete selected Request?');">
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
        </div>
        <div class="flex my-4 justify-center ">
            {{ $buyRequest->links() }}
        </div>
        </div>
    </x-section>

    @section('scripts')
        @vite('resources/js/filter.js')
        <script>
            const filterButton = document.getElementById('filter-button');
            const filterCard = document.getElementById('filter-card');

            function toggleFilterCard() {
                const filterCard = document.getElementById('filter-card');
                filterCard.classList.toggle('hidden');
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

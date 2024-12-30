{{-- Buy Request --}}
<x-admin-layout>
    {{-- Title --}}
    <div class="p-6min-h-screen">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4">Laporan Semua Buy Request Agen</h1>

        {{-- <form method="GET" action="{{ route('laporanBuyRequest.submit') }}" class="flex flex-wrap items-center gap-4 mb-6"
            id="searchForm">
            <!-- Date Pickers -->
            <div class="flex items-center gap-2">
                <label for="start-date" class="text-gray-700 font-medium">Tanggal mulai</label>
                <div class="relative max-w-sm">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input datepicker id="default-datepicker-mulai" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                        placeholder="1/1/2024" name="date-start" autocomplete="off">
                </div>
            </div>

            <div class="flex items-center gap-2">
                <label for="end-date" class="text-gray-700 font-medium">Tanggal selesai</label>
                <div class="relative max-w-sm">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input datepicker id="default-datepicker-end" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                        placeholder="31/12/2024" name="date-end" autocomplete="off">
                </div>
            </div>

            <!-- Status Dropdown -->
            <div class="flex items-center gap-3">
                <label for="status" class="text-gray-700 font-medium text-nowrap whitespace-nowrap">Pilih Agen</label>
                <div class="relative w-full max-w-sm">
                    <a id="dropdown-button-user"
                        class="inline-flex justify-between p-2.5 w-full px-14 py-2.5 text-sm font-medium bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 cursor-pointer">
                        <span id="dropdown-label" class="mr-2">Pilih Agen</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <div id="dropdown-menu-user"
                        class="hidden absolute bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 p-2.5 rounded shadow-md mt-1 max-h-48 overflow-y-auto w-full z-10">
                        <input id="search-input-user"
                            class="block w-full px-4 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 rounded-md focus:outline-none"
                            type="text" placeholder="Search items" autocomplete="off">
                        @foreach ($users as $user)
                            <a data-value="{{ $user->id }}" name="agentID"
                                class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">{{ $user->name }}</a>
                        @endforeach
                    </div>
                </div>
                <input type="hidden" name="agentID" id="agentID" value="">
            </div>

            <button type="submit" class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-4 py-2 rounded-lg hover:to-orange-500 text-nowrap whitespace-nowrap flex"> <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.9 14.32a7 7 0 111.42-1.42l3.98 3.98a1 1 0 01-1.42 1.42l-3.98-3.98zM10 16a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
            </svg> Cari</button>
        </form> --}}

        <form method="GET" action="{{ route('laporanBuyRequest.submit') }}" class="flex flex-col lg:flex-row lg:flex-wrap gap-4 mb-6" id="searchForm">
            <!-- Tanggal Mulai -->
            <div class="w-full lg:w-auto flex flex-col lg:flex-row items-start lg:items-center gap-2">
                <label for="start-date" class="text-gray-700 font-medium mb-1 lg:mb-0">Tanggal mulai</label>
                <div class="relative w-full lg:max-w-sm">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input datepicker id="default-datepicker-mulai" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full ps-10 p-2.5" placeholder="1/1/2024" name="date-start" autocomplete="off">
                </div>
            </div>

            <!-- Tanggal Selesai -->
            <div class="w-full lg:w-auto flex flex-col lg:flex-row items-start lg:items-center gap-2">
                <label for="end-date" class="text-gray-700 font-medium mb-1 lg:mb-0">Tanggal selesai</label>
                <div class="relative w-full lg:max-w-sm">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input datepicker id="default-datepicker-end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full ps-10 p-2.5" placeholder="31/12/2024" name="date-end" autocomplete="off">
                </div>
            </div>

            <!-- Pilih Agen -->
            <div class="w-full lg:w-auto flex flex-col lg:flex-row items-start lg:items-center gap-2">
                <label for="status" class="text-gray-700 font-medium mb-1 lg:mb-0">Pilih Agen</label>
                <div class="relative w-full lg:max-w-sm">
                    <a id="dropdown-button-user" class="inline-flex justify-between items-center p-2.5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 cursor-pointer">
                        <span id="dropdown-label" class="mr-2">Pilih Agen</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <div id="dropdown-menu-user" class="hidden absolute bg-gray-50 border border-gray-300 text-gray-900 text-sm p-2.5 rounded shadow-md mt-1 max-h-48 overflow-y-auto w-full z-10">
                        <input id="search-input-user" class="block w-full px-4 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 focus:outline-none" type="text" placeholder="Search items" autocomplete="off">
                        @foreach ($users as $user)
                            <a data-value="{{ $user->id }}" class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer rounded-md">{{ $user->name }}</a>
                        @endforeach
                    </div>
                </div>
                <input type="hidden" name="agentID" id="agentID" value="">
            </div>

            <!-- Submit Button -->
            <div class="w-full lg:w-auto">
                <button type="submit" class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-4 py-2 rounded-lg hover:to-orange-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.9 14.32a7 7 0 111.42-1.42l3.98 3.98a1 1 0 01-1.42 1.42l-3.98-3.98zM10 16a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd"/>
                    </svg>
                    Cari
                </button>
            </div>
        </form>


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

    {{-- BUY REQUEST SECTION --}}
    <div class="overflow-x-auto mt-5">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm text-center">
            {{-- Column --}}
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">No</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Tanggal</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Pemesan</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Nama Pembeli</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Lokasi</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Transaksi</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Daftar</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Kisaran Harga</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Luas Lahan</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Luas Bangunan</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">K.Tidur</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">K.Mandi</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Pencocokan</th>
                </tr>
            </thead>
            {{-- Row --}}
            <tbody class="divide-y divide-gray-200">

                @if ($buyRequests->isEmpty())
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900" colspan="13">Tidak Ada Data
                        </td>
                    </tr>
                @else
                    {{-- Show the "View PDF" button only if there is filtered data --}}
                    @if (!empty($dateStart) || !empty($dateEnd) || !empty($agentID))
                        <div class="mb-4 flex items-center justify-center h-full space-x-4">
                            <form action="{{ route('streamPDF.view') }}" method="post" class="inline-block" target="_blank">
                                @csrf
                                <input type="hidden" name="date-start" value="{{ request('date-start', '') }}">
                                <input type="hidden" name="date-end" value="{{ request('date-end', '') }}">
                                <input type="hidden" name="agentID" value="{{ request('agentID', '') }}">
                                <button type="submit"
                                    class="text-center rounded-lg bg-gradient-to-r from-blue-600 to-blue-800 px-4 py-2 text-sm font-medium text-white hover:to-blue-500">
                                    <i class="fa-regular fa-file-pdf"></i>
                                    View PDF
                                </button>
                            </form>

                            <form action="{{ route('streamPDF.submit') }}" method="post" class="inline-block">
                                @csrf
                                <input type="hidden" name="date-start" value="{{ request('date-start', '') }}">
                                <input type="hidden" name="date-end" value="{{ request('date-end', '') }}">
                                <input type="hidden" name="agentID" value="{{ request('agentID', '') }}">
                                <button type="submit"
                                    class="text-center rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-600">
                                    <i class="fa-regular fa-file-pdf"></i>
                                    Download PDF
                                </button>
                            </form>
                        </div>
                    @endif

                    {{-- Display the filtered data --}}
                    @foreach ($buyRequests as $data)
                        <tr class="odd:bg-gray-100 rounded-lg">
                            <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700">{{ $loop->iteration }}
                            </td>
                            <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700">
                                {{ $data->created_at->format('j-F-Y') }}
                            </td>
                            <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700">{{ explode(' ', $data->agent_name)[0] }}
                            </td>
                            <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700">{{ explode(' ', $data->buyerName)[0] }}
                            </td>
                            <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700">
                                {{ $location[$data->lokasiID] ?? 'Unknown' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700">
                                @if ($data->transaksiID == 1)
                                    Dijual
                                @elseif ($data->transaksiID == 0)
                                    Disewa
                                @else
                                    Unknown
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700">
                                {{ $listingType[$data->listingType] ?? 'Unknown' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700">
                                @if (isset($data->hargaJualMin) && isset($data->hargaJualMax))
                                    Rp.{{ format_price($data->hargaJualMin) }}<br> -
                                    <br>Rp.{{ format_price($data->hargaJualMax) }}
                                @else
                                    0
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                @if (isset($data->luasTanahMin) && isset($data->luasTanahMax))
                                    {{ $data->luasTanahMin }} m<sup>2</sup><br> - <br>{{ $data->luasTanahMax }}
                                    m<sup>2</sup>
                                @else
                                    0 m<sup>2</sup>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                @if (isset($data->luasBangunanMin) && isset($data->luasBangunanMax))
                                    {{ $data->luasBangunanMin }} m<sup>2</sup><br> - <br>{{ $data->luasBangunanMax }}
                                    m<sup>2</sup>
                                @else
                                    0 m<sup>2</sup>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                {{ $data->kamar_tidur ?? 'Unknown' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                {{ $data->kamar_mandi ?? 'Unknown' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <div class="flex items-center justify-center">
                                    @if ($data->isMatched == 1)
                                        <a href="{{ route('viewRequestMatched', [Auth::user()->id, $data->requestID]) }}"
                                            class="inline-block rounded bg-green-500 px-4 py-2 text-xs font-medium text-white hover:bg-green-600">
                                            Lihat Detail
                                        </a>
                                    @else
                                        <span class="inline-block px-4 py-2 text-xs font-medium text-red-500">Tidak
                                            Tersedia</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        {{-- Pagination Links --}}
        <div class="flex mt-4 justify-center ">
            {{ $buyRequests->links() }}
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdown-button');
            const dropdownMenu = document.getElementById('dropdown-menu');
            const dropdownItems = dropdownMenu.querySelectorAll('[data-value]');
            const dropdownText = dropdownButton.querySelector('span');
            const searchInput = document.getElementById('search-input');

            // Toggle dropdown menu visibility
            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });

            dropdownItems.forEach(item => {
                item.addEventListener('click', function() {
                    const selectedValue = this.getAttribute('data-value');
                    const selectedText = this.textContent.trim();

                    // Update button text
                    dropdownButton.innerHTML =
                        `${selectedText} <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>`;

                    // Close dropdown
                    dropdownMenu.classList.add('hidden');

                    // Set the value of the hidden input field
                    const hiddenInput = document.getElementById('lokasiID');

                    // Set the value of the hidden input
                    hiddenInput.value = selectedValue;

                    // Optionally: log the selected value
                    console.log(`Selected value: ${selectedValue}`);
                });
            });

            // Filter dropdown items based on search input
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const filter = searchInput.value.toLowerCase();
                    dropdownItems.forEach(item => {
                        const text = item.textContent.trim().toLowerCase();
                        if (text.includes(filter)) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdown-button-user');
            const dropdownMenu = document.getElementById('dropdown-menu-user');
            const dropdownItems = dropdownMenu.querySelectorAll('.dropdown-item');
            const dropdownText = dropdownButton.querySelector('#dropdown-label');
            const searchInput = document.getElementById('search-input-user');
            const hiddenInput = document.getElementById('agentID');

            // Toggle dropdown menu visibility
            dropdownButton.addEventListener('click', function(event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });

            // Handle dropdown item selection
            dropdownItems.forEach(item => {
                item.addEventListener('click', function() {
                    const selectedValue = this.getAttribute('data-value');
                    const selectedText = this.textContent.trim();

                    // Update button text
                    dropdownText.textContent = selectedText;

                    // Close dropdown menu
                    dropdownMenu.classList.add('hidden');

                    // Update the hidden input value
                    hiddenInput.value = selectedValue;

                    // Optionally: log the selected value
                    console.log(`Selected value: ${selectedValue}`);
                });
            });

            // Filter dropdown items based on search input
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const filter = searchInput.value.toLowerCase();
                    dropdownItems.forEach(item => {
                        const text = item.textContent.trim().toLowerCase();
                        if (text.includes(filter)) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });
                });
            }
        });

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

        document.getElementById('searchForm').addEventListener('submit', function(e) {
            const dateStart = document.querySelector('input[name="date-start"]').value;
            const dateEnd = document.querySelector('input[name="date-end"]').value;
            const agentID = document.querySelector('input[name="agentID"]').value;

            // Check if both dates are filled or if agent is selected
            if (!(dateStart && dateEnd) && !agentID) {
                e.preventDefault(); // Prevent form submission
                alert('Please fill in both dates or select an agent.');
            }
        });
    </script>
</x-admin-layout>

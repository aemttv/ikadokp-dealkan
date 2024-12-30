<x-layout title="Buy Request">

    <x-section>

        @if (session('success'))
            <div id="toast-success"
                class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                    </svg>
                    <span class="sr-only">Success icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        <div class="relative auto shadow-md sm:rounded-lg my-24 overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-black ">
                <thead class="text-xs text-black uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No.
                        </th>
                        <th scope="col" class="px-16 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Judul
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lokasi
                        </th>
                        <th scope="col" class="px-10 py-3">
                            Harga
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kamar Tidur
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kamar Mandi
                        </th>
                        <th scope="col" class="px-10 py-3 text-center">
                            Jumlah Request Cocok
                        </th>
                    </tr>
                </thead>
                <tbody>
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
                        // Group the $matchedRequests collection by title or any other unique attribute
                        $groupedRequests = $matchedRequests->groupBy('title');
                    @endphp
                    @if ($groupedRequests->isEmpty())
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center">
                            <div class="flex flex-col items-center justify-center h-96">
                                <img src="{{ asset('assets/svg/not-found.svg') }}" alt="Not Found" class="mb-4 w-24 h-24" />
                                <p class="text-lg font-semibold">Tidak ada listing yang cocok ditemukan.</p>
                                <div class="mt-4">
                                    <a href="{{route('BuyRequest.view', Auth::user()->id)}}" class="inline-block text-black border-b-2 border-orange-500 hover:text-orange-500 hover:border-orange-700 transition-colors">
                                        Kembali ke halaman utama
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach ($groupedRequests as $title => $requests)
                        @php
                            $count = $requests->count();
                            $firstRequest = $requests->first(); // Get the first entry from the group
                        @endphp
                        <tr>
                            {{-- <td colspan="10" class="px-6 py-4 text-center">
                                <div class="flex flex-col items-center justify-center h-96">
                                    <img src="{{ asset('assets/svg/not-found.svg') }}" alt="Not Found"
                                        class="mb-4 w-24 h-24" />
                                    <p class="text-lg font-semibold">Tidak ada buy request yang ditemukan.
                                    </p>
                                    <div class="mt-4">
                                        <a href="{{ route('addRequest.view', Auth::user()->id) }}"
                                            class="inline-block text-black border-b-2 border-orange-500 hover:text-orange-500 hover:border-orange-700 transition-colors">
                                            Ada request ? Klik disini
                                        </a>
                                    </div>
                                </div>
                            </td> --}}
                        </tr>
                            <tr class="bg-white border-b hover:bg-gray-50 cursor-pointer" onclick="window.location.href='{{ route('property.detail', $firstRequest->listingID) }}'">
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $firstRequest->listingID }}
                                </td>
                                <td class="p-4">
                                    <img src="{{ asset('storage/' . $firstRequest->image_main) }}"
                                        class="w-32 md:w-32 max-w-50 max-h-150" alt="property image">
                                </td>

                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ mb_strimwidth($firstRequest->title, 0, 40, '...') }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $location[$firstRequest->lokasiID] }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ format_price($firstRequest->hargaJual) }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 text-center">
                                    {{ $firstRequest->ktUtama }} @if ($firstRequest->ktLain)
                                        + {{ $firstRequest->ktLain }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 text-center">
                                    {{ $firstRequest->kmUtama }} @if ($firstRequest->kmLain)
                                        + {{ $firstRequest->kmLain }}
                                    @endif
                                </td>
                                <td class="px-10 py-4">
                                    <p class="font-medium text-sm text-gray-500">
                                        Matches: {{ $count }}
                                    </p>
                                    {{-- <a href="https://wa.me/{{ '62' . Auth::user()->nowa }}?text={{ urlencode('Halo, saya tertarik dengan seputar properti di daerah Surabaya') }}"
                                        class="font-medium text-sm text-green-400 hover:underline flex items-center text-nowrap">
                                        CONTACT AGEN
                                    </a> --}}
                                </td>
                            </tr>
                    @endforeach
@endif

                </tbody>
            </table>
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

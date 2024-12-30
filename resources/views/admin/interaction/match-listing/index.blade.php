{{-- Match Listing --}}
<x-admin-layout>
    {{-- Title --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Rekomendasi Properti Sesuai Kebutuhan Anda    </h1>
            <p class="text-gray-600">Solusi terbaik untuk memenuhi permintaan pembeli melalui jaringan agen terpercaya!</p>
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
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm text-center mt-4">
            {{-- Column --}}
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">ID</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Judul</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Lokasi</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Transaksi</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">Harga</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">K.Tidur</th>
                    <th class="whitespace-nowrap px-4 py-2 font-bold text-gray-900">K.Mandi</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Permintaan Cocok</th>
                    <th class="whitespace-nowrap px-2 py-2 font-bold text-gray-900">Interaksi</th>
                </tr>
            </thead>
            {{-- Row --}}
            <?php
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
            $groupedRequests = $matchedRequests->groupBy('title');
            ?>
            <tbody class="divide-y divide-gray-200">
                @if ($groupedRequests->isEmpty())
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900" colspan="10">Tidak Ada Data
                        </td>
                    </tr>
                @endif
                @foreach ($groupedRequests as $data => $requests)
                    @php
                        $count = $requests->count();
                        $first = $requests->first();
                    @endphp
                    <tr class="odd:bg-gray-100 rounded-lg">
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">{{ $loop->iteration }}</td>
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">{{ mb_strimwidth($first->title, 0, 40, '...') }}</td>
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">
                            {{ $location[$first->lokasiID] }}</td>
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">
                            {{ $first->transaksiID == 1 ? 'Dijual' : 'Disewa' }}</td>
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-700 ">
                            Rp. {{ format_price($first->hargaJual) }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">
                            @if ($first->ktLain > 0)
                                {{ $first->ktUtama }} + {{ $first->ktLain }}
                            @else
                                {{ $first->ktUtama }}
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">
                            @if ($first->kmLain > 0)
                                {{ $first->kmUtama }} + {{ $first->kmLain }}
                            @else
                                {{ $first->kmUtama }}
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-700 ">
                            {{ $count }}
                        </td>

                        <!-- Action -->
                        <td class="whitespace-nowrap px-2 py-2 flex space-x-2 justify-center items-center">
                            <!-- Button Delete -->
                            <a href="{{ route('property.detail', $first->listingID) }}"
                                class="inline-block rounded bg-gradient-to-r from-orange-400 to-orange-600 px-4 py-2 text-xs font-medium text-white hover:to-orange-500">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination Links --}}
        {{-- <div class="flex mt-4 justify-center ">
            {{ $groupedRequests->links() }}
        </div> --}}
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

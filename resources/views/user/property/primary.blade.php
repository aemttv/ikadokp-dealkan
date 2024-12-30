<x-layout title="Detail">
    {{-- Dropdown untuk memilih arah --}}
    <x-section>
        <div class="flex flex-col md:flex-row items-start md:space-x-8 pt-16 px-3"> <!-- Tambahkan pt-16 di sini -->
            <div class="md:w-1/2">
                <h1 class="text-4xl font-bold text-gray-800">Primary</h1>
                <p class="text-gray-500">
                    Pilihan tempat yang tepat <br>untuk masa depan cemerlang.
                </p>

                <!-- Dropdown -->
                <div class="mt-4">
                    <label class="text-gray-500 font-medium">Orientasi</label>
                    <div class="relative w-full md:max-w-md">
                        <form action="{{ route('property.primarySearch') }}" method="GET">
                            <select id="direction" name="direction"
                                class="block appearance-none w-full bg-white border border-gray-300 text-gray-800 py-2 px-3 pr-8 rounded-lg shadow leading-tight focus:outline-none focus:shadow-outline"
                                onchange="this.form.submit()">
                                <option value="0" {{ request('direction') == '0' ? 'selected' : '' }}>Semua
                                </option>
                                <option value="1" {{ request('direction') == '1' ? 'selected' : '' }}>Surabaya
                                    Barat</option>
                                <option value="2" {{ request('direction') == '2' ? 'selected' : '' }}>Surabaya
                                    Selatan</option>
                                <option value="3" {{ request('direction') == '3' ? 'selected' : '' }}>Surabaya
                                    Timur</option>
                                <option value="4" {{ request('direction') == '4' ? 'selected' : '' }}>Surabaya
                                    Utara</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Image Section -->
            <div class="w-full md:w-1/2 mt-8 md:mt-0 flex justify-center md:justify-end">
                <div class="overflow-hidden rounded-lg shadow-lg w-full h-64 md:h-80"> <!-- Set fixed height -->
                    <img src="{{ asset('assets/images/Others/resto.jpg') }}"
                        alt="Kantor Dealkan Surabaya Barat"
                        class="w-full h-full object-cover transition-opacity duration-500 ease-in-out opacity-0"
                        onload="this.classList.remove('opacity-0')" fetchpriority="high" />
                </div>
            </div>
        </div>

        <!-- Properti Baru Section -->
        <div class="container mx-auto my-10 px-8 md:px-6">
            <div class="flex justify-between items-center">
                <h2 id="orientation-label" class="text-3xl font-semibold text-gray-800"> Orientasi
                </h2>
                @if (!$primary == [])
                <p class="text-gray-600 mt-2 mx-2">
                    Menampilkan {{ $primary->firstItem() }}-{{ $primary->lastItem() }} dari total
                    {{ $primary->total() }} properti
                </p>
            @endif
            </div>

            <hr class="my-4 border-gray-300">
        </div>


        <?php
        $hadapType = [
            1 => 'Barat',
            2 => 'Selatan',
            3 => 'Timur',
            4 => 'Utara',
        ];
    ?>
        {{-- CARD START --}}
        <div class="relative overflow-hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @isset($primary)
                    @if (count($primary) == 0)
                        <div
                            class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col items-center justify-center h-96 text-center">
                            <img src="{{ asset('assets/svg/not-found.svg') }}" alt="Not Found" class="mb-4 w-24 h-24" />
                            <p class="text-lg font-semibold">Tidak ada properti yang ditemukan.</p>

                            <div class="mt-4">
                                <a href="{{ url()->previous() }}"
                                    class="inline-block  text-black border-b-2 border-orange-500 hover:text-orange-500 hover:border-orange-700 transition-colors">
                                    Lihat Semua Properti
                                </a>
                            </div>
                        </div>
                    @endif
                    @foreach ($primary as $data)
                        <div class="swiper-slide">
                            <a href="{{ route('property.detail', $data->listingID) }}" class="block group">
                                <div class="max-w-sm mx-auto p-4 transition-transform transform group-hover:scale-105">
                                    <img alt="{{ $data->title }} - Dealkan"
                                        src="{{ asset('storage/' . $data->image_main) }}"
                                        class="h-56 w-full rounded-xl object-cover shadow-xl transition-opacity duration-700 ease-in-out opacity-0 group-hover:grayscale-[50%]"
                                        loading="lazy" decoding="async" width="320" height="224"
                                        onload="this.classList.remove('opacity-0')" fetchpriority="high" />

                                    <div class="flex justify-between items-center mt-4">
                                        <h1 class="font-bold text-xl">{{ $data->title }}</h1>
                                        <span class="bg-gradient-to-r from-orange-600 to-orange-400 text-white px-6 py-1 rounded-lg">Baru</span>
                                    </div>

                                    <div class="flex items-center text-gray-700 text-base">
                                        <svg class="w-6 h-6 text-gray-500 mr-1" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M12 2C8.1 2 5 5.1 5 9c0 4.9 7 13 7 13s7-8.1 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5s2.5 1.1 2.5 2.5S13.4 11.5 12 11.5z" />
                                        </svg>
                                        <div x-data="{
                                            lokasiNames: {
                                                1: 'Asemrowo',
                                                2: 'Benowo',
                                                3: 'Bubutan',
                                                4: 'Bulak',
                                                5: 'Dukuh Pakis',
                                                6: 'Gayungan',
                                                7: 'Genteng',
                                                8: 'Gubeng',
                                                9: 'Gunung Anyar',
                                                10: 'Jambangan',
                                                11: 'Karang Pilang',
                                                12: 'Kenjeran',
                                                13: 'Krembangan',
                                                14: 'Lakarsantri',
                                                15: 'Mulyorejo',
                                                16: 'Pabean Cantian',
                                                17: 'Pakal',
                                                18: 'Rungkut',
                                                19: 'Sambikerep',
                                                20: 'Sawahan',
                                                21: 'Semampir',
                                                22: 'Simokerto',
                                                23: 'Sukolilo',
                                                24: 'Sukomanunggal',
                                                25: 'Tambaksari',
                                                26: 'Tandes',
                                                27: 'Tegalsari',
                                                28: 'Tenggilis Mejoyo',
                                                29: 'Wiyung',
                                                30: 'Wonocolo',
                                                31: 'Wonokromo'
                                            },
                                            lokasiID: {{ $data->lokasiID }} // Injecting the dynamic ID from the backend
                                        }" x-init="console.log(lokasiNames[lokasiID])">
                                            <div>
                                                Kota Surabaya {{ $hadapType[$data->orientasiID] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
        {{-- CARD END --}}

        {{-- Navigasi Pagination --}}
        <div class="flex justify-center items-center my-10 overflow-x-auto max-w-full">
            {{ $primary->links('pagination::tailwind') }}
        </div>
    </x-section>
    {{-- Hubungi Kami Section START --}}
    <x-hubungi></x-hubungi>
    {{-- Hubungi Kami Section END --}}


    @section('scripts')
        <script>
            function updateAndNavigate(value) {
                // Redirect to the correct URL based on the selected direction
                if (value && value !== 'Semua') {
                    window.location.href = `{{ url('proyek-baru/arah') }}/${value}`;
                } else {
                    window.location.href = `{{ url('proyek-baru') }}`;
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
        const selectElement = document.getElementById('direction');
        const labelElement = document.getElementById('orientation-labelha');

        selectElement.addEventListener('change', function () {
            const selectedOption = selectElement.options[selectElement.selectedIndex].text;
            labelElement.textContent = `${selectedOption}`;
        });

        // Initialize the label with the current selection
        const initialSelectedOption = selectElement.options[selectElement.selectedIndex].text;
        labelElement.textContent = `${initialSelectedOption}`;
    });
        </script>
    @endsection


</x-layout>

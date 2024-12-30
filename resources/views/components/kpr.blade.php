<div class="bg-gradient-to-r from-orange-400 to-orange-600 p-6 shadow-lg w-full">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Form Section -->
        <div class="space-y-4">
            <div>
                <label class="block text-white font-medium mb-2 ">Harga Properti (Rp)</label>
                <input id="harga-property" type="text" placeholder="Rp."
                    class="w-full border border-gray-300 px-4 py-2 text-sm bg-white p-6 rounded-lg shadow-lg"
                    value="{{ $value }}">
            </div>
            <div>
                <label class="block text-white font-medium mb-2">Uang Muka (Rp)</label>
                <input id="uang-muka" type="text" placeholder="Rp."
                    class="w-full border border-gray-300 px-4 py-2 text-sm bg-white p-6 rounded-lg shadow-lg">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-white font-medium mb-2">Tenor Pinjaman </label>
                    <input id="jangka-waktu-p" type="text" placeholder="1 Tahun"
                        class="w-full border border-gray-300 px-4 py-2 text-sm bg-white p-6 rounded-lg shadow-lg">
                </div>
                <div class="relative inline-block w-full">
                    <label for="bank-select" class="block text-white font-medium mb-2">Suku Bunga (%)</label>
                    <div id="dropdown" class="w-full border border-gray-300 rounded-lg shadow-lg">

                        <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch"
                            data-dropdown-placement="bottom"
                            class="text-gray-600 bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs w-full py-3 text-center inline-flex items-center justify-between"
                            type="button">
                            <span class="mx-2 text-gray-400">Pilih Bank</span>
                            <svg class="w-4 h-2 mx-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <div id="dropdownSearch" class="z-50 hidden bg-white rounded-lg shadow w-full">
                            <!-- Search Input -->
                            <div class="p-3">
                                <label for="input-group-search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="input-group-search"
                                        class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Cari Bank">
                                </div>
                            </div>

                            <!-- Hidden input to store the selected interest rate value -->
                            <input type="hidden" id="selectedInterestRate" name="selectedInterestRate">

                            <!-- User List -->
                            <ul id="bank-list" class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 w-full"
                                aria-labelledby="dropdownSearchButton">
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                        <input id="radio-1" type="radio" value="2.67" name="default-radio"
                                            class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="radio-1"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded">BCA</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                        <input id="radio-2" type="radio" value="5" name="default-radio"
                                            class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="radio-2"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded">BRI</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                        <input id="radio-3" type="radio" value="2.65" name="default-radio"
                                            class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="radio-3"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded">Mandiri</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                        <input id="radio-4" type="radio" value="5.68" name="default-radio"
                                            class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="radio-4"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded">Danamon</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                        <input id="radio-5" type="radio" value="4.99" name="default-radio"
                                            class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="radio-5"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded">Bank
                                            BTN</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                        <input id="radio-6" type="radio" value="5.99" name="default-radio"
                                            class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="radio-6"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded">KB
                                            Bukopin</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                        <input id="radio-7" type="radio" value="5.5" name="default-radio"
                                            class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="radio-7"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded">Commonwealth
                                            Bank</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                        <input id="radio-8" type="radio" value="4.75" name="default-radio"
                                            class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="radio-8"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded">May
                                            Bank</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                        <input id="radio-9" type="radio" value="4.5" name="default-radio"
                                            class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="radio-9"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded">Panin
                                            Bank</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                        <input id="radio-10" type="radio" value="4.25" name="default-radio"
                                            class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-blue-500">
                                        <label for="radio-10"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded">Permata
                                            Bank</label>
                                    </div>
                                </li>
                                <!-- Add more list items as needed -->
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Simulation Result Section -->
        <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col justify-between w-full">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Hasil Simulasi KPR</h2>

                <!-- Mobile view: Vertical layout (default) -->
                <div class="mb-4 lg:flex lg:justify-between lg:items-center lg:mb-4">
                    <!-- Property Price -->
                    <div class="mb-4 lg:mb-0">
                        <h6 class="text-gray-500">Harga Properti (Rp)</h6>
                        <h5 id="harga-property-result" class="text-2xl font-bold text-gray-800">Rp 0</h5>
                    </div>

                    <!-- Monthly Installment -->
                    <div class="mb-4 lg:mb-0">
                        <h6 class="text-gray-500">Jumlah Angsuran/Bulan</h6>
                        <h5 id="angsuran-bulan-result" class="text-2xl font-bold text-gray-800">Rp 0</h5>
                    </div>
                </div>
            </div>

            <!-- Disclaimer -->
            <p class="text-sm text-gray-700">
                *Hasil dari perhitungan simulasi KPR ini hanya merupakan perkiraan saja. Untuk perhitungan tepatnya,
                pihak bank akan memberikan ilustrasi angsuran Anda.
            </p>
        </div>



    </div>

</div>

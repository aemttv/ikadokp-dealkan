<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            <!-- Dashboard -->
            <li>
                <a href="{{route('admin.home')}}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <!-- User -->
            <li>
                <a href="{{route('admin-users.profil')}}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="text-center flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Daftar Pengguna</span>
                </a>
            </li>

            <!-- Property -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                    aria-controls="property-submenu" data-collapse-toggle="property-submenu">
                    <i class="flex-shrink-0 fa-solid fa-list w-5 h-5"></i>
                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Properti</span>
                    <svg class="text-center w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 9.707a1 1 0 0 1 1.414 0L10 13.586l3.293-3.879a1 1 0 0 1 1.414 0l.293.293-4 5-4-5 .293-.293z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <ul id="property-submenu" class="hidden py-2 space-y-2 mx-4">
                    <li>
                        <a href="{{route('propertyVerif.view', Auth::user()->role)}}"
                            class="flex items-center w-full p-2 pl-10 text-gray-900 rounded-lg group hover:bg-gray-100">
                            Daftar Konfirmasi
                        </a>
                    </li>
                    <li>
                        <a href="{{route('propertyPrimary.view', Auth::user()->role)}}"
                            class="flex items-center w-full p-2 pl-10 text-gray-900 rounded-lg group hover:bg-gray-100">
                            Daftar Utama
                        </a>
                    </li>
                    <li>
                        <a href="{{route('propertySecondary.view', Auth::user()->role)}}"
                            class="flex items-center w-full p-2 pl-10 text-gray-900 rounded-lg group hover:bg-gray-100">
                            Daftar Sekunder
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Beli & Pencocokan -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                    aria-controls="transaction-submenu" data-collapse-toggle="transaction-submenu">
                    <i class="flex-shrink-0 fa-solid fa-list w-5 h-5"></i>
                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Transaksi & Kesesuaian</span>
                    <svg class="text-center w-5 h-5 text-black transition duration-75 group-hover:text-gray-900"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 9.707a1 1 0 0 1 1.414 0L10 13.586l3.293-3.879a1 1 0 0 1 1.414 0l.293.293-4 5-4-5 .293-.293z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <ul id="transaction-submenu" class="hidden py-2 space-y-2 mx-4">
                    <li>
                        <a href="{{route('allBuyRequest.view')}}"
                            class="flex items-center w-full p-2 pl-10 text-gray-900 rounded-lg group hover:bg-gray-100">
                            Daftar Permintaan
                        </a>
                    </li>
                    <li>
                        <a href="{{route('showMatchListing.view' , Auth::user()->id)}}"
                            class="flex items-center w-full p-2 pl-10 text-gray-900 rounded-lg group hover:bg-gray-100">
                            Daftar Pencocokan
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Laporan -->
            {{-- <li>
                <a href="{{route('generate-pdf')}}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Generate Laporan</span>
                </a>
            </li> --}}
            <li>
                <a href="{{route('laporanBuyRequest.view')}}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    {{-- <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg> --}}
                    <i class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 fa-regular fa-file-lines text-center"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Laporan Transaksi</span>
                </a>
            </li>
        </ul>

    </div>
</aside>

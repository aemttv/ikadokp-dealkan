<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-between w-full">
                <!-- Hamburger Menu Button (only visible on mobile) -->
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>

                {{-- <!-- Logo and Phrase -->
                <a href="{{ route('admin.home') }}" class="flex items-center w-full sm:w-auto justify-between sm:justify-start">
                    <!-- Logo Image -->
                    <img src="{{ asset('assets/images/logo/type_logo.png') }}" class="h-9 sm:h-12 me-2.5"
                        alt="Logo Dealkan - Solusi Properti Terpercaya di Surabaya" />

                    <!-- Vertical Line (visible on larger screens) -->
                    <span class="border-l border-gray-200 h-10 mx-3 hidden sm:block"></span>

                    <!-- Phrase (will stack vertically on mobile) -->
                    <span class="text-gray-600 font-bold text-xs sm:text-base md:text-3xl">
                        HOLD THE VISION AND MAKE IT HAPPEN #Dealkan #Dealzy
                    </span>
                </a> --}}
                <!-- Logo and Phrase -->
                <a href="{{ route('admin.home') }}" class="flex flex-col items-center sm:flex-row sm:items-center sm:justify-start w-full">
                    <!-- Logo Image -->
                    <img src="{{ asset('assets/images/logo/type_logo.png') }}" class="h-9 sm:h-9 me-2.5"
                        alt="Logo Dealkan - Solusi Properti Terpercaya di Surabaya" />

                    <!-- Vertical Line (visible on larger screens) -->
                    <span class="border-l border-gray-200 h-10 mx-3 hidden sm:block"></span>

                    <!-- Phrase (will stack below the image on mobile) -->
                    <span class="text-gray-600 font-bold text-xs sm:text-base md:text-3xl mt-2 sm:mt-0 text-center hidden sm:block">
                        HOLD THE VISION AND MAKE IT HAPPEN #Dealkan #Dealzy
                    </span>
                </a>

            </div>

            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="{{ asset('assets/' . Auth::user()->image) }}" alt="user ">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            {{-- name --}}
                            <p class="text-sm text-gray-900" role="none">
                                {{ Auth::user()->name ?? '' }}
                            </p>
                            {{-- email --}}
                            <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                {{Auth::user()->email ?? ''}}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{route('home', Auth::user()->id)}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Halaman Utama</a>
                            </li>
                            <li>
                                <a href="{{route('admin.home')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Dashboard</a>
                            </li>
                            <li>
                                <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block  text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                        Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

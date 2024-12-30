<nav id="navbar" class="fixed w-full z-30 top-0 start-0 transition-all duration-300">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <!-- Mobile Menu Button -->
        <button data-collapse-toggle="" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="" aria-expanded="false" onclick="toggleMobileMenu()">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('assets/images/logo/type_logo.png') }}" class="h-6 w-35"
                alt="Logo Dealkan - Solusi Properti Terpercaya di Surabaya">
        </a>

        <!-- Dropdown Header Button -->
        <div id="dropdownHeaderButton" class="hidden md:flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @if (Auth::check())
                <!-- Dropdown for authenticated user -->
                <button id="profileButton" onclick="toggleDropdown()"
                    class="bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-md shadow-lg hover:to-orange-500 focus:ring-4 focus:outline-none font-medium text-sm px-4 py-2.5 text-center inline-flex items-center">
                    <!-- User Icon -->
                    @if (Auth::user()->image)
                        <!-- Display user image if it exists -->
                        <img id="profile-picture-preview" src="{{ asset('assets/' . Auth::user()->image) }}"
                            alt="Profile Picture" class="h-5 w-5 mr-2 rounded-full object-cover shadow">
                    @else
                        <!-- Default SVG if no image is uploaded -->
                        <svg id="profile-picture-placeholder" class="h-5 w-5 mr-2 rounded-full shadow"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    @endif
                    <!-- Display name and dropdown arrow -->
                    {{ explode(' ', ucwords(Auth::user()->name))[0] }}
                    <svg class="w-2.5 h-2.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
            @else
                <!-- Login Button when not logged in -->
                <a href="{{ route('login.view') }}"
                    class="bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-md shadow-lg hover:to-orange-500  focus:ring-4 focus:outline-none font-medium text-sm px-4 py-2.5 text-center flex items-center">
                    <!-- User Icon -->
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    Login
                </a>
            @endif
            @if (Auth::check())
                <!-- Dropdown Menu -->
                <div id="dropdownInformation"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 absolute mt-12">
                    <div class="px-4 py-3 text-sm text-gray-900">
                        <div class="font-medium truncate">{{ Auth::user()->email ?? '' }}</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-900" aria-labelledby="profileButton">
                        @if (Auth::user()->role == 0)
                            <!-- Grouped Property Section -->
                            <li class="relative group">
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-orange-100 text-black flex items-center">
                                    Properti
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </a>
                                <!-- Nested Dropdown -->
                                <ul
                                    class="absolute top-0 right-full hidden mt-0 w-48 bg-white border border-orange-200 rounded-md shadow-lg group-hover:block">
                                    <li>
                                        <a href="{{ route('myListing.view', Auth::user()->id) }}"
                                            class="block px-4 py-2 hover:bg-orange-100 text-black">My Listing</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('listKonfirmasi.view', Auth::user()->id) }}"
                                            class="block px-4 py-2 hover:bg-orange-100 text-black">Listing Status </a>
                                    </li>
                                    <!-- Line Separator -->
                                    <hr class="border-gray-100 my-2">
                                    <li>
                                        <a href="{{ route('addPrimary.view') }}"
                                            class="block px-4 py-2 hover:bg-orange-100 text-black">Add Primary</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('add.view') }}"
                                            class="block px-4 py-2 hover:bg-orange-100 text-black">Add Secondary</a>
                                    </li>
                                </ul>
                            <li>
                                <a href="{{ route('BuyRequest.view', Auth::user()->id) }}"
                                    class="block px-4 py-2 hover:bg-orange-100 text-black">Buy Request</a>
                            </li>
                            <li>
                                <a href="{{ route('matchListing.view', Auth::user()->id) }}"
                                    class="block px-4 py-2 hover:bg-orange-100 text-black">Match Listing</a>
                            </li>
                            </li>

                            <!-- Line Separator -->
                            <hr class="border-orange-100 my-2">

                            <!-- Admin View -->
                            <li>
                                <a href="{{ route('admin.home', Auth::user()->role) }}"
                                    class="block px-4 py-2 hover:bg-orange-100 text-black">Dashboard</a>
                            </li>
                            <!-- Line Separator -->
                            <hr class="border-orange-100 my-2">

                            <!-- Account Settings -->
                            <li>
                                <a href="{{ route('user.profil', Auth::user()->id) }}"
                                    class="block px-4 py-2 hover:bg-orange-100 text-black">Akun Setting</a>
                            </li>
                        @else
                            <!-- Grouped Property Section -->
                            <li class="relative group">
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-orange-100 text-black flex items-center">
                                    Properti
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </a>
                                <!-- Nested Dropdown -->
                                <ul
                                    class="absolute top-0 right-full hidden mt-0 w-48 bg-white border border-orange-200 rounded-md shadow-lg group-hover:block">
                                    <li>
                                        <a href="{{ route('myListing.view', Auth::user()->id) }}"
                                            class="block px-4 py-2 hover:bg-orange-100 text-black">My Listing</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('listKonfirmasi.view', Auth::user()->id) }}"
                                            class="block px-4 py-2 hover:bg-orange-100 text-black">Listing Status </a>
                                    </li>
                                    <!-- Line Separator -->
                                    <hr class="border-gray-100 my-2">
                                    <li>
                                        <a href="{{ route('addPrimary.view') }}"
                                            class="block px-4 py-2 hover:bg-orange-100 text-black">Add Primary</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('add.view') }}"
                                            class="block px-4 py-2 hover:bg-orange-100 text-black">Add Secondary</a>
                                    </li>
                                </ul>
                            <li>
                                <a href="{{ route('BuyRequest.view', Auth::user()->id) }}"
                                    class="block px-4 py-2 hover:bg-orange-100 text-black">Buy Request</a>
                            </li>
                            <li>
                                <a href="{{ route('matchListing.view', Auth::user()->id) }}"
                                    class="block px-4 py-2 hover:bg-orange-100 text-black">Match Listing</a>
                            </li>
                            </li>

                            <!-- Line Separator -->
                            <hr class="border-orange-100 my-2">

                            <!-- Account Settings -->
                            <li>
                                <a href="{{ route('user.profil', Auth::user()->id) }}"
                                    class="block px-4 py-2 hover:bg-orange-100 text-black">Akun Setting</a>
                            </li>
                    </ul>
            @endif

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <div class="py-2">

                    <button type="submit"
                        class="block w-full text-left px-4 py-2 text-sm text-black hover:bg-gray-100">Keluar</button>
                </div>
            </form>
        </div>
        @endif
    </div>





    <!-- Navbar Links (Desktop) -->
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
        <ul
            class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:bg-transparent md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
            <li>
                <a href="{{ route('djual.show') }}"
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-hoverColor hover:underline md:hover:bg-transparent md:hover:text-hoverColor md:p-0 "
                    aria-current="page">Dijual</a>
            </li>
            <li>
                <a href="{{ route('dsewa.show') }}"
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-hoverColor hover:underline md:hover:bg-transparent md:hover:text-hoverColor md:p-0"
                    aria-current="page">Disewa</a>
            </li>
            <li>
                <a href="{{ route('pbaru.show') }}"
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-hoverColor hover:underline md:hover:bg-transparent md:hover:text-hoverColor md:p-0"
                    aria-current="page">Properti Baru</a>
            </li>
            <li>
                <a href="/kpr"
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-hoverColor hover:underline md:hover:bg-transparent md:hover:text-hoverColor md:p-0"
                    aria-current="page">KPR</a>
            </li>
            <li>
                <a href="/tentang"
                    class="block py-2 px-3 text-gray-900 rounded hover:bg-hoverColor hover:underline md:hover:bg-transparent md:hover:text-hoverColor md:p-0"
                    aria-current="page">Tentang Kami</a>
            </li>
            @if (Auth::check())
                <li class="md:hidden">
                    <button id="profileButton" onclick="toggleDropdown()"
                        class="bg-gradient-to-r w-full from-orange-400 to-orange-600 text-white rounded-md shadow-lg hover:to-orange-500 focus:ring-4 focus:outline-none font-medium text-sm px-4 py-2.5 text-center inline-flex items-center">
                        @if (Auth::user()->image)
                            <img id="profile-picture-preview" src="{{ asset('storage/' . Auth::user()->image) }}"
                                alt="Profile Picture" class="h-5 w-5 mr-2 rounded-full object-cover shadow">
                        @else
                            <svg id="profile-picture-placeholder" class="h-5 w-5 mr-2 rounded-full shadow"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        @endif
                        {{ explode(' ', ucwords(Auth::user()->name))[0] }}
                        <svg class="flex w-2.5 h-2.5 ms-2 text-right" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                </li>
            @else
                <li class="md:hidden">
                    <a href="{{ route('login.view') }}"
                        class="block py-2 px-3 text-gray-900 rounded hover:bg-hoverColor hover:underline">
                        Login
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <!-- Mobile Dropdown Popup -->
    <div id="mobileMenu" class="fixed top-0 left-0 w-64 bg-white h-full z-50 shadow-lg hidden">
        <div class="flex flex-col p-4 space-y-4 h-screen">
            <!-- Menu Title -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 text-center">Menu</h2>
                <hr class="mt-1 border-t border-gray-300">
            </div>

            @if (Auth::check())
                <ul class="flex flex-col">
                    <li>
                        <button class="text-gray-700 hover:bg-gray-100 rounded-sm w-full px-4 py-1 flex items-center"
                            aria-controls="profile-submenu" data-collapse-toggle="profile-submenu">
                            @if (Auth::user()->image)
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture"
                                    class="h-10 w-10 mr-2 rounded-full object-cover shadow">
                            @else
                                <svg class="h-12 w-12 mr-2 rounded-full shadow" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            @endif
                            <span class="ml-2 ">{{ explode(' ', ucwords(Auth::user()->name))[0] }}</span>
                            <svg class="w-5 h-5 text-gray-800 ml-auto" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        </button>
                        </svg>
                    </li>
                    <ul id="profile-submenu" class="hidden mx-2 border-b p-1 border-gray-300">
                        @if (Auth::user()->role == 0)
                            <li>
                                <a href="{{route('admin.home', auth::user()->role) }}"
                                    class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">Dashboard</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('user.profil', Auth::user()->id) }}"
                                class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">Akun Setting </a>
                        </li>
                    </ul>

                </ul>
            @endif

            <!-- Navigation Links -->
            <ul class="flex flex-col flex-1">
                @if (Auth::check())
                    <li class="hover:bg-gray-100 px-4 py-2 rounded w-full">
                        <button class="text-gray-900 flex justify-between items-center w-full" aria-controls="properti-submenu" data-collapse-toggle="properti-submenu">
                            <span>Properti</span>
                            <svg class="w-5 h-5 text-gray-900 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        </button>
                    </li>


                    <ul id="properti-submenu" class="hidden mx-2 border-b p-1 border-gray-300">
                        <li>
                            <a href="{{ route('djual.show') }}" class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">
                                Dijual
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dsewa.show') }}" class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">
                                Disewa
                            </a>
                        </li>
                        <li >
                            <a href="{{ route('pbaru.show') }}" class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">
                                Properti Baru
                            </a>
                        </li>
                        <!-- Line Separator -->
                        <hr class="border-gray-300 my-2">
                        <li>
                            <a href="{{ route('myListing.view', Auth::user()->id) }}"
                                class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">My Listing</a>
                        </li>
                        <li>
                            <a href="{{ route('listKonfirmasi.view', Auth::user()->id) }}"
                                class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">Listing Status </a>
                        </li>
                        <!-- Line Separator -->
                        <hr class="border-gray-300 my-2">
                        <li>
                            <a href="{{ route('addPrimary.view') }}"
                                class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">Add Primary</a>
                        </li>
                        <li>
                            <a href="{{ route('add.view') }}"
                                class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">Add Secondary</a>
                        </li>
                        <!-- Line Separator -->
                        <hr class="border-gray-300 my-2">
                        <li>
                            <a href="{{ route('BuyRequest.view', Auth::user()->id) }}"
                                class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">Buy Request</a>
                        </li>
                        <li>
                            <a href="{{ route('matchListing.view', Auth::user()->id) }}"
                                class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">Match Listing</a>
                        </li>
                    </ul>
                    <a href="/kpr" class="text-gray-900">
                        <li class="hover:bg-gray-100 px-4 py-2 rounded w-full">
                            KPR
                        </li>
                    </a>
                    <a href="/tentang" class="text-gray-900">
                        <li class="hover:bg-gray-100 px-4 py-2 rounded w-full">
                            Tentang Kami
                        </li>
                    </a>
                @else
                    <li>
                        <a href="{{ route('djual.show') }}" class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">
                            Dijual
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dsewa.show') }}" class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">
                            Disewa
                        </a>
                    </li>
                    <li >
                        <a href="{{ route('pbaru.show') }}" class="block px-4 p-1.5 hover:bg-gray-100 text-gray-900">
                            Properti Baru
                        </a>
                    </li>
                    <a href="/kpr" class="text-gray-900">
                        <li class="hover:bg-gray-100 px-4 py-2 rounded w-full">
                            KPR
                        </li>
                    </a>
                    <a href="/tentang" class="text-gray-900">
                        <li class="hover:bg-gray-100 px-4 py-2 rounded w-full">
                            Tentang Kami
                        </li>
                    </a>
                @endif
            </ul>

            <!-- Login Link at the Bottom -->
            <ul class="mt-auto">
                @if (Auth::check())
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <li
                            class="mt-auto text-center bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 rounded-md p-0">
                            <button type="submit"
                                class="text-white px-4 py-2 rounded w-full text-center">Logout</button>
                        </li>
                    </form>
                @else
                    <li
                        class="mt-auto text-center bg-gradient-to-r from-orange-400 to-orange-600 hover:to-orange-500 rounded-md p-1">
                        <a href="{{ route('login.view') }}"
                            class="text-white px-4 py-2 rounded w-full text-center">Login</a>
                    </li>
                @endif
            </ul>
        </div>

    </div>


</nav>

<!-- JavaScript to toggle dropdown -->
<script>
    // DESKTOP VERSION
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownInformation');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('dropdownInformation');
        const profileButton = document.getElementById('profileButton');
        if (!dropdown.contains(event.target) && !profileButton.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Function to toggle the mobile menu
    // function toggleMobileMenu() {
    //     var menu = document.getElementById('navbar-sticky');
    //     menu.classList.toggle('hidden');
    // }
    // MOBILE VERSION
    const mobileMenu = document.getElementById('mobileMenu');
    const toggleButton = document.querySelector('[data-collapse-toggle="mobileMenu"]');

    function toggleMobileMenu() {
        const isHidden = mobileMenu.classList.toggle('hidden'); // Toggle the menu visibility
        toggleButton.setAttribute('aria-expanded', !isHidden); // Update aria-expanded
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInside = mobileMenu.contains(event.target);
        const menuButton = event.target.closest('button[data-collapse-toggle]');

        if (!isClickInside && !menuButton && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            toggleButton.setAttribute('aria-expanded', 'false'); // Ensure aria-expanded is false
        } else {
            toggleButton.setAttribute('aria-expanded', 'true');
        }
    });

    // Add click event listener to the toggle button
    toggleButton.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent closing immediately on button click
        toggleMobileMenu();
    });


</script>

<a href="{{ $link }}" class="block group h-auto">
    <div
        class="max-w-sm mx-auto p-2 transition-transform transform group-hover:scale-105 flex flex-col justify-between h-full">
        <div class="relative">
            <img alt="{{ $title }} - Dealkan" src="{{ $image }}"
                class="h-56 w-full rounded-xl object-cover shadow-xl transition-opacity duration-700 ease-in-out opacity-0 group-hover:grayscale-[50%]"
                loading="lazy" decoding="async" width="320" height="224" onload="this.classList.remove('opacity-0')"
                fetchpriority="high" />
            <span
                class="absolute top-2 right-2 bg-gradient-to-r from-orange-400 to-orange-600 text-white text-base font-semibold px-3 py-1 rounded-md">
                {{ $status }}
            </span>
        </div>

        <div class="mt-4">
            <div class="flex justify-between items-center">
                <p class="text-orange-500 font-bold text-lg">RP. {{ $price }}</p>
                <p class="text-white font-medium px-2 py-1 bg-orange-600 rounded-md">{{ $type }}</p>
            </div>
            <h1 class="font-semibold text-base line-clamp-2 mt-4 text-left">{{ mb_strimwidth($title, 0, 35, '...') }}
            </h1>
        </div>

        <div class="flex items-center text-gray-700 text-base text-left mb-4">
            <svg class="w-6 h-6 text-gray-500 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24" aria-hidden="true">
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M12 2C8.1 2 5 5.1 5 9c0 4.9 7 13 7 13s7-8.1 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5s2.5 1.1 2.5 2.5S13.4 11.5 12 11.5z" />
            </svg> {{ $location }}
        </div>
        <hr>

        <div class="flex items-center space-x-4 mt-4 justify-between">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-800 dark:text-white mr-1" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <path
                        d="M32 32c17.7 0 32 14.3 32 32v256h224V160c0-17.7 14.3-32 32-32h224c53 0 96 43 96 96v224c0 17.7-14.3 32-32 32s-32-14.3-32-32v-32H64v32c0 17.7-14.3 32-32 32S0 493.7 0 480V64c0-17.7 14.3-32 32-32zm144 96a80 80 0 1 1 0 160 80 80 0 1 1 0-160z" />
                </svg>
                <span class="text-gray-600">
                    @if ($detailKMLain > 0)
                        {{ $detailKM }} + {{ $detailKMLain }}
                    @else
                        {{ $detailKM }}
                    @endif
                </span>
            </div>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-800 dark:text-white mr-1" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M96 77.3c0-7.3 5.9-13.3 13.3-13.3 3.5 0 6.9 1.4 9.4 3.9l14.9 14.9C130 91.8 128 101.7 128 112c0 19.9 7.2 38 19.2 52c-5.3 9.2-4 21.1 3.8 29c9.4 9.4 24.6 9.4 33.9 0L289 89c9.4-9.4 9.4-24.6 0-33.9c-7.9-7.9-19.8-9.1-29-3.8C246 39.2 227.9 32 208 32c-10.3 0-20.2 2-29.2 5.5L163.9 22.6C149.4 8.1 129.7 0 109.3 0C66.6 0 32 34.6 32 77.3V256H96V77.3zM32 352v16c0 28.4 12.4 54 32 71.6v40.4c0 17.7 14.3 32 32 32s32-14.3 32-32v-16h256v16c0 17.7 14.3 32 32 32s32-14.3 32-32v-40.4c19.6-17.6 32-43.1 32-71.6v-16H32z" />
                </svg>
                <span class="text-gray-600">
                    @if ($detailKTLain > 0)
                        {{ $detailKT }} + {{ $detailKTLain }}
                    @else
                        {{ $detailKT }}
                    @endif
                </span>
            </div>
            <div class="items-center">
                <p class="text-gray-600"><span class="font-extrabold">LT:</span> {{ $detailAreas }} m²</p>
            </div>
            <div class="items-center">
                <p class="text-gray-600"><span class="font-extrabold">LB:</span> {{ $buildingArea }} m²</p>
            </div>
        </div>
    </div>
</a>

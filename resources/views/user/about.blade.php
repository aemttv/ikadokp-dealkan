<x-layout title="About">

    <section class="relative min-h-screen flex items-center justify-center">
        <!-- Background Video -->
        <video autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-0">
            <source src="{{ asset('assets/videos/dealkan.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Overlay -->
        <div class="absolute top-0 left-0 w-full h-full bg-black opacity-30 z-10"></div>

        <div class="relative z-20 text-center mx-auto max-w-screen-xl">
            <div class="mx-auto max-w-xl">
                <img src="{{ asset('assets/images/logo/type_logo_white.png') }}"
                    alt="Logo Dealkan - Solusi Properti Terpercaya di Indonesia" class="h-24 w-240 object-contain">
            </div>
            <p class="mt-20 sm:text-xl text-white p-4 rounded">
                Agen properti di Surabaya dengan tim yang sebagian besar terdiri dari Gen Z. Kami menawarkan
                pendekatan segar dan inovatif untuk membantu Anda menemukan properti ideal dengan cepat dan mudah.
            </p>
        </div>
    </section>




    <div class="container mx-auto my-10 mb-20">
        <div class="flex flex-col md:flex-row md:p-10 items-center md:items-start">
            <!-- Video placeholder -->
            <iframe class="w-full md:w-2/3 h-64 md:h-96 rounded-lg"
                src="https://www.youtube.com/embed/mXD_xHUn6xc?autoplay=0&mute=1" title="About Dealkan" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>

            <!-- Text Section -->
            <div class="w-full md:w-2/3 md:pl-6 mt-20 md:mt-0 text-lg">
                <p class="text-gray-700 mb-4 p-4 ">
                    <span class="text-primary">PT. Lui Jaya Bersama,</span>
                    yang didirikan pada 09 Februari 2019 di Surabaya, adalah perusahaan yang bergerak di bidang
                    properti dan dikenal dengan nama Dealkan Property.
                </p>

                <p class="text-gray-700 p-4">
                    <span class="text-primary">Visi</span> Kami adalah mencetak miliarder melalui solusi properti yang
                    inovatif dan terpercaya. <br>
                    <span class="text-primary">Misi</span> Kami adalah memiliki 300 kantor lokal yang kuat, siap
                    memberikan layanan terbaik dan mendukung
                    masyarakat dalam mencapai tujuan investasi properti mereka.
                </p>
            </div>
        </div>
    </div>

    <div class="mx-auto px-3 lg:items-center">
        <div class="mx-auto max-w-2xl text-center">
            <h1 class="lg:text-5xl text-3xl font-extrabold">
                Mengapa Memilih Kami
            </h1>

            <p class="mt-4 sm:text-xl/relaxed">
                Kami adalah agen properti yang terpercaya, berkomitmen untuk membantu Anda menemukan properti impian.
            </p>


        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 p-10 md:p-20">
        <div>
            <div class=" w-20 h-20 rounded-full">
                <svg class="w-20 h-20" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 122.88 121.84">

                    <path class="cls-1 "
                        d="M46.39,70.56c-3.15-2.8-5.64-4.82-6.17-10.64h-.34a4.42,4.42,0,0,1-2.23-.58,6.13,6.13,0,0,1-2.46-3c-1.14-2.61-2-9.46.82-11.42l-.53-.36-.06-.76c-.11-1.38-.14-3-.17-4.8-.1-6.44-.23-14.26-5.42-15.82l-2.22-.67,1.46-1.82a84.53,84.53,0,0,1,13-13.17C47,3.6,52.12,1,57.08.23A18,18,0,0,1,71.7,4.32a27.47,27.47,0,0,1,3.92,3.93,16.63,16.63,0,0,1,11.7,6.84,23.76,23.76,0,0,1,3.81,7.69,26.15,26.15,0,0,1,1,8.72,20.93,20.93,0,0,1-6.07,14.13,4.3,4.3,0,0,1,1.89.48c2.16,1.16,2.23,3.67,1.66,5.78-.56,1.75-1.27,3.8-1.94,5.51-.82,2.32-2,2.75-4.32,2.5-.12,5.72-2.77,7.3-6.33,10.66.15,8.62-30.84,7.61-30.65,0Zm-1.61,7.11L54,104.31l4.63-15.63L56.37,86.2c-1.71-2.5-1.12-5.33,2-5.84a21.61,21.61,0,0,1,3.43-.07,18.84,18.84,0,0,1,3.77.14c2.94.65,3.25,3.5,1.78,5.77l-2.27,2.48,4.63,15.63L78.1,77.67c6,5.41,27.21,6.5,33.84,10.2,9.18,5.14,8.93,24.78,10.94,34H0c2-9.11,1.79-28.91,10.94-34,8.15-4.54,27.17-4.19,33.84-10.2Z" />
                </svg>
            </div>
            <h1 class="font-bold text-xl mt-8">Agen Profesional</h1>
            <p>Agen kami terdiri dari individu yang berpengalaman dan terlatih, siap memberikan bimbingan yang tepat
                untuk membantu Anda membuat keputusan terbaik dalam investasi properti.</p>
        </div>

        <div>
            <div class=" w-20 h-20 rounded-full">
                <svg class="w-20 h-20" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 122.88 112.13">

                    <path
                        d="M36,72.55a1.44,1.44,0,1,1-2.88,0V35.4H2.88v71.08h5v2.88H1.44A1.44,1.44,0,0,1,0,107.92V34.63a2.15,2.15,0,0,1,.62-1.5,2.12,2.12,0,0,1,1.5-.62h31v-30A2.49,2.49,0,0,1,33.86.75h0A2.52,2.52,0,0,1,35.65,0H87a2.52,2.52,0,0,1,1.79.74l.11.12a2.55,2.55,0,0,1,.64,1.67v30h31.22a2.11,2.11,0,0,1,1.49.62h0a2.11,2.11,0,0,1,.62,1.49v73.29a1.44,1.44,0,0,1-1.44,1.44H112.3v-2.88H120V35.4H89.53V72.13a1.44,1.44,0,0,1-2.88,0V2.88H36V72.55ZM42.38,12.7H51a.26.26,0,0,1,.25.24v8.59a.26.26,0,0,1-.25.24H42.38a.23.23,0,0,1-.23-.24V12.94a.23.23,0,0,1,.23-.24Zm29.26,0h8.58a.24.24,0,0,1,.24.24v8.59a.24.24,0,0,1-.24.24H71.87a.25.25,0,0,1-.25-.24V12.94a.25.25,0,0,1,.25-.24h-.23Zm-14.77,0h8.58a.24.24,0,0,1,.24.24v8.59a.24.24,0,0,1-.24.24H56.87a.25.25,0,0,1-.24-.24V12.94a.25.25,0,0,1,.24-.24Zm40,57.58h16.38v5.06H96.91V70.28Zm-87.44,0H25.85v5.06H9.47V70.28Zm84,31.05a50,50,0,0,1,8.12,3.64c3.11,1.94,4,4.21,4.39,7.16h-20V108c2.79.36,8.14-1.28,7.53-6.66ZM26.08,102c1.48,4.35,7.73,4.6,9.14,0a4.59,4.59,0,0,0,1.34.77,11.66,11.66,0,0,0-.51,1.25,15.18,15.18,0,0,0-.75,3.77h0a.34.34,0,0,1,0,.1L35,112.13H14.8l.27-2.73a6.22,6.22,0,0,1,1.13-3.32,4.84,4.84,0,0,1,1.51-1.28c1.82-1,6.72-1.34,8.37-2.83ZM24.84,91.42a1.33,1.33,0,0,0-.57.16.47.47,0,0,0-.17.2.86.86,0,0,0-.06.34,3.23,3.23,0,0,0,.66,1.59h0L26.12,96A12.16,12.16,0,0,0,28,98.45a3.85,3.85,0,0,0,2.65,1.07,3.93,3.93,0,0,0,2.81-1.11,12.5,12.5,0,0,0,1.94-2.65L37,93.14c.32-.73.42-1.17.32-1.38s-.33-.16-.76-.13a1.26,1.26,0,0,1-.87-.15l.79-2.38a12.4,12.4,0,0,1-7.26-2c-.77-.49-1-1.06-1.78-1a2.61,2.61,0,0,0-1.47.8,3.66,3.66,0,0,0-.84,1.66l.47,2.86a.8.8,0,0,1-.75.06Zm12.61-.71a1.19,1.19,0,0,1,.75.6,2.76,2.76,0,0,1-.3,2.23h0l0,.06-1.61,2.65a13.15,13.15,0,0,1-2.11,2.86,4.86,4.86,0,0,1-3.48,1.38,4.71,4.71,0,0,1-3.31-1.33,12.46,12.46,0,0,1-2.05-2.68L23.9,94.23a4.22,4.22,0,0,1-.82-2.1,1.65,1.65,0,0,1,.15-.78,1.43,1.43,0,0,1,.52-.6,1.42,1.42,0,0,1,.39-.19,34.5,34.5,0,0,1-.06-4,5.94,5.94,0,0,1,.17-.92,5.39,5.39,0,0,1,2.39-3A7,7,0,0,1,27.93,82c2.72-1,6.32-.45,8.25,1.64a5.44,5.44,0,0,1,1.38,3.47l-.11,3.58Zm14.23-10a1.85,1.85,0,0,0-.74.23.69.69,0,0,0-.25.29,1.28,1.28,0,0,0-.09.5,5,5,0,0,0,1,2.37v0h0l2.11,3.36a17.85,17.85,0,0,0,2.81,3.7,5.63,5.63,0,0,0,4,1.59,5.82,5.82,0,0,0,4.18-1.66,18.3,18.3,0,0,0,2.89-4l2.37-3.9c.48-1.09.62-1.75.47-2s-.51-.25-1.21-.18H69a2.27,2.27,0,0,1-1-.23l1.07-3.56c-7.22-.09-13.33-5-15.69-2.43-.56.6-1,.48-1.26,1.54l.75,4.31a1.46,1.46,0,0,1-1.24,0Zm2,15.73c2.89,8.49,11.12,8.23,13.65,0,1.48,1.32,4.34,2,7,2.69,6.47,1.63,8,3.57,8.62,10.3.07.78.15,1.66.23,2.66H37.81l.35-4.58a9.18,9.18,0,0,1,1.69-5,7.12,7.12,0,0,1,2.26-1.91c2.71-1.53,9.06-2,11.53-4.2Zm17-16.8a1.73,1.73,0,0,1,1.12.9c.36.73.22,1.8-.45,3.33h0l0,.09-2.41,4a19.52,19.52,0,0,1-3.15,4.26,7.22,7.22,0,0,1-5.19,2.06,7.05,7.05,0,0,1-4.95-2,19.07,19.07,0,0,1-3.07-4l-2.11-3.36a6.26,6.26,0,0,1-1.22-3.14,2.56,2.56,0,0,1,.22-1.16,2.18,2.18,0,0,1,.78-.9,2.62,2.62,0,0,1,.58-.29,54.84,54.84,0,0,1-.09-5.89,8.26,8.26,0,0,1,.26-1.37,8,8,0,0,1,3.57-4.54,9.21,9.21,0,0,1,1.92-.93c4.05-1.47,9.43-.67,12.31,2.45a8.22,8.22,0,0,1,2.07,5.17l-.15,5.34ZM77.93,98l1.86,0,1.55,0c-1.8-5.55-1.2-10.65,3.14-15a9.72,9.72,0,0,0,5.2,5.8,27.5,27.5,0,0,1,3.9,3.59c.22-.92-.63-2-1.66-3.18a5,5,0,0,1,2.45,2.4,6.65,6.65,0,0,1,.47,4.31,8.86,8.86,0,0,1-.55,2.07h2.57c2.71-5.8,1-14.41-4.55-18.06-1.7-1.12-2.92-1.08-4.92-1.08-2.28,0-3.45.07-5.41,1.37-2.88,1.91-4.66,5.21-5.4,9.79-.15,2.29-.25,6.24,1.35,8.07ZM97.15,58.27h15.9c.13,0,.24.08.24.18v4.7c0,.1-.11.18-.24.18H97.15c-.13,0-.24-.08-.24-.18v-4.7c0-.1.11-.18.24-.18Zm0-12.17h15.9c.13,0,.24.08.24.18V51c0,.1-.11.18-.24.18H97.15c-.13,0-.24-.08-.24-.18v-4.7c0-.1.11-.18.24-.18ZM9.71,58.27h15.9c.13,0,.24.08.24.18v4.7c0,.1-.11.18-.24.18H9.71c-.13,0-.24-.08-.24-.18v-4.7c0-.1.11-.18.24-.18Zm0-12.17h15.9c.13,0,.24.08.24.18V51c0,.1-.11.18-.24.18H9.71c-.13,0-.24-.08-.24-.18v-4.7c0-.1.11-.18.24-.18Zm62,4.87h8.49a.24.24,0,0,1,.24.24V59.7a.24.24,0,0,1-.24.24H71.67a.24.24,0,0,1-.24-.24V51.21a.24.24,0,0,1,.24-.24ZM57.08,51h8.49a.24.24,0,0,1,.24.24V59.7a.24.24,0,0,1-.24.24H57.08a.24.24,0,0,1-.24-.24V51.21a.24.24,0,0,1,.24-.24ZM42.49,51H51a.24.24,0,0,1,.24.24V59.7a.24.24,0,0,1-.24.24H42.49a.24.24,0,0,1-.24-.24V51.21a.24.24,0,0,1,.24-.24ZM71.67,30.72h8.49a.24.24,0,0,1,.24.24v8.49a.24.24,0,0,1-.24.24H71.67a.24.24,0,0,1-.24-.24V31a.24.24,0,0,1,.24-.24Zm-14.59,0h8.49a.24.24,0,0,1,.24.24v8.49a.24.24,0,0,1-.24.24H57.08a.24.24,0,0,1-.24-.24V31a.24.24,0,0,1,.24-.24Zm-14.59,0H51a.24.24,0,0,1,.24.24v8.49a.24.24,0,0,1-.24.24H42.49a.24.24,0,0,1-.24-.24V31a.24.24,0,0,1,.24-.24Z" />
                </svg>
            </div>
            <h1 class="font-bold text-xl mt-8">Variasi Properti</h1>
            <p>Kami menawarkan pilihan properti yang beragam, mulai dari rumah tinggal hingga komersial, memastikan Anda
                menemukan opsi yang sesuai dengan kebutuhan dan gaya hidup Anda.</p>
        </div>

        <div>
            <div class="w-20 h-20 rounded-full">
                <svg class="w-20 h-20" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 116.42 122.88"
                    style="enable-background:new 0 0 116.42 122.88" xml:space="preserve">
                    <style type="text/css">
                        .st0 {
                            fill-rule: evenodd;
                            clip-rule: evenodd;
                        }

                        .st1 {
                            fill-rule: evenodd;
                            clip-rule: evenodd;
                            fill: #3AAF3C;
                        }
                    </style>
                    <g>
                        <path class="st0"
                            d="M5.95,112.26c-5.1-0.39-6.33-4.06-5.86-8.29c2.79-24.96,30.78-17.73,42.03-27.86l0,0c5.61,16.5,29.05,17.11,34.31,0c1.21,1.09,2.89,2.01,4.87,2.82c-1.81,1.1-3.52,2.43-5.09,4c-7.93,7.92-9.88,19.57-5.86,29.33H5.95 L5.95,112.26z M41.97,59.56c2.13,3.37,4.36,6.83,7.12,9.37c2.66,2.43,5.9,4.09,10.16,4.1c4.64,0.01,8.01-1.7,10.76-4.28 c2.86-2.67,5.11-6.34,7.34-10l5.98-9.84c1.11-2.55,1.52-4.25,1.26-5.25c-0.16-0.59-0.81-0.88-1.92-0.93 c-0.23-0.01-0.48-0.01-0.72-0.01c-0.26,0.01-0.54,0.03-0.84,0.05c-0.17,0.01-0.31,0-0.46-0.03c-0.52,0.03-1.08-0.01-1.63-0.09 l2.04-9.06c-15.19,2.39-26.55-8.88-42.59-2.25l1.16,10.67c-0.63,0.04-1.25,0.01-1.82-0.07C28.6,42.24,40.16,56.67,41.97,59.56 L41.97,59.56L41.97,59.56L41.97,59.56z M84.74,40.01c1.47,0.45,2.41,1.38,2.8,2.89c0.43,1.67-0.04,4.03-1.46,7.25l0,0c-0.03,0.06-0.05,0.12-0.09,0.17l-6.04,9.95c-2.33,3.84-4.69,7.69-7.85,10.63c-3.26,3.06-7.3,5.1-12.81,5.08 c-5.14-0.01-9.02-1.97-12.2-4.89c-3.84-3.52-21.52-25.66-13.62-30.99c0.39-0.25,0.82-0.48,1.28-0.65 c-0.35-4.58-0.47-10.34-0.25-15.17c0.12-1.14,0.34-2.28,0.65-3.43c1.35-4.85,4.76-8.75,8.96-11.43c2.32-1.48,4.87-2.59,7.51-3.33 c1.68-0.48-1.43-5.87,0.3-6.03c8.41-0.87,22.05,6.82,27.93,13.19c2.93,3.18,4.8,7.41,5.2,13L84.74,40.01L84.74,40.01L84.74,40.01 L84.74,40.01L84.74,40.01L84.74,40.01z" />
                        <path class="st1"
                            d="M95.32,80.66c11.66,0,21.11,9.45,21.11,21.11c0,11.66-9.45,21.11-21.11,21.11c-11.66,0-21.11-9.45-21.11-21.11 C74.21,90.11,83.66,80.66,95.32,80.66L95.32,80.66L95.32,80.66L95.32,80.66z M87.77,100.17c1.58,0.91,2.61,1.67,3.83,3.02 c3.17-5.11,6.62-7.94,11.1-11.97l0.44-0.17h4.91c-6.58,7.3-11.68,13.33-16.24,22.13c-2.38-5.08-4.5-8.59-9.23-11.84L87.77,100.17 L87.77,100.17L87.77,100.17z" />
                    </g>
                </svg>
            </div>


            <h1 class="font-bold text-xl mt-8">Kepuasan Pelanggan</h1>
            <p>Fokus kami adalah pada kepuasan klien. Kami berusaha untuk memahami kebutuhan Anda dan memberikan layanan
                yang melebihi ekspektasi, menjadikan setiap transaksi sebagai pengalaman yang positif.</p>
        </div>
    </div>


    <section class="bg-gradient-to-r from-orange-400 to-orange-600">
        <div class="p-4 lg:p-20">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                <div>
                    <h1 class="font-bold text-xl text-center md:text-start">Pastikan Anda Memilih Agen Properti yang
                        Tepat untuk Masa
                        Depan Anda!
                    </h1>
                    <div class="flex space-x-4 mt-10 hidden md:flex">
                        <!-- Tiktok Icon -->
                        <a href="https://www.tiktok.com/@dealkan.id" rel="noreferrer" target="_blank"
                            class="flex items-center justify-center w-16 h-16 bg-white rounded-full transition duration-300 hover:bg-[#69c9ef]">
                            <span class="sr-only">TikTok</span>
                            <svg class="w-8 h-8 text-black transition-colors duration-300 hover:text-white"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5">
                                    <path
                                        d="M2.5 12c0-4.478 0-6.718 1.391-8.109S7.521 2.5 12 2.5c4.478 0 6.718 0 8.109 1.391S21.5 7.521 21.5 12c0 4.478 0 6.718-1.391 8.109S16.479 21.5 12 21.5c-4.478 0-6.718 0-8.109-1.391S2.5 16.479 2.5 12" />
                                    <path
                                        d="M10.536 11.008c-.82-.116-2.69.075-3.606 1.77s.007 3.459.584 4.129c.569.627 2.378 1.814 4.297.655c.476-.287 1.069-.502 1.741-2.747l-.078-8.834c-.13.973.945 3.255 4.004 3.525" />
                                </g>
                            </svg>
                        </a>


                        <!-- Instagram Icon -->
                        <a href="https://www.instagram.com/dealkan.id/" rel="noreferrer" target="_blank"
                            class="flex items-center justify-center w-16 h-16 bg-white rounded-full transition duration-300 hover:bg-[#e1306c]">
                            <span class="sr-only">Instagram</span>
                            <svg fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"
                                class="w-8 h-8 text-black transition-colors duration-300 hover:text-white">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>



                        <!-- Whatsapp Icon -->
                        <a href="https://wa.me/62895396588567?text=Halo%20Dealkan%20saya%20tertarik%20dengan%20seputar%20properti%20di%20daerah%20Surabaya"
                            rel="noreferrer" target="_blank"
                            class="flex items-center justify-center w-16 h-16 bg-white rounded-full transition duration-300 hover:bg-[#25D366]">
                            <span class="sr-only">WhatsApp</span>
                            <svg class="w-8 h-8 text-black transition-colors duration-300 hover:text-white"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.13-1.48-.73-1.71-.82c-.23-.1-.4-.12-.56.13c-.16.25-.64.82-.79.99c-.14.16-.29.18-.54.06c-.25-.13-1.04-.38-1.98-1.23c-.73-.65-1.23-1.44-1.38-1.68c-.14-.25-.01-.38.12-.51c.13-.13.25-.3.38-.45c.13-.16.17-.25.25-.42c.08-.17.04-.31-.02-.43c-.06-.12-.56-1.35-.77-1.84c-.2-.48-.41-.42-.56-.43c-.14-.01-.31-.02-.48-.02c-.17 0-.44.06-.67.31c-.23.25-.88.86-.88 2.1s.9 2.43 1.03 2.6c.13.16 1.77 2.7 4.29 3.78c.6.26 1.07.41 1.44.52c.6.19 1.15.16 1.58.1c.48-.07 1.48-.6 1.69-1.18c.21-.58.21-1.08.14-1.18c-.06-.1-.23-.16-.48-.28" />
                            </svg>
                        </a>

                    </div>
                </div>
                {{-- BUTTON Hubungi Kami --}}
                <div class="mx-auto my-auto">
                    <a href="https://wa.me/62895396588567?text=Halo%20Dealkan%20saya%20tertarik%20dengan%20seputar%20properti%20di%20daerah%20Surabaya"
                        target="_blank"
                        class="relative z-10 bg-white text-black font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out hover:scale-105">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>


</x-layout>

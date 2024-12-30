<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="{{ asset('assets/images/dealkan-favicon/favicon-48x48.png') }}"
        sizes="48x48" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/dealkan-favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/images/dealkan-favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/images/dealkan-favicon/apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="Dealkan" />
    <link rel="manifest" href="{{ asset('assets/images/dealkan-favicon/site.webmanifest') }}" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <!-- Primary Meta Tags -->
    <title>Dealkan Property </title>
    <meta name="title" content="Dealkan Property " />
    <meta name="description"
        content="Dealkan Properti adalah platform terpercaya untuk jual beli properti di Kota Surabaya. Temukan properti impian Anda, mulai dari rumah, tanah, apartemen, villa, ruko, hingga gudang, dengan harga yang bersaing. Bergabunglah dengan kami dan temukan hunian ideal Anda di Dealkan!" />

    <!-- Open Graph / Instagram -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://dealkan.id/" />
    <meta property="og:title" content="Dealkan - Platform Jual Beli Properti Unggulan" />
    <meta property="og:description"
        content="Dealkan menawarkan ribuan properti seperti rumah dan apartemen dengan harga bersaing. Hubungi kami di Instagram atau TikTok untuk detail lebih lanjut." />
    <meta property="og:image" content="{{ asset('assets/images/logo/type_logo.png') }}" />
    <meta property="og:image:alt" content="Dealkan - Jual Beli Properti" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://metatags.io/" />
    <meta property="twitter:title" content="Dealkan Property" />
    <meta property="twitter:description"
        content="Platform jual beli properti unggulan. Temukan ribuan listing rumah, tanah, apartemen, villa, ruko, dan gudang dengan harga bersaing hanya di Dealkan." />
    <meta property="twitter:image" content="{{ asset('assets/images/logo/type_logo.png') }}" />

    <!-- Meta Tags Generated with https://metatags.io -->
    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- CSS --}}
    @yield('css')

    {{-- Vite JS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/navbar.js', 'resources/js/home/konfirmasi.js'])

    {{-- preload --}}
    <link rel="preload" href="{{ asset('assets/images/hero.png') }}" as="image">
</head>

<body class="flex flex-col min-h-screen bg-background font-poppins overflow-x-hidden">
    <!-- Header -->
    <Header>
        <x-navbar :showBackground="true"></x-navbar>
    </Header>

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer></x-footer>

    {{-- script --}}
    @once
        @yield('scripts')
    @endonce

</body>

</html>

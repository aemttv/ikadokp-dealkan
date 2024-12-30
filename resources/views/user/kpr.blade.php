<x-layout title="kpr">

    <section class="relative E0E0E0 h-[70vh] md:h-[80vh]">
        <img src="{{ asset('assets/images/Banners/bank_partner.webp') }}" alt="Hero SVG"
            class="absolute top-0 left-0 w-full h-full object-cover z-[-10]">
    </section>


    <x-kpr class="h-[50vh]"></x-kpr>

    {{-- Hubungi Kami Section START --}}
    <x-hubungi></x-hubungi>
    {{-- Hubungi Kami Section END --}}

    {{-- scripts --}}
    @section('scripts')
        @vite('resources/js/kpr-simulation.js')
    @endsection
</x-layout>

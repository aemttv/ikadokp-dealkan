import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/navbar.js',
                'resources/js/kpr-simulation.js',
                'resources/js/property-detail.js',
                'resources/js/filter.js',
                'resources/js/home/home.js',
                'resources/js/home/primary.js',
                'resources/js/home/secondary.js',
                'resources/js/home/strategic.js',
                'resources/js/home/konfirmasi.js',
                'resources/js/home/tolak.js',
            ],
            refresh: true,
        }),
    ],
});

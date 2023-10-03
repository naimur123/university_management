import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/administrator/app.js',
                'resources/css/administrator/app.css',
            ],
            refresh: true,
        }),
    ],
});

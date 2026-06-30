import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        // host: '0.0.0.0',
        // hmr: {
        //     host: 'da29-138-84-65-181.ngrok-free.app' || 'localhost',
        // }
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/style.css',
                'resources/js/script.js',
                'resources/js/registrationFE.js',
                'resources/css/modal.css'
            ],
            refresh: true,
        }),
    ],
});

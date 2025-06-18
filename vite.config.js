import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { svelte } from '@sveltejs/vite-plugin-svelte';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            env: {
                VITE_HCAPTCHA_SITE_KEY: process.env.VITE_HCAPTCHA_SITE_KEY,
            },
        }),
        svelte(),
        tailwindcss(),
        {
            name: 'alias-plugin',
            enforce: 'pre',
            config: () => ({
                resolve: {
                    alias: {
                        '@': '/resources'
                    }
                }
            })
        }
    ],
    // Keine spezifische define-Eigenschaft mehr nötig, da Vite Variablen mit VITE_ Präfix automatisch bereitstellt
});

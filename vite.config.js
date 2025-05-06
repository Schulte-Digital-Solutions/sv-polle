import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { svelte } from '@sveltejs/vite-plugin-svelte';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
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
    define: {
        'import.meta.env.VITE_HCAPTCHA_SITE_KEY': JSON.stringify(process.env.HCAPTCHA_SITE_KEY)
    }
});

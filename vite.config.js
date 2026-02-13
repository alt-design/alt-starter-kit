import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
// Statamic 6: use Statamic's Vite plugin for Control Panel (Vue 3). Uncomment when building CP assets:
// import statamic from '@statamic/cms/vite-plugin';

export default defineConfig({
    plugins: [
        // Statamic 6: add statamic() before laravel() when building CP assets.
        laravel({
            input: [
                'resources/css/site.css',
                'resources/js/site.js',
                // Control Panel (Statamic 6 / Vue 3): uncomment to build CP JS:
                // 'resources/css/cp.css',
                // 'resources/js/cp.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});

import { createInertiaApp } from '@inertiajs/svelte';
import { mount } from 'svelte';

createInertiaApp({
    resolve: name => {
        console.log(`Resolving page: ${name}`);
        const pages = import.meta.glob('./Pages/**/*.svelte', { eager: true });
        const page = pages[`./Pages/${name}.svelte`];
        if (!page) {
            console.error(`Page not found: ${name}`);
        }
        return page;
    },
    setup({ el, App, props }) {
        mount(App, { target: el, props });
    },
});

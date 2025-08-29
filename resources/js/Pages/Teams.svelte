<script>
    import AppLayout from "../Layout/AppLayout.svelte";
    import Seo from "../Components/Seo.svelte";
    import { CookieConsent } from '../Stores/CookieConsentStore';
    import ContentBlocker from '../Components/ContentBlocker.svelte';

    export let teams;
</script>

<Seo
    title="Mannschaften - SV Polle"
    description="Übersicht aller Fußballmannschaften des SV Polle"
/>

<AppLayout>
    <div class="mx-auto max-w-[970px] py-12">
        <h1 class="text-3xl font-bold mb-8 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">Unsere Mannschaften</h1>

        <div class:hidden={!$CookieConsent.services?.fupa}>
            {#each Object.entries(teams) as [name, id]}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100 px-4 sm:px-6 lg:px-8">{name}</h2>
                    <div class="relative w-full mx-auto px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900">
                        <div id="fp-widget_root-{id}" class="w-full min-h-[284px] relative">
                            <a class="absolute bottom-[8px] left-[16px] text-xs underline text-gray-400" href="https://www.fupa.net/club/sv-polle" target="_blank" rel="noopener">SV Polle auf FuPa</a>
                        </div>
                    </div>
                </div>
            {/each}
        </div>
        {#if !$CookieConsent.services?.fupa}
            <div class="m-4">
                <ContentBlocker serviceId="fupa"/>
            </div>
        {/if}

        <div class="mb-8 px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Jugend Mannschaften</h2>
            <div class="relative w-full mx-auto">
                <p class="text-gray-700 dark:text-gray-300 text-sm mb-4">
                    Die Jugendmannschaften werden nicht online geführt.
                </p>
                <p class="text-gray-700 dark:text-gray-300 text-sm mb-4">
                    Bei Interesse wenden Sie sich bitte an den Verein unter
                    <a href="mailto:info@svpolle.de" class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">
                        info@svpolle.de
                    </a>.
                </p>
            </div>
        </div>
    </div>
</AppLayout>

<svelte:head>
    <script src="https://widget-api.fupa.net/vendor/widget.js?v1"></script>
</svelte:head>

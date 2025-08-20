<script>
    import AppLayout from "../Layout/AppLayout.svelte";
    import Seo from "../Components/Seo.svelte";

    export let teams;
</script>

<Seo
    title="Mannschaften - SV Polle"
    description="Übersicht aller Fußballmannschaften des SV Polle"
/>

<AppLayout>
    <div class="mx-auto max-w-[970px] py-12">
        <h1 class="text-3xl font-bold mb-8 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">Unsere Mannschaften</h1>

        {#each Object.entries(teams) as [name, id]}
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100 px-4 sm:px-6 lg:px-8">{name}</h2>
                <div class="relative w-full mx-auto px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900">
                    <div id="fp-widget_root-{id}" class="w-full">
                        <a href="https://www.fupa.net/club/sv-polle" target="_blank" rel="noopener" class="text-gray-900 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-300">
                            SV Polle auf FuPa
                        </a>
                    </div>
                </div>
            </div>
        {/each}

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

<style>
    /* Stellen Sie sicher, dass die FuPa-Widgets sich korrekt anpassen */
    :global([id^="fp-widget_root-"]) {
        width: 100% !important;
        height: auto !important;
        min-height: 200px;
        display: block;
    }

    /* Wrapper für responsive Anpassung */
    :global(.fp-widget) {
        width: 100% !important;
        max-width: 970px !important;
        margin: 0 auto;
    }
</style>

<svelte:head>
    <script src="https://widget-api.fupa.net/vendor/widget.js?v1"></script>
</svelte:head>

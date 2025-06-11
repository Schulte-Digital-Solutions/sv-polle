<script>
    import { page } from '@inertiajs/svelte';
    import { cookieConsent, legalPages } from '../Stores/CookieConsentStore';
    import { onMount } from 'svelte';

    let settings = {
        necessary: true,
        functional: false,
        analytics: false,
        marketing: false
    };

    $: currentPath = ($page.url.split('?')[0] + '/').replace('//', '/');
    $: isLegalPage = legalPages.includes(currentPath);

    function saveSettings() {
        cookieConsent.setConsent(settings);
    }

    function acceptAll() {
        settings = {
            necessary: true,
            functional: true,
            analytics: true,
            marketing: true
        };
        saveSettings();
    }

    function acceptNecessary() {
        settings = {
            necessary: true,
            functional: false,
            analytics: false,
            marketing: false
        };
        saveSettings();
    }

    function toggleFunctional() {
        settings.functional = !settings.functional;
    }

    function toggleAnalytics() {
        settings.analytics = !settings.analytics;
    }

    function toggleMarketing() {
        settings.marketing = !settings.marketing;
    }

    onMount(() => {
        // Stille Initialisierung
    });

    // Variable zum Verfolgen des Initialisierungsstatus
    let initialized = false;

    // Wenn gespeicherte Einstellungen existieren, diese nur einmal beim Laden laden
    $: if ($cookieConsent && $cookieConsent.date && !initialized) {
        settings = {
            ...settings,
            ...$cookieConsent
        };
        initialized = true;
    }
</script>

{#if ($cookieConsent.showBanner || !localStorage.getItem('cookie-consent')) && !isLegalPage}
<div class="fixed inset-0 bg-gray-500/75 dark:bg-gray-950/75 z-50 overflow-y-auto" aria-labelledby="cookie-banner-title" role="dialog" aria-modal="true">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-900 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl sm:p-6">
            <div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 dark:text-gray-100" id="cookie-banner-title">
                        Cookie-Einstellungen
                    </h3>
                    <div class="mt-4">
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            Wir verwenden Cookies, um Ihnen die bestmögliche Erfahrung auf unserer Website zu bieten.
                            Sie können selbst entscheiden, welche Kategorien Sie zulassen möchten.
                        </p>
                    </div>
                </div>
            </div>

            {#if $cookieConsent.showDetails}
                <div class="mt-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Notwendige Cookies</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Diese Cookies sind für die Grundfunktionen der Website erforderlich.</p>
                        </div>
                        <button
                            type="button"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-not-allowed rounded-full border-2 border-transparent bg-sv-green transition-colors duration-200 ease-in-out"
                            disabled
                            aria-pressed="true"
                        >
                            <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                        </button>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Funktionale Cookies</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Diese Cookies ermöglichen erweiterte Funktionen und Personalisierung.</p>
                        </div>
                        <button
                            type="button"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-sv-green focus:ring-offset-2"
                            class:bg-sv-green={settings.functional}
                            class:bg-gray-200={!settings.functional}
                            class:dark:bg-gray-700={!settings.functional}
                            aria-pressed={settings.functional}
                            on:click={toggleFunctional}
                        >
                            <span
                                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                class:translate-x-5={settings.functional}
                                class:translate-x-0={!settings.functional}
                            ></span>
                        </button>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Analyse-Cookies</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Diese Cookies helfen uns, die Nutzung der Website zu verstehen und zu verbessern.</p>
                        </div>
                        <button
                            type="button"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-sv-green focus:ring-offset-2"
                            class:bg-sv-green={settings.analytics}
                            class:bg-gray-200={!settings.analytics}
                            class:dark:bg-gray-700={!settings.analytics}
                            aria-pressed={settings.analytics}
                            on:click={toggleAnalytics}
                        >
                            <span
                                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                class:translate-x-5={settings.analytics}
                                class:translate-x-0={!settings.analytics}
                            ></span>
                        </button>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Marketing-Cookies</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Diese Cookies werden verwendet, um Werbung für Sie relevanter zu gestalten.</p>
                        </div>
                        <button
                            type="button"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-sv-green focus:ring-offset-2"
                            class:bg-sv-green={settings.marketing}
                            class:bg-gray-200={!settings.marketing}
                            class:dark:bg-gray-700={!settings.marketing}
                            aria-pressed={settings.marketing}
                            on:click={toggleMarketing}
                        >
                            <span
                                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                class:translate-x-5={settings.marketing}
                                class:translate-x-0={!settings.marketing}
                            ></span>
                        </button>
                    </div>
                </div>
            {/if}

            <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                <button
                    type="button"
                    class="inline-flex justify-center rounded-md bg-sv-green px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sv-green/90 dark:bg-sv-green/90 dark:hover:bg-sv-green/80"
                    on:click={acceptAll}
                >
                    Alle akzeptieren
                </button>
                {#if !$cookieConsent.showDetails}
                    <button
                        type="button"
                        class="inline-flex justify-center rounded-md bg-gray-100 dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-700"
                        on:click={() => cookieConsent.update(state => ({ ...state, showDetails: true }))}
                    >
                        Einstellungen anpassen
                    </button>
                {:else}
                    <button
                        type="button"
                        class="inline-flex justify-center rounded-md bg-gray-100 dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-700"
                        on:click={saveSettings}
                    >
                        Auswahl speichern
                    </button>
                {/if}
                <button
                    type="button"
                    class="inline-flex justify-center rounded-md bg-gray-100 dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-700"
                    on:click={acceptNecessary}
                >
                    Nur notwendige
                </button>
            </div>

            <div class="mt-4 text-center">
                <a
                    href="/datenschutz"
                    class="text-xs text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                >
                    Mehr erfahren in unserer Datenschutzerklärung
                </a>
            </div>
        </div>
    </div>
</div>
{/if}

<script>
    import { page } from '@inertiajs/svelte';
    import { CookieConsent, legalPages } from '../Stores/CookieConsentStore';
    import { consentCategories, servicesByCategory } from '../Stores/CookieServices';
    import { onMount } from 'svelte';

    let settings = {
        necessary: true,
        services: {}
    };

    $: currentPath = ($page.url.split('?')[0] + '/').replace('//', '/');
    $: isLegalPage = legalPages.includes(currentPath);

    function saveSettings() {
        CookieConsent.setConsent(settings);
    }

    function acceptAll() {
        const allServices = Object.fromEntries(
            Object.values(servicesByCategory)
                .flat()
                .map(id => [id, true])
        );
        settings = {
            necessary: true,
            functional: true,
            analytics: true,
            marketing: true,
            services: { ...allServices }
        };
        saveSettings();
    }

    function acceptNecessary() {
        const allServicesOff = Object.fromEntries(
            Object.values(servicesByCategory)
                .flat()
                .map(id => [id, false])
        );
        settings = {
            necessary: true,
            functional: false,
            analytics: false,
            marketing: false,
            services: { ...allServicesOff }
        };
        saveSettings();
    }

    // Kategorie-Toggles werden durch toggleCategory (alle Services) gehandhabt

    onMount(() => {
        // Stille Initialisierung
    });

    // Variable zum Verfolgen des Initialisierungsstatus
    let initialized = false;

    // Wenn gespeicherte Einstellungen existieren, diese nur einmal beim Laden laden
    $: if ($CookieConsent && $CookieConsent.date && !initialized) {
        settings = {
            ...settings,
            ...$CookieConsent,
            services: { ...($CookieConsent.services || {}) }
        };
        initialized = true;
    }

    function toggleService(serviceId) {
        settings = {
            ...settings,
            services: {
                ...settings.services,
                [serviceId]: !settings.services?.[serviceId]
            }
        };
    }

    function toggleCategory(catKey) {
        const ids = servicesByCategory[catKey] || [];
        if (ids.length === 0) {
            return;
        }
        const allOn = ids.every(id => !!settings.services?.[id]);
        const nextVal = !allOn;
        const next = { ...(settings.services || {}) };
        ids.forEach(id => { next[id] = nextVal; });
        settings = {
            ...settings,
            [catKey]: nextVal, // UI Sync; Store berechnet final aus services
            services: next
        };
    }

    function areAllOn(catKey) {
        const ids = servicesByCategory[catKey] || [];
        return ids.length > 0 && ids.every(id => !!settings.services?.[id]);
    }

    // Accordion Offen/Zu pro Kategorie
    let expanded = {};
    function toggleExpanded(catKey) {
        expanded = { ...expanded, [catKey]: !expanded[catKey] };
    }
</script>

{#if ($CookieConsent.showBanner || !localStorage.getItem('cookie-consent')) && !isLegalPage}
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

            {#if $CookieConsent.showDetails}
                <div class="mt-6 space-y-6">
                    <!-- Notwendig -->
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
                            aria-label="Notwendige Cookies - immer aktiviert"
                        >
                            <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                        </button>
                    </div>

                    <!-- Dynamische Kategorien mit Services -->
                    {#each consentCategories.filter(c => c.key !== 'necessary' && c.services.length > 0) as cat}
                        <div class="rounded-md border border-gray-200 dark:border-gray-800 p-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">{cat.label}</h4>
                                    {#if cat.description}
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{cat.description}</p>
                                    {/if}
                                </div>
                                {#if cat.services.length > 1}
                                    <button
                                        type="button"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-sv-green focus:ring-offset-2"
                                        class:bg-sv-green={areAllOn(cat.key)}
                                        class:bg-gray-200={!areAllOn(cat.key)}
                                        class:dark:bg-gray-700={!areAllOn(cat.key)}
                                        aria-pressed={areAllOn(cat.key)}
                                        aria-label="{cat.label} {areAllOn(cat.key) ? 'deaktivieren' : 'aktivieren'}"
                                        on:click={() => toggleCategory(cat.key)}
                                    >
                                        <span
                                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                            class:translate-x-5={areAllOn(cat.key)}
                                            class:translate-x-0={!areAllOn(cat.key)}
                                        ></span>
                                    </button>
                                {/if}
                            </div>

                            <!-- Accordion Toggle -->
                            <div class="mt-2">
                                <button
                                    type="button"
                                    class="inline-flex items-center gap-1 text-xs text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors"
                                    aria-expanded={!!expanded[cat.key]}
                                    aria-controls={`consent-cat-${cat.key}`}
                                    on:click={() => toggleExpanded(cat.key)}
                                >
                                    <svg class="h-4 w-4 transition-transform duration-200 ease-in-out" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style={`transform: rotate(${expanded[cat.key] ? 180 : 0}deg);`}>
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{expanded[cat.key] ? 'Weniger' : 'Mehr'}</span>
                                </button>
                            </div>

                            {#if expanded[cat.key]}
                                <div id={`consent-cat-${cat.key}`} class="mt-3 space-y-2">
                                    {#each cat.services as svc}
                                        <div class="flex items-center justify-between">
                                            <div class="pr-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100">{svc.label}</div>
                                                {#if svc.description}
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                                        {svc.description}
                                                        {#if svc.policyUrl}
                                                            <a class="ml-1 underline hover:no-underline" href={svc.policyUrl} target="_blank" rel="noopener noreferrer">Datenschutz</a>
                                                        {/if}
                                                    </div>
                                                {/if}
                                            </div>
                                            <button
                                                type="button"
                                                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-sv-green focus:ring-offset-2"
                                                class:bg-sv-green={!!settings.services?.[svc.id]}
                                                class:bg-gray-200={!settings.services?.[svc.id]}
                                                class:dark:bg-gray-700={!settings.services?.[svc.id]}
                                                aria-pressed={!!settings.services?.[svc.id]}
                                                aria-label="{svc.label} {settings.services?.[svc.id] ? 'deaktivieren' : 'aktivieren'}"
                                                on:click={() => toggleService(svc.id)}
                                            >
                                                <span
                                                    class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                                    class:translate-x-5={!!settings.services?.[svc.id]}
                                                    class:translate-x-0={!settings.services?.[svc.id]}
                                                ></span>
                                            </button>
                                        </div>
                                    {/each}
                                </div>
                            {/if}
                        </div>
                    {/each}
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
                {#if !$CookieConsent.showDetails}
                    <button
                        type="button"
                        class="inline-flex justify-center rounded-md bg-gray-100 dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-700"
                        on:click={() => CookieConsent.update(state => ({ ...state, showDetails: true }))}
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

<script>
    import AppLayout from "../Layout/AppLayout.svelte";
    import HeroSection from "../Components/HeroSection.svelte";
    import backgroundImage from "../../images/background_primary.jpg";
    import backgroundSecondary from "../../images/backgound_secondary.jpg";
    import Seo from "../Components/Seo.svelte";
    import { cookieConsent } from '../Stores/CookieConsentStore';
    import CookieSettingsButton from "../Components/CookieSettingsButton.svelte";
    import HCaptcha from '../Components/HCaptcha.svelte';
    import { page, useForm } from '@inertiajs/svelte';
    import { onMount } from 'svelte';

    // Kontaktformular-Daten
    const form = useForm({
        name: '',
        email: '',
        message: '',
        privacy: '0'
    });

    // FuPa Teams (IDs vom Nutzer)
    const teams = {
        '1. Herren': '31XthVh5IBEpAwSkyZlJwF33KtV',
        '2. Herren': '31XtvdzCksOXQF5aLfGkSnpmgKM',
        'Frauen': '31Xu2Ho6i670stqlPoRONAUs42G',
    };

    // Formular absenden
    function submitForm() {
        if ($form.privacy === true) {
            $form.privacy = '1';
        }

        $form.post('/kontakt', {
            onSuccess: () => {
                $form.reset();
            }
        });
    }

    function parseTime(str) {
        // Erwartet z.B. "19:30" oder "9:00"
        const m = str.match(/(\d{1,2}):(\d{2})/);
        if (!m) return null;
        const now = new Date();
        const h = parseInt(m[1], 10);
        const min = parseInt(m[2], 10);
        const d = new Date(now.getFullYear(), now.getMonth(), now.getDate(), h, min);
        // Wenn Uhrzeit < jetzt, aber noch heute, dann ist es vergangen
        return d;
    }

    function filterFupaWidget(widgetId) {
        const root = document.getElementById(widgetId);
        if (!root) return;
        const blocks = Array.from(root.querySelectorAll('.fp-team-matches-view-match-row-wrapper'));
        if (!blocks.length) return;

        // Finde alle Uhrzeiten
        const now = new Date();
        let splitIdx = -1;
        for (let i = 0; i < blocks.length; i++) {
            const timeNode = blocks[i].querySelector('.fp-team-matches-view-match-status');
            if (!timeNode) continue;
            const t = parseTime(timeNode.textContent);
            if (t && t > now) {
                splitIdx = i;
                break;
            }
        }
        // Zeige nur: Block vor splitIdx (letztes vergangenes), und die zwei nach splitIdx (nächste 2)
        blocks.forEach((el, i) => {
            if ((splitIdx === -1 && i > 0) || (splitIdx > 0 && !(i === splitIdx-1 || i === splitIdx || i === splitIdx+1))) {
                el.style.setProperty('display', 'none', 'important');
            } else {
                el.style.setProperty('display', '', 'important');
            }
        });

        const monthBlocks = Array.from(root.querySelectorAll('.fp-team-matches-view-month-block'));
        monthBlocks.forEach((mb) => {
            const children = Array.from(mb.querySelectorAll('.fp-team-matches-view-match-row-wrapper'));
            const hasVisible = children.some((c) => getComputedStyle(c).display !== 'none');
            mb.style.setProperty('padding-bottom', hasVisible ? '1rem' : '0', 'important');
        });
        root.style.setProperty('display', 'block', 'important');
    }

    onMount(() => {
        for (const [, id] of Object.entries(teams)) {
            const widgetId = `fp-widget_root-${id}`;
            const root = document.getElementById(widgetId);
            if (!root) continue;
            // Observer bleibt dauerhaft aktiv und filtert bei jeder Mutation
            const observer = new MutationObserver(() => {
                filterFupaWidget(widgetId);
            });
            observer.observe(root, { childList: true, subtree: true });
            // Initial versuchen zu filtern (falls schon geladen)
            filterFupaWidget(widgetId);
        }
    });
</script>
<Seo
    title="SV Polle"
    description="SV Polle – 3 Orte ein Verein! Gemeinsamer Sportverein der Orte Andrup, Lage und Lotten. Besonders im Fußball und Dart aktiv."
    keywords="SV Polle, Sportverein, Fußball, Dart, Haselünne"
    author="SV Polle Team"
    ogImage={backgroundImage}
    ogUrl="https://svpolle.de"
    twitterCard="summary_large_image"
    jsonLd={{
        "@context": "https://schema.org",
        "@type": "SportsOrganization",
        "name": "SV Polle",
        "legalName": "Sportverein Polle e. V.",
        "sport": "Football, Darts",
        "foundingDate": "1988",
        "email": "info@svpolle.de",
        "url": "https://svpolle.de",
        "logo": "https://svpolle.de/images/SVPolleLogo.png",
        "sameAs": [
            "https://www.instagram.com/sv_polle",
            "https://www.fupa.net/club/sv-polle"
        ],
    "description": "Der SV Polle – 3 Orte ein Verein! Ein gemeinsamer Sportverein der Orte Andrup, Lage und Lotten. Besonders im Fußball und Dart aktiv.",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Schützenstraße 8",
            "addressLocality": "Haselünne",
            "postalCode": "49740",
            "addressCountry": "DE"
        },
    }}
/>
<AppLayout>
    <!-- Toast-Benachrichtigung für Erfolg -->
    {#if $page.props.flash?.success}
    <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 animate-[toastInOut_5s_forwards] motion-reduce:animate-none">
            {$page.props.flash.success}
        </div>
    {/if}
    <HeroSection title="Willkommen beim SV Polle" subtitle="3 Orte ein Verein!" image={backgroundImage} />

    <!-- Nächste Spiele (3 Spalten) -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Spielübersicht</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {#each Object.entries(teams) as [name, id]}
                <div class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-3 text-gray-900 dark:text-gray-100">{name}</h3>
                    <div class="relative w-full">
                        <div id="fp-widget_root-{id}" class="w-full" style="display: none;"></div>
                        {#if !$cookieConsent.functional}
                            <div class="w-full h-full flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-700 p-4 rounded">
                                <p class="text-center text-gray-700 dark:text-gray-300 mb-3 text-sm">
                                    Aus Datenschutzgründen wird das FuPa-Widget erst angezeigt, wenn Sie der Verwendung von funktionalen Cookies zugestimmt haben.
                                </p>
                                <CookieSettingsButton buttonStyle="inline-flex justify-center rounded-md bg-sv-green px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sv-green/90 dark:hover:bg-sv-green/80">
                                    Cookie-Einstellungen anpassen
                                </CookieSettingsButton>
                            </div>
                        {/if}
                    </div>
                </div>
            {/each}
        </div>
    </div>

    <!-- Vereinsbeschreibung -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Über unseren Verein</h2>
            <div class="text-lg text-gray-700 dark:text-gray-300 space-y-4">
                <p><span class="font-semibold text-sv-green">3 Orte ein Verein!</span><br> Der SV Polle ist ein gemeinsamer Sportverein der Orte Andrup, Lage und Lotten in der Gemeinschaft Haselünne.</p>
                <p>Gegründet im Jahr 1988, bieten wir heute ein vielfältiges Sportangebot mit Schwerpunkt auf Fußball und Dart.</p>
                <p>Unser Verein zeichnet sich durch Gemeinschaftssinn, sportliches Engagement und eine familiäre Atmosphäre aus.</p>
            </div>
        </div>
    </div>

    <!-- Parallax-Bereich mit Kontakt und Anfahrt -->
    <div class="relative bg-fixed bg-center bg-no-repeat bg-cover py-16" style="background-image: url({backgroundSecondary});">
        <div class="absolute inset-0 bg-black/60 z-0"></div>
        <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Hauptinformationen -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Kontaktdaten -->
                <div id="kontakt" class="bg-gray-50/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-lg shadow-xl p-6">
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Kontakt</h2>
                    <div class="space-y-6 h-full">
                        <!-- Kontaktformular -->
                        <form on:submit|preventDefault={submitForm} class="space-y-4">
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                    <input type="text" id="name" bind:value={$form.name} required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-sv-green focus:ring-sv-green dark:focus:ring-sv-green/80 dark:bg-gray-700 dark:text-gray-200">
                                    {#if $form.errors.name}
                                        <div class="text-red-500 text-sm mt-1">{$form.errors.name}</div>
                                    {/if}
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">E-Mail</label>
                                    <input type="email" id="email" bind:value={$form.email} required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-sv-green focus:ring-sv-green dark:focus:ring-sv-green/80 dark:bg-gray-700 dark:text-gray-200">
                                    {#if $form.errors.email}
                                        <div class="text-red-500 text-sm mt-1">{$form.errors.email}</div>
                                    {/if}
                                </div>
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nachricht</label>
                                    <textarea id="message" bind:value={$form.message} rows="4" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-sv-green focus:ring-sv-green dark:focus:ring-sv-green/80 dark:bg-gray-700 dark:text-gray-200"></textarea>
                                    {#if $form.errors.message}
                                        <div class="text-red-500 text-sm mt-1">{$form.errors.message}</div>
                                    {/if}
                                </div>
                                {#if $cookieConsent.functional}
                                    <HCaptcha />
                                {:else}
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-700 p-4">
                                        <p class="text-center text-gray-700 dark:text-gray-300 mb-4">
                                            Aus Datenschutzgründen wird HCaptcha erst funktionieren, wenn Sie der Verwendung von funktionalen Cookies zugestimmt haben.
                                        </p>
                                        <CookieSettingsButton buttonStyle="inline-flex justify-center rounded-md bg-sv-green px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sv-green/90 dark:hover:bg-sv-green/80">
                                            Cookie-Einstellungen anpassen
                                        </CookieSettingsButton>
                                    </div>
                                {/if}
                                <div class="flex items-start">
                                    <input
                                        type="checkbox"
                                        id="privacy"
                                        checked={$form.privacy === '1' || $form.privacy === true}
                                        on:change={(e) => $form.privacy = e.target.checked ? '1' : '0'}
                                        required
                                        class="h-4 w-4 text-sv-green border-gray-300 rounded focus:ring-sv-green dark:focus:ring-sv-green/80 dark:bg-gray-700"
                                    >
                                    <label for="privacy" class="ml-2 text-sm text-gray-600 dark:text-gray-400">Ich habe die <a href="/datenschutz" class="text-sv-green hover:underline">Datenschutzerklärung</a> gelesen und akzeptiere sie.</label>
                                </div>
                                {#if $form.errors.privacy}
                                    <div class="text-red-500 text-sm mt-1">{$form.errors.privacy}</div>
                                {/if}
                                <button type="submit" class="w-full bg-sv-green hover:bg-sv-green/90 text-white font-semibold py-2 px-4 rounded-md shadow-sm transition-colors duration-200" disabled={$form.processing}>
                                    {$form.processing ? 'Wird gesendet...' : 'Absenden'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Anfahrt -->
                <div id="anfahrt" class="bg-gray-50/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-lg shadow-xl p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Anfahrt</h2>
                    <div class="grid grid-cols-1 gap-8">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-gray-500 dark:text-gray-400 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-gray-900 dark:text-gray-100">Schützenstraße 8, 49740 Haselünne</span>
                        </div>
                        <div class="w-full h-60 rounded-lg overflow-hidden shadow-lg">
                            {#if $cookieConsent.functional}
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2420.513541153882!2d7.506662776815526!3d52.650701226544406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b79dc4a92fd1f5%3A0x38b4b88bbcfccb49!2sSV%20Polle%20e.V.!5e0!3m2!1sde!2sde!4v1749665251448!5m2!1sde!2sde"
                                    width="100%"
                                    height="100%"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Google Maps Anfahrt zum SV Polle"
                                ></iframe>
                            {:else}
                                <div class="w-full h-full flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-700 p-4">
                                    <p class="text-center text-gray-700 dark:text-gray-300 mb-4">
                                        Aus Datenschutzgründen wird Google Maps erst angezeigt, wenn Sie der Verwendung von funktionalen Cookies zugestimmt haben.
                                    </p>
                                    <CookieSettingsButton buttonStyle="inline-flex justify-center rounded-md bg-sv-green px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sv-green/90 dark:hover:bg-sv-green/80">
                                        Cookie-Einstellungen anpassen
                                    </CookieSettingsButton>
                                </div>
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</AppLayout>

<svelte:head>
    {#if $cookieConsent.functional}
        <script src="https://widget-api.fupa.net/vendor/widget.js?v1" defer></script>
    {/if}
</svelte:head>

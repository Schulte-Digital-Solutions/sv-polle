<script>
    import { cookieConsent } from '../Stores/CookieConsentStore';
    export let buttonStyle = ""; // Zusätzliche Klassen für unterschiedliche Stile

    function openSettings() {
        cookieConsent.showSettings();
    }
</script>

<button
    type="button"
    class="text-gray-900 dark:text-gray-100 hover:text-sv-green dark:hover:text-sv-green/90 {buttonStyle}"
    on:click={openSettings}
>
    <slot>Cookie-Einstellungen</slot>
</button>

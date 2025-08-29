<script>
    import { CookieConsent } from '../Stores/CookieConsentStore';
    export let buttonStyle = ""; // Zusätzliche Klassen für unterschiedliche Stile

    $: classes = (buttonStyle && buttonStyle.trim().length > 0)
        ? buttonStyle
        : 'bg-sv-green hover:bg-sv-green/90 text-white font-semibold py-2 px-4 rounded-md shadow-sm transition-colors duration-200';

    function openSettings() {
        CookieConsent.showSettings();
    }
</script>

<button
    type="button"
    class={classes}
    on:click={openSettings}
>
    <slot>Cookie-Einstellungen</slot>
</button>

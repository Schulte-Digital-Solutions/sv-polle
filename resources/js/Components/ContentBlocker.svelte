<script>
    import CookieSettingsButton from './CookieSettingsButton.svelte';
    import { servicesMap } from '../Stores/CookieServices';

    export let serviceId;
    export let className = '';
    export let innerClass = '';
    
    $: serviceLabel = servicesMap[serviceId]?.label || 'Externer Dienst';
    const defaultBlockedText = 'Dieser Inhalt ist aus Datenschutzgründen blockiert.';
    function getBlockedText(id) {
        const svc = servicesMap[id];
        return svc?.description || defaultBlockedText;
    }
</script>

<div class={`w-full h-full flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-700 p-4 rounded ${className}`}>
    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-1">{serviceLabel}</h3>
    <p class="text-center text-gray-500 dark:text-gray-400 mb-2 text-xs">Dieser Bereich enthält Inhalte eines externen Dienstes und wurde aus Datenschutzgründen blockiert.</p>
    <p class="text-center text-gray-700 dark:text-gray-300 mb-3 text-sm">{getBlockedText(serviceId)}</p>
    <CookieSettingsButton buttonStyle="inline-flex justify-center rounded-md bg-sv-green px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sv-green/90 dark:hover:bg-sv-green/80">
        Cookie-Einstellungen anpassen
    </CookieSettingsButton>
    {#if $$slots.default}
        <div class={innerClass}>
            <slot />
        </div>
    {/if}
    <slot name="footer" />
</div>

<style>
/* keine */
</style>

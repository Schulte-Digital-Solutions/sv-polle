<script>
    import { onMount } from 'svelte';
    import { page } from '@inertiajs/svelte';
    import { cookieConsent, legalPages } from '../Stores/CookieConsentStore';

    export let onVerify = () => {};
    export let onExpire = () => {};
    export let onError = () => {};

    let captchaContainer;
    let widgetId;

    $: isLegalPage = legalPages.includes($page.url.pathname);
    $: shouldShowCaptcha = !isLegalPage && $cookieConsent.necessary;

    onMount(() => {
        if (!shouldShowCaptcha) return;

        if (window.hcaptcha) {
            initCaptcha();
        } else {
            const script = document.createElement('script');
            script.src = 'https://js.hcaptcha.com/1/api.js?render=explicit';
            script.async = true;
            script.defer = true;
            script.onload = initCaptcha;
            document.head.appendChild(script);
        }

        return () => {
            if (widgetId) {
                window.hcaptcha?.reset(widgetId);
                window.hcaptcha?.remove(widgetId);
            }
        };
    });

    function initCaptcha() {
        if (!captchaContainer) return;

        widgetId = window.hcaptcha.render(captchaContainer, {
            sitekey: import.meta.env.VITE_HCAPTCHA_SITE_KEY,
            theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light',
            callback: onVerify,
            'expired-callback': onExpire,
            'error-callback': onError
        });
    }
</script>

{#if shouldShowCaptcha}
    <div bind:this={captchaContainer} class="h-captcha inline-block"></div>
{/if}

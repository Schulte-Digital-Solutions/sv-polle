<script>
    import Header from "../Components/Header.svelte";
    import Footer from "../Components/Footer.svelte";
    import CookieBanner from "../Components/CookieBanner.svelte";
    import { onMount } from "svelte";
    import { initSmoothScroll } from "../Utils/smoothScroll.js";

    const navigationItems = [
        { href: "/", text: "Startseite" },
        { href: "/fussball/", text: "Fußball-Teams" },
        { href: "/dart/", text: "Dart-Teams" },
        { href: "/#kontakt", text: "Kontakt" },
        { href: "https://team.jako.com/de-de/team/sv_polle/", text: "Online-Shop", external: true },
    ];

    const footerItems = [
        { href: "datenschutz", text: "Datenschutz" },
        { href: "impressum", text: "Impressum" },
    ];

    onMount(() => {
        initSmoothScroll();
    });
</script>

<div class="min-h-screen bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex flex-col">
    <Header {navigationItems} {footerItems} />
    <main class="min-h-[calc(100vh-8rem)]">
        <slot />
    </main>
    <Footer {footerItems} />
    <CookieBanner />
</div>

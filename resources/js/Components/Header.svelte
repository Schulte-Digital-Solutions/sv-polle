<script>
    import logo from "@/images/SV-Polle.png";
    import { onMount } from "svelte";

    let mobileMenu = false;
    let isScrolled = false;

    const toggleMobileMenu = () => {
        mobileMenu = !mobileMenu;
    };

    const handleScroll = () => {
        isScrolled = window.scrollY > 0; // Wenn die Scrollposition größer als 0 ist, wird `isScrolled` true
    };

    // Event-Listener für Scroll hinzufügen
    onMount(() => {
        window.addEventListener("scroll", handleScroll);
        return () => {
            window.removeEventListener("scroll", handleScroll);
        };
    });

    // Reaktives Statement: Scrollen deaktivieren, wenn mobileMenu geöffnet ist
    $: {
        if (mobileMenu) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = "";
        }
    }
</script>

<div class="h-20"></div>
<header
    class="bg-gray-900 fixed top-0 inset-x-0 z-50 transition-all duration-300"
    style="height: {isScrolled ? '5rem' : '7rem'}"
>
    <nav
        class="mx-auto flex max-w-7xl items-center justify-between transition-all duration-300 px-4"
        style="height: {isScrolled ? '5rem' : '7rem'}"
        aria-label="Global"
    >
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">SV Polle</span>
                <img
                    class="w-auto transition-all duration-300"
                    style="height: {isScrolled ? '3rem' : '5rem'}"
                    src={logo}
                    alt="Vereinslogo"
                />
            </a>
        </div>
        <div class="flex lg:hidden">
            <button
                type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400"
                on:click={toggleMobileMenu}
                aria-expanded={mobileMenu}
            >
                <span class="sr-only">Open main menu</span>
                <svg
                    class="size-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                    />
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="#" class="text-sm/6 font-semibold text-white">Product</a>
            <a href="#" class="text-sm/6 font-semibold text-white">Features</a>
            <a href="#" class="text-sm/6 font-semibold text-white"
                >Marketplace</a
            >
            <a href="#" class="text-sm/6 font-semibold text-white">Company</a>
        </div>
    </nav>
    {#if mobileMenu}
        <!-- Mobile menu, show/hide based on menu open state. -->
        <div class="lg:hidden" role="dialog" aria-modal="true">
            <!-- Background backdrop, show/hide based on slide-over state. -->
            <div
                class="fixed inset-0 z-10 bg-gray-800/80"
                on:click={toggleMobileMenu}
            ></div>
            <div
                class="fixed inset-y-0 right-0 z-10 w-full bg-gray-900 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-white/10"
            >
                <div class="flex items-center justify-between flex-row-reverse">
                    <button
                        type="button"
                        class="-m-2.5 rounded-md p-2.5 text-gray-400"
                        on:click={toggleMobileMenu}
                    >
                        <span class="sr-only">Close menu</span>
                        <svg
                            class="size-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18 18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root overflow-y-auto">
                    <div class="-my-6 divide-y divide-gray-500/25">
                        <div class="space-y-2 py-6">
                            <a
                                href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800"
                                >Product</a
                            >
                            <a
                                href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800"
                                >Features</a
                            >
                            <a
                                href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800"
                                >Marketplace</a
                            >
                            <a
                                href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800"
                                >Company</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {/if}
</header>

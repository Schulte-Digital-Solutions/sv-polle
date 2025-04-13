<script>
    import logo from "@/images/SV-Polle.png";
    import { onMount } from "svelte";
    import { theme } from "@/js/Stores/ThemeStore.js";

    let mobileMenu = false;
    let isScrolled = false;

    const toggleMobileMenu = () => {
        mobileMenu = !mobileMenu;
    };

    let currentTheme;
    theme.subscribe((value) => (currentTheme = value));

    const toggleTheme = () => {
        theme.setTheme(currentTheme === "dark" ? "light" : "dark");
    };

    const navigationItems = [
        { href: "#", text: "Product" },
        { href: "#", text: "Features" },
        { href: "#", text: "Marketplace" },
        { href: "#", text: "Company" },
    ];

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
        <div class="flex items-center pr-6">
            <button type="button" class="text-gray-400" on:click={toggleTheme}>
                <span class="sr-only">Toggle theme</span>
                {#if currentTheme === "dark"}
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3v1.5M12 19.5V21M4.22 4.22l1.06 1.06M18.72 18.72l1.06 1.06M3 12h1.5M19.5 12H21M4.22 19.78l1.06-1.06M18.72 5.28l1.06-1.06M12 7.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9z"
                        />
                    </svg>
                {:else}
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21.752 15.002A9.718 9.718 0 0112 21.75 9.75 9.75 0 1112 2.25a9.718 9.718 0 019.752 7.502A6 6 0 0015 12a6 6 0 006.752 3.002z"
                        />
                    </svg>
                {/if}
            </button>
            <div class="lg:hidden">
                <button
                    type="button"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400"
                    on:click={toggleMobileMenu}
                >
                    <span class="sr-only">Open main menu</span>
                    <svg
                        class="size-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                        data-slot="icon"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                        />
                    </svg>
                </button>
            </div>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            {#each navigationItems as item}
                <a href={item.href} class="text-sm/6 font-semibold text-white"
                    >{item.text}</a
                >
            {/each}
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
                class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-gray-900 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-white/10"
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
                            data-slot="icon"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18 18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/25">
                        <div class="space-y-2 py-6">
                            {#each navigationItems as item}
                                <a
                                    href={item.href}
                                    class="text-sm/6 font-semibold text-white"
                                    >{item.text}</a
                                >
                            {/each}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {/if}
</header>

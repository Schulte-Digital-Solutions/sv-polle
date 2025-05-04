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
        { href: "/", text: "Startseite" },
        { href: "teams", text: "Mannschaften" },
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
    class="bg-white dark:bg-gray-900 shadow-xl shadow-gray900/30 dark:shadow-gray-950/30 fixed top-0 inset-x-0 z-50 transition-all duration-300"
    style="height: {isScrolled ? '5rem' : '7rem'}"
>
    <nav
        class="mx-auto flex max-w-7xl items-center justify-between transition-all duration-300 px-8 sm:px-16"
        style="height: {isScrolled ? '5rem' : '7rem'}"
        aria-label="Global"
    >
        <div class="flex lg:flex-1" role="presentation">
            <a href="/" class="-m-1.5 p-1.5" aria-label="Zur Startseite">
                <span class="sr-only">SV Polle</span>
                <img
                    class="w-auto transition-all duration-300"
                    style="height: {isScrolled ? '3rem' : '5rem'}"
                    src={logo}
                    alt="Vereinslogo"
                />
            </a>
        </div>
        <div class="flex items-center lg:hidden">
            <button
                type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 dark:text-gray-400"
                on:click={toggleMobileMenu}
                aria-expanded={mobileMenu}
                aria-controls="mobile-menu"
                aria-label="Hauptmenü öffnen"
            >
                <span class="sr-only">Öffnen Hauptmenü</span>
                <svg
                    class="size-10"
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
        <div class="hidden lg:flex lg:gap-x-12">
            <ul role="list" class="flex gap-x-12">
                {#each navigationItems as item}
                    <li role="none">
                        <a
                            href={item.href}
                            class="text-sm/6 font-semibold text-black dark:text-gray-100"
                            aria-current={item.href === '/' ? 'page' : undefined}
                        >{item.text}</a>
                    </li>
                {/each}
            </ul>
            <button
                type="button"
                class="text-gray-400 hover:text-gray-300 transition-colors duration-200"
                on:click={toggleTheme}
            >
                <span class="sr-only">Design umschalten</span>
                {#if currentTheme === "dark"}
                    <svg
                        class="size-8"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="none"
                        aria-hidden="true"
                    >
                        <path
                            d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1-8.313-12.454z"
                        />
                    </svg>
                {:else}
                    <svg
                        class="size-8"
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
                {/if}
            </button>
        </div>
    </nav>
    {#if mobileMenu}
        <div
            class="lg:hidden"
            role="dialog"
            aria-modal="true"
            aria-labelledby="mobile-menu-title"
        >
            <div
                class="fixed inset-0 z-10 bg-gray-500/75 dark:bg-gray-950/75"
                on:click={toggleMobileMenu}
                role="presentation"
                aria-hidden="true"
            ></div>
            <div
                class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white dark:bg-gray-900 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10 dark:sm:ring-gray-100/10"
                role="document"
            >
                <h2 id="mobile-menu-title" class="sr-only">Hauptmenü</h2>
                <div class="flex items-center justify-between flex-row-reverse" role="toolbar">
                    <button
                        type="button"
                        class="-m-2.5 rounded-md p-2.5 text-gray-700 dark:text-gray-400"
                        on:click={toggleMobileMenu}
                        aria-expanded={mobileMenu}
                        aria-controls="mobile-menu"
                        aria-label="Hauptmenü schließen"
                    >
                        <span class="sr-only">Close menu</span>
                        <svg
                            class="size-10"
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
                    <div class="-my-6 divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="space-y-2 py-6">
                            <ul role="list">
                                {#each navigationItems as item}
                                    <li role="none">
                                        <a
                                            href={item.href}
                                            class="text-xl font-semibold text-gray-900 dark:text-gray-100 block py-2"
                                            aria-current={item.href === '/' ? 'page' : undefined}
                                        >{item.text}</a>
                                    </li>
                                {/each}
                            </ul>
                        </div>
                        <div class="py-6">
                            <button
                                type="button"
                                class="flex w-full items-center justify-between text-gray-700 dark:text-gray-400"
                                on:click={toggleTheme}
                            >
                                <span class="text-lg font-semibold">Design umschalten</span>
                                {#if currentTheme === "dark"}
                                    <svg
                                        class="size-8"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="none"
                                        aria-hidden="true"
                                    >
                                        <path
                                            d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1-8.313-12.454z"
                                        />
                                    </svg>
                                {:else}
                                    <svg
                                        class="size-8"
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
                                {/if}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {/if}
</header>

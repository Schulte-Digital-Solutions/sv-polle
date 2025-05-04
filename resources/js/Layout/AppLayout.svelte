<script>
    import Header from "../Components/Header.svelte";
    import Footer from "../Components/Footer.svelte";
</script>

<div class="min-h-screen bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex flex-col">
    <Header />
    <main>
        <slot />
    </main>
    <Footer />
</div>

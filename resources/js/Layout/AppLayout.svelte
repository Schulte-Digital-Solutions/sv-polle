<script>
    import Header from "../Components/Header.svelte";
    import Footer from "../Components/Footer.svelte";
</script>

<div class="min-h-screen bg-background flex flex-col">
    <Header />
    <main class="flex-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <slot />
        </div>
    </main>
    <Footer />
</div>

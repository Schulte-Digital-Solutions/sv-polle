<script>
    import Header from "../Components/Header.svelte";
    import Footer from "../Components/Footer.svelte";
</script>

<div class="min-h-screen bg-background flex flex-col">
    <Header />
    <main>
        <slot />
    </main>
    <Footer />
</div>

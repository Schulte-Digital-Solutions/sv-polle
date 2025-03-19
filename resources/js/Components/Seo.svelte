<script>
    export let title = "";
    export let description = "";
    export let keywords = "";
    export let author = "";
    export let ogTitle = title;
    export let ogDescription = description;
    export let ogImage = "";
    export let ogUrl = "";
    export let twitterCard = "summary_large_image";
    // JSON-LD für strukturierte Daten
    export let jsonLd = null;
</script>

<svelte:head>
    <!-- Standard Meta-Tags -->
    {#if title}<title>{title}</title>{/if}
    {#if description}<meta name="description" content={description} />{/if}
    {#if keywords}<meta name="keywords" content={keywords} />{/if}
    {#if author}<meta name="author" content={author} />{/if}

    <!-- Open Graph Meta-Tags -->
    {#if ogTitle}<meta property="og:title" content={ogTitle} />{/if}
    {#if ogDescription}<meta property="og:description" content={ogDescription} />{/if}
    {#if ogImage}<meta property="og:image" content={ogImage} />{/if}
    {#if ogUrl}<meta property="og:url" content={ogUrl} />{/if}
    <meta property="og:type" content="website" />

    <!-- Twitter Card Meta-Tags -->
    {#if twitterCard}<meta name="twitter:card" content={twitterCard} />{/if}
    {#if ogTitle}<meta name="twitter:title" content={ogTitle} />{/if}
    {#if ogDescription}<meta name="twitter:description" content={ogDescription} />{/if}
    {#if ogImage}<meta name="twitter:image" content={ogImage} />{/if}

    <!-- JSON-LD für strukturierte Daten -->
    {#if jsonLd}
        {@html `<script type="application/ld+json">${JSON.stringify(jsonLd)}</script>`}
    {/if}
</svelte:head>

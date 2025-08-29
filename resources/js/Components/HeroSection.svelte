<script>
    export let title = "";
    export let image = "";
    export let subtitle = "";
</script>
<div class="bg-gray-900">
    <div class="relative isolate overflow-hidden">
        <img
            src={image}
            alt={title}
            class="absolute inset-0 -z-10 size-full object-cover"
        />
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                <div class="text-center">
                    <h1
                        class="text-balance text-5xl font-bold tracking-tight text-white sm:text-7xl [text-shadow:0_10px_30px_rgba(0,0,0,1),_0_0_8px_rgba(0,0,0,0.9)]"
                    >
                        {title}
                    </h1>
                    {#if subtitle}
                        <p class="mt-8 text-3xl sm:text-4xl text-white/90 font-semibold [text-shadow:0_6px_18px_rgba(0,0,0,0.95),_0_0_5px_rgba(0,0,0,0.85)]">
                            {subtitle}
                        </p>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>

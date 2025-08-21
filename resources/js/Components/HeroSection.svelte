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
                        class="text-balance text-5xl font-bold tracking-tight text-white sm:text-7xl drop-shadow-[0_5px_5px_rgba(0,0,0,0.8)]"
                    >
                        {title}
                    </h1>
                    {#if subtitle}
                        <p class="mt-8 text-3xl sm:text-4xl text-white/90 drop-shadow-[0_3px_3px_rgba(0,0,0,0.7)] font-semibold">
                            {subtitle}
                        </p>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>

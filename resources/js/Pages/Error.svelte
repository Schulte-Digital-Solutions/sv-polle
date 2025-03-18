<script>
    import { page } from "@inertiajs/svelte";
    import AppLayout from "../Layout/AppLayout.svelte";

    $: ({ status, message, errorInfo = {} } = $page.props);
</script>

<AppLayout>
    <div class="grid min-h-full place-items-center bg-white">
        <p class="text-base font-semibold text-indigo-600">{status}</p>
        <h1
            class="mt-4 text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl"
        >
            {message}
        </h1>
        <p
            class="mt-6 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8"
        >
            {#if status == 400}
                Sorry, there was an error with your request.
            {:else if status == 401}
                Sorry, you are not authorized to access this page.
            {:else if status == 403}
                Sorry, you are forbidden from accessing this page.
            {:else if status == 404}
                Sorry, we couldn’t find the page you’re looking for.
            {:else if status == 419}
                Sorry, your session has expired. Please refresh and try again.
            {:else if status == 429}
                Sorry, you are making too many requests to our servers.
            {:else if status == 500}
                Sorry, something went wrong on our end.
            {:else if status == 503}
                Sorry, the service is unavailable.
            {:else}
                Sorry, an error occurred.
            {/if}
        </p>
        {#if errorInfo?.debug}
            <div
                class="mt-10 bg-gray-800 text-white p-4 rounded-lg overflow-x-auto max-w-4xl text-center w-full"
            >
                <p class="font-bold mb-2">Debug Information:</p>
                <p class="text-sm mb-2">
                    File: {errorInfo.debug.file}:{errorInfo.debug.line}
                </p>
                <pre class="text-xs whitespace-pre-wrap text-left">{errorInfo.debug.stack}</pre>
            </div>
        {/if}
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a
                href="#"
                class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >Go back home</a
            >
            <a href="#" class="text-sm font-semibold text-gray-900"
                >Contact support <span aria-hidden="true">&rarr;</span></a
            >
        </div>
    </div>
</AppLayout>

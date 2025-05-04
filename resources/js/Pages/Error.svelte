<script>
    import { page } from "@inertiajs/svelte";
    import AppLayout from "../Layout/AppLayout.svelte";

    $: ({ status, message, errorInfo = {} } = $page.props);
</script>

<AppLayout>
    <div class="px-4 py-10 grid min-h-full place-items-center bg-white dark:bg-gray-900">
        <p class="text-3xl font-semibold text-sv-green dark:text-sv-green/90">{status}</p>
        <h1
            class="mt-4 text-balance text-3xl font-semibold tracking-tight text-gray-900 dark:text-white"
        >
            {message}
        </h1>
        <p
            class="mt-6 text-pretty text-lg font-medium text-gray-500 dark:text-gray-400 sm:text-xl/8"
        >
            {#if status == 400}
                Entschuldigung, es gab einen Fehler bei Ihrer Anfrage.
            {:else if status == 401}
                Entschuldigung, Sie sind nicht berechtigt, auf diese Seite zuzugreifen.
            {:else if status == 403}
                Entschuldigung, der Zugriff auf diese Seite ist Ihnen nicht gestattet.
            {:else if status == 404}
                Entschuldigung, die gesuchte Seite konnte nicht gefunden werden.
            {:else if status == 419}
                Entschuldigung, Ihre Sitzung ist abgelaufen. Bitte aktualisieren Sie die Seite und versuchen Sie es erneut.
            {:else if status == 429}
                Entschuldigung, Sie senden zu viele Anfragen an unsere Server.
            {:else if status == 500}
                Entschuldigung, es ist ein interner Fehler aufgetreten.
            {:else if status == 503}
                Entschuldigung, der Dienst ist derzeit nicht verfügbar.
            {:else}
                Entschuldigung, es ist ein Fehler aufgetreten.
            {/if}
        </p>
        {#if errorInfo?.debug}
            <div
                class="mt-10 bg-gray-800 dark:bg-gray-700 text-white p-4 rounded-lg overflow-x-auto max-w-4xl text-left w-full"
            >
                <p class="font-bold mb-2">Debug Information:</p>
                <p class="text-sm mb-2">
                    Datei: {errorInfo.debug.file}:{errorInfo.debug.line}
                </p>
                <pre class="text-xs whitespace-pre-wrap text-left">{errorInfo.debug.stack}</pre>
            </div>
        {/if}
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a
                href="/"
                class="rounded-md bg-sv-green px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-sv-green/90 dark:bg-sv-green/90 dark:hover:bg-sv-green/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sv-green"
                >Zurück zur Startseite</a
            >
            <a href="/contact" class="text-sm font-semibold text-gray-900 dark:text-white hover:text-sv-green dark:hover:text-sv-green/90"
                >Support kontaktieren <span aria-hidden="true">&rarr;</span></a
            >
        </div>
    </div>
</AppLayout>

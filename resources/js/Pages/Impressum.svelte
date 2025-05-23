<script>
    import AppLayout from "../Layout/AppLayout.svelte";
    import Seo from "../Components/Seo.svelte";
</script>

<Seo
    title="Impressum - SV Polle"
    description="Impressum und rechtliche Informationen des SV Polle"
/>

<AppLayout>
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold mb-8 text-gray-900 dark:text-gray-100">Impressum</h1>

        <div class="prose dark:prose-invert">
            <h2>Angaben gemäß § 5 TMG</h2>
            <p>
                Sportverein Polle e. V.<br />
                Schützenstraße 8<br />
                49740 Haselünne
            </p>

            <h2>Vertreten durch</h2>
            <p>Der Vorstand</p>

            <h2>Kontakt</h2>
            <p>
                E-Mail: info@svpolle.de
            </p>

            <h2>Registereintrag</h2>
            <p>
                Eingetragen im Vereinsregister.<br />
                Registergericht: Amtsgericht Meppen
            </p>

            <h2>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV</h2>
            <p>
                Sportverein Polle e. V.<br />
                Schützenstraße 8<br />
                49740 Haselünne
            </p>

            <h2>Streitschlichtung</h2>
            <p>
                Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:
                <a href="https://ec.europa.eu/consumers/odr/" class="text-sv-green hover:underline">
                    https://ec.europa.eu/consumers/odr/
                </a>.<br />
                Unsere E-Mail-Adresse finden Sie oben im Impressum.
            </p>
            <p>
                Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer
                Verbraucherschlichtungsstelle teilzunehmen.
            </p>

            <h2>Haftung für Inhalte</h2>
            <p>
                Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den
                allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht
                verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu
                forschen, die auf eine rechtswidrige Tätigkeit hinweisen.
            </p>
        </div>
    </div>
</AppLayout>

<style>
    /* Tailwind Typography Anpassungen */
    :global(.prose) {
        max-width: none;
    }
    :global(.prose h2) {
        color: rgb(17 24 39);
        margin-top: 2em;
        margin-bottom: 1em;
        font-size: 1.5em;
        font-weight: 700;
    }
    :global(.dark .prose h2) {
        color: rgb(243 244 246);
    }
    :global(.prose p) {
        margin-top: 1em;
        margin-bottom: 1em;
        color: rgb(55 65 81);
    }
    :global(.dark .prose p) {
        color: rgb(209 213 219);
    }
</style>

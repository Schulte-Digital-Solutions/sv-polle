<script>
    import AppLayout from "../Layout/AppLayout.svelte";
    import Seo from "../Components/Seo.svelte";
    import CookieSettingsButton from "../Components/CookieSettingsButton.svelte";
</script>

<Seo
    title="Datenschutzerklärung - SV Polle"
    description="Datenschutzerklärung des SV Polle gemäß DSGVO"
/>

<AppLayout>
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold mb-8 text-gray-900 dark:text-gray-100">Datenschutzerklärung</h1>

        <div class="prose dark:prose-invert">
            <div class="not-prose mb-8 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">
                    Sie können Ihre Cookie-Einstellungen jederzeit anpassen:
                </p>
                <CookieSettingsButton buttonStyle="rounded-md bg-sv-green px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sv-green/90 dark:bg-sv-green/90 dark:hover:bg-sv-green/80" />
            </div>

            <h2>1. Datenschutz auf einen Blick</h2>
            <h3>Allgemeine Hinweise</h3>
            <p>
                Die folgenden Hinweise geben einen einfachen Überblick darüber, was mit Ihren personenbezogenen Daten
                passiert, wenn Sie diese Website besuchen. Personenbezogene Daten sind alle Daten, mit denen Sie
                persönlich identifiziert werden können.
            </p>

            <h2>2. Allgemeine Informationen und Pflichtinformationen</h2>
            <h3>Datenschutz</h3>
            <p>
                Die Betreiber dieser Seiten nehmen den Schutz Ihrer persönlichen Daten sehr ernst. Wir behandeln Ihre
                personenbezogenen Daten vertraulich und entsprechend den gesetzlichen Datenschutzvorschriften sowie
                dieser Datenschutzerklärung.
            </p>

            <h3>Hinweis zur verantwortlichen Stelle</h3>
            <p>
                Die verantwortliche Stelle für die Datenverarbeitung auf dieser Website ist:<br /><br />
                Sportverein Polle e. V.<br />
                Schützenstraße 8<br />
                49740 Haselünne<br /><br />
                E-Mail: info@svpolle.de
            </p>

            <h2>3. Datenerfassung auf dieser Website</h2>
            <h3>Cookies</h3>
            <p>
                Unsere Website verwendet sogenannte "Cookies". Hierbei handelt es sich um kleine Textdateien, die mit
                Hilfe des Browsers auf Ihrem Endgerät verarbeitet werden. Sie richten keinen Schaden an.
            </p>
            <p>
                Wir nutzen Cookies ausschließlich für technisch notwendige Funktionen wie z.B. die Speicherung Ihrer
                Design-Präferenzen (Hell-/Dunkel-Modus). Sie können Ihren Browser so einstellen, dass Sie über das
                Setzen von Cookies informiert werden und Cookies nur im Einzelfall erlauben.
            </p>

            <h3>hCaptcha Anti-Bot-Validierung</h3>
            <p>
                Wir verwenden hCaptcha (im Folgenden "hCaptcha") auf unserer Website. Dieser Service wird von
                Intuition Machines, Inc., einer US-amerikanischen Gesellschaft, bereitgestellt. hCaptcha wird
                eingesetzt, um zu überprüfen, ob Dateneingaben auf unserer Website (z.B. in einem Kontaktformular)
                durch Menschen oder durch automatisierte, maschinelle Verarbeitung erfolgen.
            </p>
            <p>
                Zu diesem Zweck analysiert hCaptcha das Verhalten des Websitebesuchers anhand verschiedener
                Merkmale. Diese Analyse beginnt automatisch, sobald der Websitebesucher eine Seite mit
                integriertem hCaptcha betritt. Bei der Analyse wertet hCaptcha verschiedene Informationen aus
                (z.B. IP-Adresse, Verweildauer des Websitebesuchers auf der Website oder vom Nutzer getätigte
                Mausbewegungen).
            </p>
            <p>
                Die durch die Analyse erfassten Daten werden an Server von Intuition Machines übermittelt.
                Intuition Machines ist unter dem Privacy-Shield-Abkommen zertifiziert und gewährleistet damit
                ein angemessenes Datenschutzniveau.
            </p>
            <p>
                Die Verwendung von hCaptcha erfolgt auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO: Wir haben ein
                berechtigtes Interesse daran, unsere Website vor missbräuchlicher automatisierter Ausspähung und
                vor SPAM zu schützen.
            </p>
            <p>
                Weitere Informationen zu hCaptcha und zum Datenschutz bei Intuition Machines finden Sie unter:
                <a href="https://www.hcaptcha.com/privacy" class="text-sv-green hover:underline" target="_blank" rel="noopener noreferrer">
                    https://www.hcaptcha.com/privacy
                </a>
            </p>

            <h3>FuPa Widget</h3>
            <p>
                Auf unserer Website binden wir das FuPa Widget ein, ein Service der Fupa GmbH. Das Widget zeigt
                aktuelle Informationen über unsere Fußballmannschaften, wie Spielpläne, Ergebnisse und Tabellen.
            </p>
            <p>
                Beim Laden einer Seite mit eingebundenem FuPa Widget wird eine Verbindung zu den Servern von FuPa
                hergestellt. Dabei können verschiedene Daten übertragen werden, unter anderem:
            </p>
            <ul>
                <li>IP-Adresse</li>
                <li>Datum und Uhrzeit des Zugriffs</li>
                <li>Browsertyp und -version</li>
                <li>Betriebssystem</li>
                <li>Referrer URL (die zuvor besuchte Seite)</li>
            </ul>
            <p>
                Die Datenverarbeitung erfolgt auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO. Wir haben ein
                berechtigtes Interesse daran, unseren Websitebesuchern aktuelle Informationen über unsere
                Mannschaften zur Verfügung zu stellen.
            </p>
            <p>
                Weitere Informationen zum Datenschutz bei FuPa finden Sie unter:
                <a href="https://www.fupa.net/fupa/datenschutz" class="text-sv-green hover:underline" target="_blank" rel="noopener noreferrer">
                    https://www.fupa.net/fupa/datenschutz
                </a>
            </p>

            <h3>Server-Log-Dateien</h3>
            <p>
                Der Provider der Seiten erhebt und speichert automatisch Informationen in so genannten Server-Log-Dateien,
                die Ihr Browser automatisch an uns übermittelt. Dies sind:
            </p>
            <ul>
                <li>Browsertyp und Browserversion</li>
                <li>Verwendetes Betriebssystem</li>
                <li>Referrer URL</li>
                <li>Hostname des zugreifenden Rechners</li>
                <li>Uhrzeit der Serveranfrage</li>
                <li>IP-Adresse</li>
            </ul>
            <p>
                Eine Zusammenführung dieser Daten mit anderen Datenquellen wird nicht vorgenommen.
            </p>

            <h2>4. Soziale Medien</h2>
            <h3>Social Media Plugins</h3>
            <p>
                Unsere Website enthält Links zu sozialen Netzwerken. Diese werden erst nach Ihrer aktiven Zustimmung
                geladen, um Ihre Privatsphäre zu schützen.
            </p>

            <h2>5. Ihre Rechte</h2>
            <h3>Auskunftsrecht</h3>
            <p>
                Sie haben jederzeit das Recht unentgeltlich Auskunft über Herkunft, Empfänger und Zweck Ihrer
                gespeicherten personenbezogenen Daten zu erhalten.
            </p>

            <h3>Recht auf Berichtigung</h3>
            <p>
                Sie haben das Recht, die Berichtigung unrichtiger personenbezogener Daten zu verlangen.
            </p>

            <h3>Recht auf Löschung</h3>
            <p>
                Sie haben das Recht, die Löschung Ihrer bei uns gespeicherten personenbezogenen Daten zu verlangen,
                soweit nicht die Verarbeitung zur Ausübung des Rechts auf freie Meinungsäußerung, zur Erfüllung einer
                rechtlichen Verpflichtung, aus Gründen des öffentlichen Interesses oder zur Geltendmachung, Ausübung
                oder Verteidigung von Rechtsansprüchen erforderlich ist.
            </p>

            <h3>Beschwerderecht</h3>
            <p>
                Im Falle datenschutzrechtlicher Verstöße steht dem Betroffenen ein Beschwerderecht bei der zuständigen
                Aufsichtsbehörde zu.
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
    :global(.prose h3) {
        color: rgb(17 24 39);
        margin-top: 1.5em;
        margin-bottom: 0.5em;
        font-size: 1.25em;
        font-weight: 600;
    }
    :global(.dark .prose h3) {
        color: rgb(243 244 246);
    }
    :global(.prose p, .prose li) {
        margin-top: 1em;
        margin-bottom: 1em;
        color: rgb(55 65 81);
    }
    :global(.dark .prose p, .dark .prose li) {
        color: rgb(209 213 219);
    }
    :global(.prose ul) {
        margin-top: 1em;
        margin-bottom: 1em;
        list-style-type: disc;
        padding-left: 1.625em;
    }
</style>

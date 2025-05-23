<script>
    import AppLayout from "../Layout/AppLayout.svelte";
    import HeroSection from "../Components/HeroSection.svelte";
    import backgroundImage from "../../images/background.jpeg";
    import Seo from "../Components/Seo.svelte";
</script>
<Seo
    title="SV Polle"
    description="Der SV Polle ist ein gemeinsamer Sportverein der Orte Andrup, Lage und Lotten. Besonders im Fußball und Dart aktiv."
    keywords="SV Polle, Sportverein, Fußball, Dart, Haselünne"
    author="SV Polle Team"
    ogImage={backgroundImage}
    ogUrl="https://svpolle.de"
    twitterCard="summary_large_image"
    jsonLd={{
        "@context": "https://schema.org",
        "@type": "SportsOrganization",
        "name": "SV Polle",
        "legalName": "Sportverein Polle e. V.",
        "sport": "Football, Darts",
        "foundingDate": "1988",
        "email": "info@svpolle.de",
        "url": "https://svpolle.de",
        "logo": "https://svpolle.de/images/SV-Polle.png",
        "sameAs": [
            "https://www.instagram.com/sv_polle",
            "https://www.fussball.de/verein/sv-polle-niedersachsen/-/id/00ES8GN80K000026VV0AG08LVUPGND5I#!/"
        ],
        "description": "Der SV Polle ist ein gemeinsamer Sportverein der Orte Andrup, Lage und Lotten. Besonders im Fußball und Dart aktiv.",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Schützenstraße 8",
            "addressLocality": "Haselünne",
            "postalCode": "49740",
            "addressCountry": "DE"
        },
    }}
/>
<AppLayout>
    <HeroSection title="Willkommen beim SV Polle" image={backgroundImage} />
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-pretty font-medium text-gray-900 dark:text-gray-100 flex flex-col gap-y-4 py-8">
            <p>Der SV Polle ist ein gemeinsamer Sportverein der Orte Andrup, Lage und Lotten in der Gemeinschaft Haselünne.</p>
            <p>Besonders im Fußball sind wir aktiv, aber auch unser Dartverein erfreut sich großer Beliebtheit.</p>
            <p>Darüber hinaus stehen unsere Räumlichkeiten für weitere Gruppenaktivitäten wie z. B. Yoga zur Verfügung.</p>
            <p>Wir sind eine engagierte Verein mit einer langen Geschichte und vielen sportlichen Erfolgen.</p>
            <p>Wenn du Interesse hast, melde dich gerne bei uns!</p>
        </div>
    </div>
</AppLayout>

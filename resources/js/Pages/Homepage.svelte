<script>
    import AppLayout from "../Layout/AppLayout.svelte";
    import HeroSection from "../Components/HeroSection.svelte";
    import backgroundImage from "../../images/background.jpeg";
</script>

<AppLayout>
    <HeroSection title="Willkommen beim SV Polle" image={backgroundImage} />
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-pretty font-medium text-gray-500 flex flex-col gap-y-4 py-8">
            <p>Der SV Polle ist ein gemeinsamer Sportverein der Orte Andrup, Lage und Lotten in der Gemeinschaft Haselünne.</p>
            <p>Besonders im Fußball sind wir aktiv, aber auch unser Dartverein erfreut sich großer Beliebtheit.</p>
            <p>Darüber hinaus stehen unsere Räumlichkeiten für weitere Gruppenaktivitäten wie z. B. Yoga zur Verfügung.</p>
            <p>Wir sind eine engagierte Verein mit einer langen Geschichte und vielen sportlichen Erfolgen.</p>
            <p>Wenn du Interesse hast, melde dich gerne bei uns!</p>
        </div>
    </div>
</AppLayout>

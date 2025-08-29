// Zentrale Registry für Consent-Kategorien und deren Services
// Pflegen Sie hier alle Dienste inkl. Beschreibungen und Standardwerten.

/**
 * @typedef {Object} ConsentService
 * @property {string} id            Eindeutige Service-ID (wird im Store als Key verwendet)
 * @property {string} label         Anzeigename des Services
 * @property {string} [description] Kurze Beschreibung
 * @property {boolean} [default]    Standardzustand (aktiv/inaktiv), default: false
 * @property {string} [policyUrl]   Link zur Datenschutzerklärung
 */

/**
 * @typedef {Object} ConsentCategory
 * @property {"necessary"|"functional"|"analytics"|"marketing"|string} key
 * @property {string} label
 * @property {string} [description]
 * @property {ConsentService[]} services
 */

/** @type {ConsentCategory[]} */
export const consentCategories = [
    {
        key: 'necessary',
        label: 'Notwendige Cookies',
        description: 'Diese Cookies sind für die Grundfunktionen der Website erforderlich und können nicht deaktiviert werden.',
        services: [] // Notwendig wird nicht explizit pro Service verwaltet
    },
    {
        key: 'functional',
        label: 'Funktionale Cookies',
        description: 'Ermöglichen erweiterte Funktionen und Personalisierung.',
        services: [
            {
                id: 'hcaptcha',
                label: 'hCaptcha',
                description: 'Spam- und Bot-Schutz beim Absenden von Formularen.',
                default: false,
                policyUrl: 'https://www.hcaptcha.com/privacy'
            },
            {
                id: 'fupa',
                label: 'FuPa Widget',
                description: 'Einbettung des FuPa Spielplans, Tabelle, Kader und Spielerstatistiken.',
                default: false,
                policyUrl: 'https://www.fupa.net/datenschutz'
            },
            {
                id: 'google-maps',
                label: 'Google Maps',
                description: 'Karte für die Anfahrtsbeschreibung via Google Maps.',
                default: false,
                policyUrl: 'https://policies.google.com/privacy?hl=de'
            }
        ]
    },
    {
        key: 'analytics',
        label: 'Analyse-Cookies',
        description: 'Helfen uns, die Nutzung der Website zu verstehen und zu verbessern.',
        services: [
            // Beispiel: { id: 'plausible', label: 'Plausible Analytics', default: false, policyUrl: 'https://plausible.io/data-policy' }
        ]
    },
    {
        key: 'marketing',
        label: 'Marketing-Cookies',
        description: 'Werbung relevanter gestalten und Website-Optimierung für Marketingzwecke.',
        services: [
            // Beispiel: { id: 'facebook-pixel', label: 'Facebook Pixel', default: false, policyUrl: 'https://www.facebook.com/policy.php' }
        ]
    }
];

// Hilfsobjekte für schnellen Zugriff
export const servicesByCategory = Object.fromEntries(
    consentCategories.map(c => [c.key, c.services.map(s => s.id)])
);

export const defaultServicesState = Object.fromEntries(
    consentCategories.flatMap(c => c.services.map(s => [s.id, !!s.default]))
);

export const defaultCategoriesState = Object.fromEntries(
    consentCategories.map(c => [c.key, c.services.some(s => !!s.default)])
);

// Map aller Services nach ID -> Serviceobjekt
export const servicesMap = Object.fromEntries(
    consentCategories.flatMap(c => c.services.map(s => [s.id, s]))
);

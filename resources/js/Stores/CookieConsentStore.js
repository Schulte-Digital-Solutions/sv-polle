import { writable } from 'svelte/store';
import { defaultServicesState, servicesByCategory } from './CookieServices';

// Rechtliche Seiten, die von Consent-Mechanismen ausgenommen sind
export const legalPages = ['/datenschutz', '/impressum'].map(path => path.endsWith('/') ? path : path + '/');

function migrateOldConsentShape(parsed) {
    // If parsed has booleans for categories and no services object, migrate.
    const hasServices = parsed && typeof parsed === 'object' && parsed.services && typeof parsed.services === 'object';
    if (hasServices) {
        // Sanitize: keep only supported keys
        return {
            services: { ...parsed.services },
            necessary: true,
            date: parsed?.date ?? null,
            showBanner: !!parsed?.showBanner,
            showDetails: !!parsed?.showDetails,
        };
    }

    const services = { ...defaultServicesState };
    // Flip all services within true categories to true, otherwise leave defaults
    for (const [category, ids] of Object.entries(servicesByCategory)) {
        if (category === 'necessary') {
            continue;
        }
        const catAllowed = !!parsed?.[category];
        ids.forEach(id => {
            services[id] = catAllowed ? true : services[id];
        });
    }

    return {
        services,
        necessary: true,
        date: parsed?.date ?? null,
        showBanner: parsed?.showBanner ?? false,
        showDetails: parsed?.showDetails ?? false
    };
}

function createCookieConsentStore() {
    const { subscribe, set, update } = writable({
        necessary: true,
        services: { ...defaultServicesState },
        date: null,
        showBanner: false,
        showDetails: false
    });

    return {
        subscribe,
        setConsent: (consent) => {
            // Accept both shapes; persist only services-based payload
            const merged = migrateOldConsentShape(consent);
            const consentWithDate = {
                services: { ...(merged.services ?? {}) },
                necessary: true,
                date: new Date().toISOString(),
                showBanner: false,
                showDetails: false
            };
            localStorage.setItem('cookie-consent', JSON.stringify(consentWithDate));
            set(consentWithDate);
        },
        showSettings: () => {
            update(state => ({
                ...state,
                showBanner: true,
                showDetails: true
            }));
        },
        update: (updateFn) => {
            update(current => {
                const next = updateFn(current);
                return {
                    ...current,
                    ...next,
                    services: { ...(next.services ?? current.services ?? {}) },
                    necessary: true,
                };
            });
        },
        toggleService: (serviceId, value) => {
            update(state => {
                const services = { ...(state.services ?? {}), [serviceId]: typeof value === 'boolean' ? value : !state.services?.[serviceId] };
                return { ...state, services, necessary: true };
            });
        },
        init: () => {
            try {
                const stored = localStorage.getItem('cookie-consent');
                if (stored) {
                    try {
                        const parsedConsent = JSON.parse(stored);
                        const migrated = migrateOldConsentShape(parsedConsent);
                        set({
                            ...migrated,
                            necessary: true,
                            showBanner: false,
                            showDetails: false
                        });
                    } catch (e) {
                        console.error('Fehler beim Parsen der Cookie-Einstellungen:', e);
                        localStorage.removeItem('cookie-consent');
                        set({
                            necessary: true,
                            services: { ...defaultServicesState },
                            date: null,
                            showBanner: true,
                            showDetails: false
                        });
                    }
                } else {
                    set({
                        necessary: true,
                        services: { ...defaultServicesState },
                        date: null,
                        showBanner: true,
                        showDetails: false
                    });
                }
            } catch (e) {
                console.error('Fehler beim Zugriff auf localStorage:', e);
                set({
                    necessary: true,
                    services: { ...defaultServicesState },
                    date: null,
                    showBanner: true,
                    showDetails: false
                });
            }
        }
    };
}

export const CookieConsent = createCookieConsentStore();

import { writable } from 'svelte/store';

// Rechtliche Seiten, die von Consent-Mechanismen ausgenommen sind
export const legalPages = ['/datenschutz', '/impressum'].map(path => path.endsWith('/') ? path : path + '/');

function createCookieConsentStore() {
    const { subscribe, set, update } = writable({
        necessary: true,
        functional: false,
        analytics: false,
        marketing: false,
        date: null,
        showBanner: false,
        showDetails: false
    });

    return {
        subscribe,
        setConsent: (consent) => {
            const consentWithDate = {
                ...consent,
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
        init: () => {
            const stored = localStorage.getItem('cookie-consent');
            if (stored) {
                const parsedConsent = JSON.parse(stored);
                set({
                    ...parsedConsent,
                    necessary: true,
                    showBanner: false,
                    showDetails: false
                });
            } else {
                set({
                    necessary: true,
                    functional: false,
                    analytics: false,
                    marketing: false,
                    date: null,
                    showBanner: true,
                    showDetails: false
                });
            }
        }
    };
}

export const cookieConsent = createCookieConsentStore();

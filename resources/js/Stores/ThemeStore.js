import { writable } from 'svelte/store';

function createThemeStore() {
    const { subscribe, set } = writable('system');

    // Media Query für Dark Mode
    const darkModeQuery = window.matchMedia('(prefers-color-scheme: dark)');

    // Listener für System-Farbschema-Änderungen
    darkModeQuery.addEventListener('change', (e) => {
        const currentTheme = localStorage.getItem('theme') || 'system';
        if (currentTheme === 'system') {
            updateTheme('system');
        }
    });

    return {
        subscribe,
        setTheme: (theme) => {
            if (!['light', 'dark', 'system'].includes(theme)) {
                console.warn('Ungültiges Theme:', theme);
                theme = 'system';
            }
            set(theme);
            localStorage.setItem('theme', theme);
            updateTheme(theme);
        },
        initialize: () => {
            let savedTheme = localStorage.getItem('theme');

            // Wenn kein Theme gespeichert ist, nutze System-Theme
            if (!savedTheme || !['light', 'dark', 'system'].includes(savedTheme)) {
                savedTheme = 'system';
                localStorage.setItem('theme', savedTheme);
            }

            set(savedTheme);
            updateTheme(savedTheme);
        }
    };
}

function updateTheme(theme) {
    const root = document.documentElement;
    const darkModeQuery = window.matchMedia('(prefers-color-scheme: dark)');

    const shouldBeDark =
        theme === 'dark' ||
        (theme === 'system' && darkModeQuery.matches);

    root.classList.toggle('dark', shouldBeDark);

    // Manifest Farben dynamisch aktualisieren
    const manifestLink = document.querySelector('link[rel="manifest"]');
    if (manifestLink) {
        manifestLink.href = `/manifest-${shouldBeDark ? 'dark' : 'light'}.webmanifest`;
    }
}

export const theme = createThemeStore();

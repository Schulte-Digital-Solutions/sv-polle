import { writable } from 'svelte/store';

function createThemeStore() {
    const { subscribe, set } = writable('system');
   // Listener für System-Farbschema-Änderungen
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        const currentTheme = localStorage.getItem('theme') || 'system';
        if (currentTheme === 'system') {
            updateTheme('system');
        }
    });
    return {
        subscribe,
        setTheme: (theme) => {
            set(theme);
            localStorage.setItem('theme', theme);
            updateTheme(theme);
        },
        initialize: () => {
            const savedTheme = localStorage.getItem('theme') || 'system';
            set(savedTheme);
            updateTheme(savedTheme);
        }
    };
}

function updateTheme(theme) {
    if (theme === 'system') {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    } else {
        document.documentElement.classList.toggle('dark', theme === 'dark');
    }

    // Manifest Farben dynamisch aktualisieren
    const manifestLink = document.querySelector('link[rel="manifest"]');
    const isDark = document.documentElement.classList.contains('dark');
    manifestLink.href = `/manifest-${isDark ? 'dark' : 'light'}.webmanifest`;
}

export const theme = createThemeStore();

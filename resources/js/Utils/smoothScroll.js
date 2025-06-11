/**
 * Fügt einen Event-Listener für Smooth-Scrolling zu Links mit Hash-Ankern hinzu
 * und scrollt automatisch zum Anker, wenn die Seite mit einem Hash in der URL geladen wird.
 *
 * Diese Funktion:
 * 1. Prüft beim Laden der Seite, ob die URL einen Hash enthält und scrollt zum entsprechenden Element
 * 2. Fügt Event-Listener zu allen Links mit Hash-Ankern hinzu für sanftes Scrollen bei Klick
 */
export function initSmoothScroll() {
    // Event-Listener für Links mit Hash-Anker
    document.querySelectorAll('a[href*="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            // Nur für interne Links
            if (this.getAttribute('href').startsWith('/') || this.getAttribute('href').startsWith('#')) {
                const hash = this.getAttribute('href').split('#')[1];
                const target = document.getElementById(hash);
                  if (target) {
                    e.preventDefault();

                    // Header-Höhe als Offset berechnen (ca. 80px, anpassen falls nötig)
                    const headerOffset = 80;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
                    const offsetPosition = targetPosition - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    // URL aktualisieren ohne Seitenneuladen
                    history.pushState(null, null, `/#${hash}`);
                }
            }
        });
    });

    // Beim Laden der Seite zum Anker scrollen, falls vorhanden
    setTimeout(() => {
        if (window.location.hash) {
            const hash = window.location.hash.substring(1);
            const target = document.getElementById(hash);
              if (target) {
                // Header-Höhe als Offset berechnen (ca. 80px, anpassen falls nötig)
                const headerOffset = 80;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
                const offsetPosition = targetPosition - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        }
    }, 300); // Kleine Verzögerung, um sicherzustellen, dass alle Elemente geladen sind
}

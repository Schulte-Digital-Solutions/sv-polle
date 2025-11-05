# Installationsanleitung - SV Polle Website

## Überblick

Diese Anleitung erklärt die Installation und Bereitstellung der SV Polle Website mit Docker. Das Projekt verwendet Laravel 12 mit Inertia.js und Svelte.

## Dockerfile-Struktur

Das Dockerfile verwendet einen **Multi-Stage Build** mit drei Phasen:

### Stage 1: Frontend-Build (`frontend-builder`)
**Zweck:** Kompilierung der Frontend-Assets (Svelte-Komponenten, CSS, JS)

- **Base Image:** `node:20-alpine`
- **Aufgaben:**
  - Installation der Node.js-Abhängigkeiten via `npm ci`
  - Build der Frontend-Assets mit Vite (`npm run build`)
  - Ergebnis: Kompilierte Assets im `public/build` Verzeichnis

### Stage 2: PHP-Abhängigkeiten (`composer-builder`)
**Zweck:** Installation der PHP-Abhängigkeiten

- **Base Image:** `composer:2`
- **Aufgaben:**
  - Installation der Production-Dependencies mit Composer
  - Optimierter Autoloader für bessere Performance
  - Keine Dev-Dependencies (kleineres Image)

### Stage 3: Production Image
**Zweck:** Finales, schlankes Produktions-Image

- **Base Image:** `php:8.4-fpm-alpine`
- **Enthält:**
  - PHP-FPM 8.4
  - Nginx Webserver
  - Supervisor für Prozessverwaltung
  - Alle benötigten PHP-Extensions

## Installierte PHP-Extensions

```
- pdo_mysql    → Datenbankverbindung
- zip          → Archivverarbeitung
- mbstring     → Multi-Byte String Handling
- opcache      → PHP Performance-Cache
- bcmath       → Präzise Mathematik-Operationen
- intl         → Internationalisierung
```

## PHP-Konfiguration

Optimiert für Laravel-Production:

```ini
memory_limit = 256M
upload_max_filesize = 20M
post_max_size = 20M
max_execution_time = 300
opcache.enable = 1
expose_php = Off
```

## Docker Entrypoint-Script

Das Startup-Script (`/usr/local/bin/docker-entrypoint.sh`) führt automatisch folgende Schritte aus:

1. **Verzeichnisse erstellen** - Storage und Cache-Ordner
2. **Berechtigungen setzen** - Für www-data User
3. **Caches leeren** - Config und Application Cache
4. **Datenbankverbindung testen**
5. **Laravel optimieren:**
   - `php artisan config:cache`
   - `php artisan route:cache`
   - `php artisan view:cache`
6. **Datenbank-Migrationen** ausführen
7. **Supervisor starten** (PHP-FPM + Nginx)

## Nginx-Konfiguration

- Port: **80**
- Document Root: `/var/www/html/public`
- PHP-FPM: `127.0.0.1:9000`
- Security Headers:
  - `X-Frame-Options: SAMEORIGIN`
  - `X-Content-Type-Options: nosniff`

## Supervisor-Konfiguration

Verwaltet zwei Prozesse:

1. **PHP-FPM** (Priority 5)
2. **Nginx** (Priority 10)

Beide Prozesse werden automatisch neu gestartet bei Fehlern.

## Docker Image bauen

### Lokaler Build
```bash
docker build -t sv-polle:latest .
```

### Mit Tag für Version
```bash
docker build -t sv-polle:1.0.0 .
```

## Container starten

### Einfacher Start
```bash
docker run -d \
  --name sv-polle \
  -p 8080:80 \
  -e APP_KEY=base64:IhrLaravelAppKey \
  -e DB_HOST=mysql \
  -e DB_DATABASE=sv_polle \
  -e DB_USERNAME=root \
  -e DB_PASSWORD=geheim \
  sv-polle:latest
```

### Mit docker-compose.yml (empfohlen)

Erstelle eine `docker-compose.yml`:

```yaml
version: '3.8'

services:
  app:
    build: .
    ports:
      - "8080:80"
    environment:
      APP_NAME: "SV Polle"
      APP_ENV: production
      APP_DEBUG: false
      APP_KEY: ${APP_KEY}
      DB_CONNECTION: mysql
      DB_HOST: mysql
      DB_PORT: 3306
      DB_DATABASE: sv_polle
      DB_USERNAME: sv_polle_user
      DB_PASSWORD: ${DB_PASSWORD}
    depends_on:
      - mysql
    volumes:
      - storage:/var/www/html/storage/app
    restart: unless-stopped
    healthcheck:
      test: ["CMD", "wget", "--quiet", "--tries=1", "--spider", "http://localhost/up"]
      interval: 30s
      timeout: 3s
      retries: 3
      start_period: 40s

  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD}
      MYSQL_DATABASE: sv_polle
      MYSQL_USER: sv_polle_user
      MYSQL_PASSWORD: ${DB_PASSWORD}
    volumes:
      - mysql_data:/var/lib/mysql
    restart: unless-stopped

volumes:
  storage:
  mysql_data:
```

Starten mit:
```bash
docker-compose up -d
```

## Umgebungsvariablen

Wichtige Variablen, die gesetzt werden müssen:

```bash
APP_KEY=          # Laravel App Key (artisan key:generate)
APP_ENV=production
APP_DEBUG=false
DB_HOST=          # Datenbank-Host
DB_DATABASE=      # Datenbank-Name
DB_USERNAME=      # Datenbank-User
DB_PASSWORD=      # Datenbank-Passwort
```

### App Key generieren
```bash
# In lokalem Laravel-Projekt
php artisan key:generate --show
```

## Health Check

Der Container hat einen integrierten Health Check:
- **Interval:** 30 Sekunden
- **Timeout:** 3 Sekunden
- **Start Period:** 40 Sekunden (Zeit für Laravel-Setup)
- **Retries:** 3

Überprüft: `http://localhost/up`

## Logs anzeigen

### Container-Logs
```bash
docker logs sv-polle
```

### Live-Logs folgen
```bash
docker logs -f sv-polle
```

### Supervisor-Logs im Container
```bash
docker exec sv-polle cat /var/log/supervisor/supervisord.log
```

### Laravel-Logs
```bash
docker exec sv-polle cat /var/www/html/storage/logs/laravel.log
```

## Troubleshooting

### Container startet nicht
```bash
# Detaillierte Logs anzeigen
docker logs sv-polle

# In Container einsteigen
docker exec -it sv-polle sh
```

### Datenbank-Verbindungsfehler
```bash
# Datenbankverbindung testen
docker exec sv-polle php artisan db:show

# MySQL-Container prüfen
docker exec mysql mysql -u root -p -e "SHOW DATABASES;"
```

### Berechtigungsprobleme
```bash
# Berechtigungen neu setzen
docker exec sv-polle chown -R www-data:www-data /var/www/html/storage
docker exec sv-polle chmod -R 775 /var/www/html/storage
```

### Cache-Probleme
```bash
# Alle Caches löschen
docker exec sv-polle php artisan cache:clear
docker exec sv-polle php artisan config:clear
docker exec sv-polle php artisan route:clear
docker exec sv-polle php artisan view:clear
```

### Nginx neu starten
```bash
docker exec sv-polle supervisorctl restart nginx
```

### PHP-FPM neu starten
```bash
docker exec sv-polle supervisorctl restart php-fpm
```

## Performance-Optimierungen

Das Dockerfile enthält bereits folgende Optimierungen:

1. **Multi-Stage Build** - Kleineres finales Image
2. **Alpine Linux** - Minimales Base Image (~5MB)
3. **OPcache aktiviert** - PHP Bytecode-Caching
4. **Laravel Caching:**
   - Config Cache
   - Route Cache
   - View Cache
5. **Composer Autoloader optimiert** - `--optimize-autoloader`
6. **Keine Dev-Dependencies** - Nur Production-Packages

## Größenvergleich

- **Frontend-Builder:** ~400 MB (wird verworfen)
- **Composer-Builder:** ~150 MB (wird verworfen)
- **Finales Image:** ~150-200 MB

## Sicherheitsfeatures

- ✅ `expose_php = Off` - Versteckt PHP-Version
- ✅ Security Headers (X-Frame-Options, X-Content-Type-Options)
- ✅ Versteckte Dot-Files (`.env`, `.git`, etc.)
- ✅ Nur Production-Dependencies
- ✅ Non-root User für PHP-FPM (`www-data`)
- ✅ Health Check aktiviert

## Deployment-Checkliste

- [ ] `.env` Datei mit Production-Werten erstellt
- [ ] `APP_KEY` generiert und gesetzt
- [ ] Datenbankzugangsdaten konfiguriert
- [ ] `APP_DEBUG=false` gesetzt
- [ ] Frontend-Assets gebaut (`npm run build`)
- [ ] Composer Dependencies installiert
- [ ] Datenbank-Migrationen getestet
- [ ] SSL-Zertifikat konfiguriert (Reverse Proxy)
- [ ] Backup-Strategie implementiert
- [ ] Monitoring eingerichtet

## Weiterführende Ressourcen

- [Docker Best Practices](https://docs.docker.com/develop/dev-best-practices/)
- [Laravel Deployment](https://laravel.com/docs/12.x/deployment)
- [Docker Compose Dokumentation](https://docs.docker.com/compose/)

---

*Stand: 5. November 2025*
*Version: 1.0*

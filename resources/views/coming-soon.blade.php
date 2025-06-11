<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SV Polle - Coming Soon</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'PT Sans', Arial, sans-serif;
        }

        @font-face {
            font-family: 'PT Sans';
            src: url('{{ asset('fonts/PTSans-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'PT Sans';
            src: url('{{ asset('fonts/PTSans-Bold.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        body {
            background-color: rgb(0 150 63);
            /* SV Polle Grün */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: white;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .login-button {
            background-color: white;
            color: rgb(0 150 63);
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .login-button:hover {
            background-color: #f0f0f0;
        }

        /* Popup Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
            transition: all 0.3s ease;
        }

        .modal-content {
            background-color: rgba(255, 255, 255, 0.9);
            margin: 15% auto;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: modalopen 0.3s;
        }

        @keyframes modalopen {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 20px;
        }

        .close-modal:hover,
        .close-modal:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: rgb(0 150 63);
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn {
            background-color: rgb(0 150 63);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: rgb(0, 130, 53);
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            .modal-content {
                margin: 30% auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ asset('images/SVPolleLogo.png') }}" alt="SV Polle Logo" style="width: 200px; margin-bottom: 30px;">
        <h1>Unsere Website ist bald verfügbar</h1>
        <p>Wir arbeiten fleißig an unserer neuen Website. Bald können Sie hier alle Informationen rund um den SV Polle
            finden.</p>

        @if(session('access_granted'))
            <div style="background-color: rgba(255, 255, 255, 0.9); color: rgb(0 150 63); padding: 20px; border-radius: 10px; margin-top: 20px;">
                <h2 style="color: rgb(0 150 63); margin-bottom: 15px;">Willkommen beim SV Polle!</h2>
                <p style="color: #333;">Sie haben nun Zugriff auf die Vorschau-Version unserer Website.</p>
                <a href="{{ route('home') }}" class="btn" style="display: inline-block; margin-top: 15px; background-color: rgb(0 150 63);">Zur Website</a>
            </div>
        @else
            <button id="openLoginModal" class="login-button">Zum internen Bereich</button>

            <!-- Direkte Weiterleitung Link (für Fehlerbehebung) -->
            <p style="margin-top: 15px; font-size: 0.8rem;">
                <a href="{{ route('home') }}" style="color: rgba(255, 255, 255, 0.7);">Direkt zur Hauptseite</a>
            </p>
        @endif

        <p style="margin-top: 30px;">Haben Sie Fragen? Kontaktieren Sie uns:</p>
        <p><strong>E-Mail:</strong> info@svpolle.de</p>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2 style="color: rgb(0 150 63); margin-bottom: 20px; text-align: center;">Interner Bereich</h2>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form id="loginForm" method="POST" action="{{ route('preview.login') }}">
                @csrf
                <div class="form-group">
                    <label for="password">Passwort</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Anmelden</button>
            </form>
        </div>
    </div>

    <script>
        // Modal Funktionalität
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('loginModal');
            const openModalBtn = document.getElementById('openLoginModal');
            const closeModalBtn = document.querySelector('.close-modal');
            const loginForm = document.getElementById('loginForm');

            // Modal öffnen, wenn Button geklickt wird
            if (openModalBtn) {
                openModalBtn.addEventListener('click', function() {
                    modal.style.display = 'block';
                });
            }

            // Modal schließen, wenn X geklickt wird
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function() {
                    modal.style.display = 'none';
                });
            }

            // Modal schließen, wenn außerhalb geklickt wird
            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });

            // Formular absenden mit AJAX, um das CSRF-Token-Problem zu vermeiden
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // CSRF-Token aus dem Formular-Feld holen
                    const csrfToken = document.querySelector('input[name="_token"]').value;

                    // Formular-Daten
                    const password = document.getElementById('password').value;

                    // FormData Objekt erstellen (sendet Daten als multipart/form-data)
                    const formData = new FormData();
                    formData.append('password', password);
                    formData.append('_token', csrfToken);

                    // AJAX-Anfrage
                    fetch('{{ route('preview.login') }}', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData,
                        credentials: 'same-origin' // Wichtig für Sessions
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Netzwerkantwort war nicht OK');
                        }

                        // Redirect-Header prüfen
                        const redirectUrl = response.headers.get('X-Inertia-Location') ||
                                           response.headers.get('Location');
                        if (redirectUrl) {
                            window.location.href = redirectUrl;
                            return {};
                        }

                        return response.text().then(text => {
                            // Überprüfen, ob die Antwort ein leerer String ist
                            if (text.trim() === '') {
                                return {};
                            }

                            // Versuchen, die Antwort als JSON zu parsen
                            try {
                                return JSON.parse(text);
                            } catch (e) {
                                // Wenn es kein JSON ist, prüfen ob es eine Umleitung ist
                                if (text.includes('<!DOCTYPE html>')) {
                                    // Erfolgreich, zur Startseite weiterleiten
                                    window.location.href = '{{ route('home') }}';
                                    return {};
                                }
                                throw new Error('Keine gültige JSON-Antwort');
                            }
                        });
                    })
                    .then(data => {
                        if (data && data.error) {
                            // Fehlermeldung anzeigen
                            const alertDiv = document.createElement('div');
                            alertDiv.className = 'alert alert-danger';
                            alertDiv.textContent = data.error;

                            // Bestehende Warnungen entfernen
                            const existingAlerts = loginForm.querySelectorAll('.alert');
                            existingAlerts.forEach(alert => alert.remove());

                            // Neue Warnung einfügen
                            loginForm.insertBefore(alertDiv, loginForm.firstChild);
                        } else if (data && data.success) {
                            // Bei Erfolg zur angegebenen URL weiterleiten oder Seite neuladen
                            if (data.redirect) {
                                console.log('Weiterleitung zu:', data.redirect);
                                window.location.href = data.redirect;
                            } else {
                                console.log('Weiterleitung zur Home-Route');
                                window.location.href = '{{ route('home') }}';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Fehler:', error);

                        // Generische Fehlermeldung anzeigen
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-danger';
                        alertDiv.textContent = 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.';

                        // Bestehende Warnungen entfernen
                        const existingAlerts = loginForm.querySelectorAll('.alert');
                        existingAlerts.forEach(alert => alert.remove());

                        // Neue Warnung einfügen
                        loginForm.insertBefore(alertDiv, loginForm.firstChild);
                    });
                });
            }

            // Modal automatisch öffnen, wenn eine Fehlermeldung vorhanden ist
            @if(session('error'))
                modal.style.display = 'block';
            @endif
        });
    </script>
</body>

</html>

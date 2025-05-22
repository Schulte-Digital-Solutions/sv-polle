<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ asset('images/SV-Polle.png') }}" alt="SV Polle Logo" style="width: 200px; margin-bottom: 30px;">
        <h1>Unsere Website ist bald verfügbar</h1>
        <p>Wir arbeiten fleißig an unserer neuen Website. Bald können Sie hier alle Informationen rund um den SV Polle
            finden.</p>
        <p>Haben Sie Fragen? Kontaktieren Sie uns:</p>
        <p><strong>E-Mail:</strong> info@sv-polle.de</p>
    </div>
</body>

</html>

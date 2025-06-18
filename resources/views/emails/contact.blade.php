<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Neue Kontaktanfrage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .message {
            background-color: white;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Neue Kontaktanfrage</h1>
        </div>
        <div class="content">
            <p><strong>Von:</strong> {{ $name }}</p>
            <p><strong>E-Mail:</strong> {{ $email }}</p>
            <div class="message">
                <p><strong>Nachricht:</strong></p>
                <p>{{ $messageContent }}</p>
            </div>
        </div>
        <div class="footer">
            <p>Diese E-Mail wurde über das Kontaktformular auf svpolle.de gesendet.</p>
        </div>
    </div>
</body>
</html>

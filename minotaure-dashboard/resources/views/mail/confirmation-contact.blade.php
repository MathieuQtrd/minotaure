<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de demande de Contact</title>
</head>
<body>
    <h2>Bonjour {{ $details['name'] }}</h2>
    <p>Nous avons bien reçu votre demande de contact concernant : {{ $subject }}, et nous vous repondrons dans les meilleurs délais</p>
    <p><strong>Pour rappel, votre message  : </strong>{{ $details['message'] }}</p>
    <p>Merci de nous avoir contacté.</p>
    <p>Cordialement,<br>Notre équipe</p>
</body>
</html>
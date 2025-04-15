<!DOCTYPE html>
<html lang="fr">
<head>
    <title>{{$subject}}</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-wdfg">
</head>
<body>
@php
    $message = "Bonjour, Nous vous souhaitons une bonnée rentrée à la Coding Factory.";
    $message1 = "Afin de pouvoir accéder à votre espace voici vos informations de connexion : ";
    $messagePassword = "Votre mot de passe : 123456";
    $message2 = "Lors de votre première connexion veuillez modifier votre mot de passe.";
    @endphp
    <h4>{{$subject}}</h4>
    <br>
    <p>{{$message}}</p>
    <p>{{$message1}}</p>
    <p>{{$mailMessage}}</p>
    <p>{{$messagePassword}}</p>
    <p>{{$message2}}</p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rapport Quotidien</title>
</head>
<body>
<h1> Voici votre Rapport quotidien De vos sondages</h1>

<p>
    Il y a plus de dix raiponses a votre sondage.
</p>

<p><strong>Sondage ID :</strong> {{ $answer->survey_id }}</p>
<p><strong>Utilisateur ID :</strong> {{ $answer->user_id }}</p>
<p><strong>Réponse :</strong> {{ $answer->answer }}</p>

<hr>
<small>Mail envoyé automatiquement par le système.</small>
</body>
</html>

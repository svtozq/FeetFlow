<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Réponse au sondage</title>
</head>
<body>
<h1>Nouvelle réponse au sondage !!!!</h1>

<p>
    Une nouvelle réponse vient d'être soumise par un utilisateur.
</p>

<p><strong>Sondage ID :</strong> {{ $answer->survey_id }}</p>
<p><strong>Utilisateur ID :</strong> {{ $answer->user_id }}</p>
<p><strong>Réponse :</strong> {{ $answer->answer }}</p>

<hr>
<small>Mail envoyé automatiquement par le système.</small>
</body>
</html>

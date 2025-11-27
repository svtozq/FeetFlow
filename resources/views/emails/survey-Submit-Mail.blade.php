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


<p><strong>Sondage concerné :</strong> {{ $survey->title }}</p>

<p><strong>Utilisateur :</strong> {{ $respondent->name }}</p>


<hr>
<small>Mail envoyé automatiquement par le système.</small>
</body>
</html>

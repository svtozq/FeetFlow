<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sondage</title>
</head>
<body>
<h1>Fermeture Sondage</h1>

<p>
    Un Sondage vient d'être fermé :
</p>

<p><strong>Titre :</strong> {{ $survey->title }}</p>
<p><strong>Description :</strong> {{ $survey->description }}</p>
<p><strong>Date de début :</strong> {{ $survey->start_date }}</p>
<p><strong>Date de fin :</strong> {{ $survey->end_date }}</p>

<hr>
<small>Mail envoyé automatiquement par le système.</small>
</body>
</html>

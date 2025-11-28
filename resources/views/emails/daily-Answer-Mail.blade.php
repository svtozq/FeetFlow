<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rapport Quotidien</title>
</head>


<body>
<h1> Voici votre Rapport quotidien De vos sondages</h1>

<p>
    Bonjour {{$survey->user->name}},il y a eut plus de {{$count}} reponses a votre sondage.
</p>

<p><strong>Le sondage en question :</strong> {{ $survey->title }}</p>


@if($count >= 0)

    @foreach($answers as $answer)

        <p>reponses : {{$answer->id}}</p>

    @endforeach

@endif


<small>Mail envoyé automatiquement par le système.</small>
</body>
</html>

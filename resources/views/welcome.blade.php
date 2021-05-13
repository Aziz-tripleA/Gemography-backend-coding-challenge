<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gemography backend coding challenge</title>
</head>
<body >

@foreach($result as $language => $repos)
    <h2>{{$language}} </h2>
    <p>Number of repos using this language : {{count($repos)}}</p>
    <div>
        <p> repos using the language :</p>
        <ul>
            @foreach($repos as $repo)
                <li><a href="{{$repo->html_url}}">{{$repo->name}}</a></li>
            @endforeach
        </ul>
    </div>

    <br>
@endforeach

</body>
</html>


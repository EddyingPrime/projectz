<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $boardGame->name }}</title>
    <style>
        /* Add your styling here */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
        }

        div {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: auto;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div>
    <h1>{{ $boardGame->name }}</h1>
    
    <p>Description: {{ $boardGame->description }}</p>
    <p>Min Players: {{ $boardGame->min_players }}</p>
    <p>Max Players: {{ $boardGame->max_players }}</p>
    <!-- Add other fields as needed -->

    @if ($boardGame->image)
        <img src="{{ asset('storage/' . $boardGame->image) }}" alt="Board Game Image">
    @endif

    <!-- Add more HTML and Blade directives to display other fields -->

    <!-- Example: Display average rating if it's not null -->
    @if ($boardGame->average_rating !== null)
        <p>Average Rating: {{ $boardGame->average_rating }}</p>
    @endif
</div>

</body>
</html>

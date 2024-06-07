<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Like Page</title>
</head>
<body>
    <h1>{{ $jaime->name }}</h1>
    <p>{{ $jaime->description }}</p>

    <!-- Like button -->
    <form action="{{ route('jaime.like', $jaime->id) }}" method="POST">
        @csrf
        <button type="submit">Like</button>
    </form>

    <!-- Unlike button -->
    <form action="{{ route('jaime.unlike', $jaime->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Unlike</button>
    </form>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
</body>
</html>

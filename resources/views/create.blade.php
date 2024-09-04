@extends('layout.layout')

@section('content')
<a href="{{ route('main') }}">главная</a>
<form action="{{ route('save_film') }}" method="POST">
    @csrf
    <label for="film">
        Название фильма:
        <input type="text" name="film" id="film">
    </label>
    <label for="genre">Выберите жанр:</label>
    <select name="genre" id="genre">
        @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
        
    </select>
    <input type="submit" value="сохранить">
</form>
<br><br>
<form action="{{ route('save_actors') }}" method="POST">
    @csrf
    <label for="film_id">Выберите фильм:</label>
    <select name="film_id" id="film_id">
        @foreach ($films as $film)
            <option value="{{ $film->id }}">{{ $film->title }}</option>
        @endforeach
    </select>

    <label for="actor_id">добавить актера:</label>
    <select name="actor_id" id="actor_id">
        @foreach ($actors as $actor)
            <option value="{{ $actor->id }}">{{ $actor->name }}</option>
        @endforeach
    </select>
    
    <input type="submit" value="сохранить">
</form>
    
@endsection
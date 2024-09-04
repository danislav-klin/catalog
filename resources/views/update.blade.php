@extends('layout.layout')

@section('content')

<a href="{{ route('main') }}">главная</a>

<form action="{{ route('update_film', $film->id) }}" method="POST">
    @csrf
    @method('put')
    <label for="film">
        Название фильма:
        <input type="hidden" name="film_id" value="{{ $film->id }}">
        <input type="text" name="film" id="film" value="{{ $film->title }}">
    </label>
    <label for="genre">Выберите жанр:</label>
    <select name="genre" id="genre">
        @foreach ($genres as $genre)
            @if ($genre->id == $film->genre_id)
                <option selected value="{{ $genre->id }}">{{ $genre->name }}</option>
            @else
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endif
            
        @endforeach
        
    </select>
    <input type="submit" value="изменить">
</form>
<br><br>
<form action="{{ route('destroy_actor', $film->id) }}" method="post">
    @csrf
    @method('DELETE')
    <label>удалить актеров</label>
    @foreach ($mediators as $mediator)
        @foreach ($actors as $actor)
            @if ($mediator->actor_id == $actor->id)
                <input type="radio" name="actor" id="actor{{ $actor->id }}" value="{{ $actor->id }}">
                <label for="actor{{ $actor->id }}">{{ $actor->name }}</label>
            @endif
        @endforeach
    @endforeach
    <input type="submit" value="удалить">
</form>
<br>
<form action="{{ route('add_actors', $film->id) }}" method="post">
    @csrf
    @method('PUT')
    <label>добавить актеров</label>
    @php
        // Сначала соберем все actor_id, которые уже есть у медиаторов
        $mediatorActorIds = $mediators->pluck('actor_id')->toArray();
    @endphp

    @foreach ($actors as $actor)

        @if (!in_array($actor->id, $mediatorActorIds))
            <input type="radio" name="actor" id="actor{{ $actor->id }}" value="{{ $actor->id }}">
            <label for="actor{{ $actor->id }}">{{ $actor->name }}</label>
        @endif

    @endforeach
    <input type="submit" value="добавить">
</form>
    
@endsection
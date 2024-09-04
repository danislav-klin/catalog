@extends('layout.layout')

@section('content')

<h1 style="text-align: center;">Фильмы, жанры и актеры</h1>
<a href="{{ route('create') }}">create</a>

{{-- <form action="{{ route('sort') }}" method="get">
    @csrf
    <label for="finder">
        Найти фильм по названию
        <input type="text" name="finder" id="finder">
    </label>

    <label for="genre">Жанр:</label>
    <select id="genre" name="genre">
        @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
        
    </select> 

    <label for="genre">актеры:</label>
    <select id="genre" name="genre">
        @foreach ($actors as $actor)
            <option value="{{ $actor->id }}">{{ $actor->name }}</option>
        @endforeach
        
    </select> 

    <input type="submit" value="поиск">
</form> --}}
<form action="{{ route('sort') }}" method="post">
    @csrf
    <label for="finder_id">
        Найти фильм по ID
        <input type="number" name="finder_id" id="finder_id" value="{{ request('finder_id') }}">
    </label>

    <label for="finder">
        Найти фильм по названию
        <input type="text" name="finder" id="finder" value="{{ request('finder') }}">
    </label>

    <label for="genre">Жанр:</label>
    <select id="genre" name="genre">
        <option value="">Все жанры</option>
        @foreach ($genres as $genre)
            <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
        @endforeach
    </select> 

    <label for="actor">Актеры:</label>
    <select id="actor" name="actor">
        <option value="">Все актеры</option>
        @foreach ($actors as $actor)
            <option value="{{ $actor->id }}" {{ request('actor') == $actor->id ? 'selected' : '' }}>{{ $actor->name }}</option>
        @endforeach
    </select> 

    <input type="submit" value="поиск">

</form>

<table>
    <tr>
        <th>id</th>
        <th>title film</th>
        <th>genre</th>
        <th>actors</th>
    </tr>
    @foreach ($films as $film)
        <tr>
            <td>{{ $film->id }}</td>
            <td>{{ $film->title }}</td>
            @foreach ($genres as $genre)
                @if ($genre->id == $film->genre_id)
                    <td>{{ $genre->name }}</td>
                @endif
                
            @endforeach
            @foreach ($film->actors as $actor)
                <td>{{ $actor->name }}</td>
                
            @endforeach
            <td>
                <form action="{{ route('destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="id" value="{{ $film->id }}">
                    <button type="submit">delete</button>
                </form>
                
            </td>
            <td>
                <a href="{{ route('show', $film->id) }}">edit</a>
            </td>
            
        </tr>
        
    @endforeach
</table>
    
@endsection
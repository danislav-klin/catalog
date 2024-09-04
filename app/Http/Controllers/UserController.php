<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Mediator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // главная страница
    public function main()
    {
        $films = Film::all();
        $actors = Actor::all();
        $genres = Genre::all();
        $mediators = Mediator::all();

        return view('main', ['mediators' => $mediators, 'films' => $films, 'actors' => $actors, 'genres' => $genres]);
    }
    // страница создать

    public function create()
    {
        $genres = Genre::all();
        $films = Film::all();
        $actors = Actor::all();
        $mediators = Mediator::all();

        return view('create', ['genres' => $genres, 'films' => $films, 'actors' => $actors, 'mediators' => $mediators]);
    }
    // сохранить новый фильм
    public function save_film(Request $request)
    {
        // dd($request);
        $film = new Film();
        $film->genre_id = $request->genre;
        $film->title = $request->film;

        $film->save();

        return redirect()->route('create');
    }
    // сохранить актера

    public function save_actors(Request $request)
    {
        // dd($request);

        DB::table('mediator')->insert([
            'film_id' => $request->film_id,
            'actor_id' => $request->actor_id
        ]);

        return redirect()->route('create');
    }
    // удалить фильм

    public function destroy(Request $request)
    {
        $film = Film::find($request->id);

        $film->delete();

        return redirect()->route('main');
    }

    // показать фильм (один)
    public function show($id)
    {
        $film = Film::find($id);
        $actors = Actor::all();
        $genres = Genre::all();
        $mediators = Mediator::where('film_id', $id)->get();

        return view('update', ['film' => $film, 'genres' => $genres, 'actors' => $actors, 'mediators' => $mediators]);
    }
    // обновить фильм
    public function update_film(Request $request, $id)
    {
        $film = Film::find($request->film_id);
        $film->title = $request->film;
        $film->genre_id = $request->genre;

        $film->save();

        return redirect()->route('show', $id);
    }
    // добавить актера
    public function add_actors(Request $request, $id)
    {
        // dd($request);
        $mediator = new Mediator();
        $mediator->film_id = $id;
        $mediator->actor_id = $request->actor;
        $mediator->save();

        return redirect()->route('show', $id);
    }
    // удалить актера
    public function destroy_actor(Request $request, $id)
    {
        $actor = Mediator::where('film_id', $id)->where('actor_id', $request->actor);

        $actor->delete();

        return redirect()->route('show', $id);
    }
    // сортировка
    public function sort(Request $request)
    {
        $query = Film::query();

        // Поиск по ID фильма
        if ($request->input('finder_id')) {
            $query->orWhere('id', $request->input('finder_id'));
        }

        // Поиск по названию
        if ($request->input('finder')) {
            $query->where('title', 'like', '%' . $request->input('finder') . '%');
        }

        // Фильтрация по жанру
        if ($request->input('genre')) {
            $query->where('genre_id', $request->input('genre'));
        }

        // Фильтрация по актеру
        if ($request->input('actor')) {
            $query->whereHas('actors', function($q) use ($request) {
                $q->where('actors.id', $request->input('actor'));
            });
        }
        // Получаем отсортированные фильмы
        $films = $query->get();
        $actors = Actor::all();
        $genres = Genre::all();

        return view('finder', ['films' => $films, 'actors' => $actors, 'genres' => $genres]);
    }


}

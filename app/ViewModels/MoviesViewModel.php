<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $topMovies;
    public $nowPlayingMovies;
    public $popularMovies;
    public $genres;

    public function __construct($topMovies, $popularMovies, $nowPlayingMovies, $genres)
    {
        $this->topMovies = $topMovies;
        $this->nowPlayingMovies=$nowPlayingMovies;
        $this->popularMovies=$popularMovies;
        $this->genres = $genres;
    }
    public function topMovies()
    {
        return collect($this->formatMovies($this->topMovies))->take(5);
    }

     public function nowPlayingMovies()
     {
         return $this->formatMovies($this->nowPlayingMovies);
     }
     public function popularMovies()
     {
         return $this->formatMovies($this->popularMovies);
     }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatMovies($movies)
    {
        return collect($movies)->map(function($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres',
            ]);
        });
    }
}

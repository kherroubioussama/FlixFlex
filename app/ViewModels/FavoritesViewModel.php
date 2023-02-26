<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class FavoritesViewModel extends ViewModel
{
    public $movieResults;
    public $serieResults;
    
    public function __construct($movieResults,$serieResults)
    {
        $this->movieResults = $movieResults;
        $this->serieResults = $serieResults;
    }

    public function movieResults()
     {
         return $this->formatMovies($this->movieResults);
     }
     public function serieResults()
    {
        return $this->formatSerie($this->serieResults);
    }

    

     private function formatMovies($movies)
    {
        return collect($movies)->map(function($movie) {
            
            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => collect($movie['genres'])->pluck('name')->flatten()->implode(', '),
            ])->only([
                'poster_path', 'id', 'genres', 'title', 'vote_average', 'overview', 'release_date',
            ]);
        });
    }
    private function formatSerie($series)
    {
        return collect($series)->map(function($serie) {
            return collect($serie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$serie['poster_path'],
                'vote_average' => $serie['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($serie['first_air_date'])->format('M d, Y'),
                'genres' => collect($serie['genres'])->pluck('name')->flatten()->implode(', '),
            ])->only([
                'poster_path', 'id', 'genres', 'name', 'vote_average', 'overview', 'first_air_date',
            ]);
        });
    }

}

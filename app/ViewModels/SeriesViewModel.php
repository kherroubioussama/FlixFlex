<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class SeriesViewModel extends ViewModel
{
 
    public $topRatedSeries;
    public $popularSeries;
    public $genres;

    public function __construct($topRatedSeries, $popularSeries, $genres)
    {
       
        $this->topRatedSeries = $topRatedSeries;
        $this->popularSeries = $popularSeries;
        $this->genres = $genres;
    }

   

    public function topRatedSeries()
    {
        return collect($this->formatSerie($this->topRatedSeries))->take(5);
    }
    public function popularSeries()
    {
        return $this->formatSerie($this->popularSeries);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatSerie($series)
    {
        return collect($series)->map(function($serie) {
            $genresFormatted = collect($serie['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($serie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$serie['poster_path'],
                'vote_average' => $serie['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($serie['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            ]);
        });
    }
}

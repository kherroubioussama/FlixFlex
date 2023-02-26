<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class SerieViewModel extends ViewModel
{
        public $serie;

        public function __construct($serie)
        {
            $this->serie = $serie;
        }
    
        public function serie()
        {
            return collect($this->serie)->merge([
                'poster_path' => $this->serie['poster_path']
                    ? 'https://image.tmdb.org/t/p/w500/'.$this->serie['poster_path']
                    : 'https://via.placeholder.com/500x750',
                'vote_average' => $this->serie['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($this->serie['first_air_date'])->format('M d, Y'),
                'genres' => collect($this->serie['genres'])->pluck('name')->flatten()->implode(', '),
                'cast' => collect($this->serie['credits']['cast'])->take(5)->map(function($cast) {
                    return collect($cast)->merge([
                        'profile_path' => $cast['profile_path']
                            ? 'https://image.tmdb.org/t/p/w300'.$cast['profile_path']
                            : 'https://via.placeholder.com/300x450',
                    ]);
                }),
                'images' => collect($this->serie['images']['backdrops'])->take(9),
            ])->only([
                'poster_path', 'id', 'genres', 'name', 'vote_average', 'overview', 'first_air_date', 'credits' ,
                'videos', 'images', 'crew', 'cast', 'images', 'created_by'
            ]);
        }
}

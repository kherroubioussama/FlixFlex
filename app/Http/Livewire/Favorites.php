<?php

namespace App\Http\Livewire;

use App\ViewModels\FavoritesViewModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Favorites extends Component
{
    public $movieResults = [];
    public $serieResults = [];
    protected $listeners = [
        'favoriteDeleted' => 'updateMovieResults',
        'favoriteSerieDeleted' => 'updateSerieResults',
    ];

    public function mount()
    {
        try{
            $this->movieResults=$this->formatMovies($this->getFavoritesMovies());
        
            $this->serieResults=$this->formatSeries($this->getFavoritesSeries());
        }catch (\Exception $e) {
            // Handle the cURL error here
            return view('error.error')->with('message', 'Could not connect to API server');
        }
       
    }
    public function updateMovieResults()
    {
        $this->movieResults=$this->formatMovies($this->getFavoritesMovies());
        return redirect()->to(route('favorites.index'));
    }
    public function updateSerieResults()
    {
        $this->serieResults=$this->formatSeries($this->getFavoritesSeries());
        return redirect()->to(route('favorites.index'));
    }
    private function getFavoritesMovies(){
        $movieResults = [];
        $user = auth()->user();
        $movies = $user->favorites()->where('type', 'movie')->get();
        foreach ($movies as $movie) {
            $tmdbIds = $movie->tmdb_ids;
            foreach ($tmdbIds as $id) {
                
                $movieResult = Http::get(config('services.tmdb.endpoint') . 'movie/' . $id . '?api_key=' . config('services.tmdb.api_key') . '&append_to_response=credits,videos,images')
                    ->json();
                $movieResults[] = $movieResult;
            }
        }
        return $movieResults;
    }
    private function getFavoritesSeries(){
        $serieResults = [];
        $user = auth()->user();
        $series = $user->favorites()->where('type', 'serie')->get();
        foreach ($series as $serie) {
            $tmdbIds = $serie->tmdb_ids;
            foreach ($tmdbIds as $id) {
                $serieResult = Http::get(config('services.tmdb.endpoint') . 'tv/' . $id . '?api_key=' . config('services.tmdb.api_key') . '&append_to_response=credits,videos,images')
                    ->json();
                $serieResults[] = $serieResult;
            }
        }
        return $serieResults;
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
            ])->toArray(); // return as array
        })->toArray(); // return as array
    }
    
    private function formatSeries($series)
{
    return collect($series)->map(function($serie) {
        return [
            'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$serie['poster_path'],
            'id' => $serie['id'],
            'name' => $serie['name'],
            'vote_average' => $serie['vote_average'] * 10 .'%',
            'overview' => $serie['overview'],
            'first_air_date' => Carbon::parse($serie['first_air_date'])->format('M d, Y'),
            'genres' => collect($serie['genres'])->pluck('name')->flatten()->implode(', '),
        ];
    })->toArray();
}


    public function render()
    {
        
        return view('livewire.favorites',[
            'movieResults'=>$this->movieResults,
            'serieResults'=>$this->serieResults
        ])->extends('layouts.main')
         ->section('content');
    }
}

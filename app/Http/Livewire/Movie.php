<?php

namespace App\Http\Livewire;

use App\Models\Favori;
use Livewire\Component;

class Movie extends Component
{
    public $movie;
    public $type = 'movie';
    public $favori;

    public function mount(){
        if(auth()->check()){
            $favoriteMovies = auth()->user()->favorites()
            ->where('type', $this->type)
            ->first();
            if ($favoriteMovies) {
                $this->favori =  $favoriteMovies->isFavorited($this->movie['id']);
            } else {
                $this->favori=false;
            }
        }else{
            $this->favori=false;
        }
    }
    public function favorite()
{
    if (auth()->check()) {
        $favori = auth()->user()->favorites()
            ->where('type', $this->type)
            ->first();

        if (!$favori) {
            $favori = Favori::create([
                'user_id' => auth()->user()->id,
                'type' => $this->type,
                'tmdb_ids' => [$this->movie['id']]
            ]);
            $this->favori=true;
            $this->emit('flash', $this->movie['title'].' was added to your favorites List', 'success');
        } else {
            $tmdb_ids = $favori->tmdb_ids;
            if (in_array($this->movie['id'], $tmdb_ids)) {
                $key = array_search($this->movie['id'], $tmdb_ids);
                unset($tmdb_ids[$key]);
                $tmdb_ids = array_values($tmdb_ids);
                if (empty($tmdb_ids)) {
                    $favori->delete();
                } else {
                    $favori->update(['tmdb_ids' => $tmdb_ids]);
                }
                $this->favori=false;
                $this->emitTo('favorites','favoriteDeleted');
            } else {
                $tmdb_ids[] = $this->movie['id'];
                $favori->update(['tmdb_ids' => $tmdb_ids]);
                $this->favori=true;
                $this->emit('flash', $this->movie['title'].' was added to your favorites List', 'success');
            }
           
        }
    } else {
        $this->emit('flash', 'Please connect, to add or remove a film from your favorites', 'error');
    }
}


    public function render()
    {
        return view('livewire.movie');
    }
}

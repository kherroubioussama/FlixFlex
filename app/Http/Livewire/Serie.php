<?php

namespace App\Http\Livewire;

use App\Models\Favori;
use Livewire\Component;

class Serie extends Component
{
    public $serie;
    public $type = 'serie';
    public $favori;

    public function mount(){
        if(auth()->check()){
            $favoriteSeries = auth()->user()->favorites()
            ->where('type', $this->type)
            ->first();
            if ($favoriteSeries) {
                $this->favori =  $favoriteSeries->isFavorited($this->serie['id']);
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
                'tmdb_ids' => [$this->serie['id']]
            ]);
            $this->favori=true;
            $this->emit('flash', $this->serie['name'].' was added to your favorites List', 'success');
        } else {
            $tmdb_ids = $favori->tmdb_ids;
            if (in_array($this->serie['id'], $tmdb_ids)) {
                $key = array_search($this->serie['id'], $tmdb_ids);
                unset($tmdb_ids[$key]);
                $tmdb_ids = array_values($tmdb_ids);
                if (empty($tmdb_ids)) {
                    $favori->delete();
                } else {
                    $favori->update(['tmdb_ids' => $tmdb_ids]);
                }
                $this->favori=false;
                $this->emitTo('favorites','favoriteSerieDeleted');
            } else {
                $tmdb_ids[] = $this->serie['id'];
                $favori->update(['tmdb_ids' => $tmdb_ids]);
                $this->favori=true;
                $this->emit('flash', $this->serie['name'].' was added to your favorites List', 'success');
            }
           
        }
    } else {
        $this->emit('flash', 'Please connect, to add or remove a film from your favorites', 'error');
    }
}

    public function render()
    {
        return view('livewire.serie');
    }
}

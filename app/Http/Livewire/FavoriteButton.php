<?php

namespace App\Http\Livewire;

use App\Models\Favori;
use Livewire\Component;

class FavoriteButton extends Component
{
    public $type; // 'movie' or 'serie'
    public $tmdbId;

    public $isFavorite;

    public function mount($type, $tmdbId)
    {
        $this->type = $type;
        $this->tmdbId = $tmdbId;

        $user = auth()->user();
        if ($user) {
            $favorite = $user->favorites()
                ->where('type', $this->type)
                ->whereJsonContains('tmdb_ids', $this->tmdbId)
                ->first();

            $this->isFavorite = ($favorite !== null);
        } else {
            $this->isFavorite = false;
        }
    }

    public function toggleFavorite()
    {
        $user = auth()->user();
        if ($user) {
            if ($this->isFavorite) {
                // Remove from favorites
                $favorite = $user->favorites()
                    ->where('type', $this->type)
                    ->whereJsonContains('tmdb_ids', $this->tmdbId)
                    ->firstOrFail();
                $favorite->tmdb_ids = array_values(array_diff($favorite->tmdb_ids, [$this->tmdbId]));
                if (count($favorite->tmdb_ids) === 0) {
                    $favorite->delete();
                } else {
                    $favorite->save();
                }
            } else {
                // Add to favorites
                $favorite = $user->favorites()
                    ->where('type', $this->type)
                    ->first();
                if ($favorite === null) {
                    $favorite = new Favori();
                    $favorite->user_id = $user->id;
                    $favorite->type = $this->type;
                    $favorite->tmdb_ids = [$this->tmdbId];
                    $favorite->save();
                } else {
                    $favorite->tmdb_ids = array_merge($favorite->tmdb_ids, [$this->tmdbId]);
                    $favorite->save();
                }
            }

            $this->isFavorite = !$this->isFavorite;
        }
    }

    public function render()
    {
        return view('livewire.favorite-button');
    }
}

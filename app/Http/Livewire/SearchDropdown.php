<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) >= 2) {
            // Search movies
            $movieResults = Http::get(config('services.tmdb.endpoint') . 'search/movie?api_key=' . config('services.tmdb.api_key') . '&query=' . $this->search)
                ->json()['results'];
            // Search TV series
            $tvResults = Http::get(config('services.tmdb.endpoint') . 'search/tv?api_key=' . config('services.tmdb.api_key') . '&query=' . $this->search)
                ->json()['results'];

            // Merge the movie and TV series results into one array
            $searchResults = array_merge($movieResults, $tvResults);
        }

        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(8),
        ]);
    }
}

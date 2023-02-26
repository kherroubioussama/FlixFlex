<?php

namespace App\Http\Controllers;

use App\ViewModels\SeriesViewModel;
use App\ViewModels\SerieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $topSeries=Http::get(config('services.tmdb.endpoint').'tv/top_rated?api_key='.config('services.tmdb.api_key'))
            ->json()['results'];
            $popularSeries=Http::get(config('services.tmdb.endpoint').'tv/popular?api_key='.config('services.tmdb.api_key'))
            ->json()['results'];
            $genres=Http::get(config('services.tmdb.endpoint').'genre/tv/list?api_key='.config('services.tmdb.api_key'))
            ->json()['genres'];
            
            $viewModel = new SeriesViewModel(
                $topSeries,
                $popularSeries,
                $genres,
            );
        
        } catch (\Exception $e) {
            // Handle the cURL error here
            return view('error.error')->with('message', 'Could not connect to API server');
        }
        
        return view('series.index', $viewModel);
    }

   
    public function show($id)
    {
        $movie=Http::get(config('services.tmdb.endpoint').'tv/'.$id.'?api_key='.config('services.tmdb.api_key').'&append_to_response=credits,videos,images')
        ->json();
        $viewModel = new SerieViewModel($movie);
        return view('series.show',$viewModel);
    }

}

@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="top-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
               @foreach ($topMovies as $movie)
                    <livewire:movie :movie="$movie" />
                    {{-- <x-movie-card :movie="$movie" /> --}}
                @endforeach

            </div>
        </div> <!-- end top-movies -->
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Movies</h2>
            @foreach ($popularMovies->chunk(10) as $moviesChunk)
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($moviesChunk as $movie)
                            <div class="swiper-slide">
                                <div class="serie-grid">

                                    <livewire:movie :movie="$movie" />
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination swiper-pagination-white"></div>
                    <div class="swiper-scrollbar"></div>
                </div>
            @endforeach
        </div> <!-- end pouplar-movies -->

        <div class="now-playing-movies py-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Now Playing</h2>
            
                @foreach ($nowPlayingMovies->chunk(10) as $moviesChunk)
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($moviesChunk as $movie)
                            <div class="swiper-slide">
                                <div class="serie-grid">

                                    <livewire:movie :movie="$movie" />
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination swiper-pagination-white"></div>
                    <div class="swiper-scrollbar"></div>
                </div>
                @endforeach
           
        </div> <!-- end now-playing-movies -->
    </div>
@endsection
@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="top-rated-series">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated Series</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($topRatedSeries as $serie)
                    <livewire:serie :serie="$serie" />
                    {{-- <x-serie-card :serie="$serie" /> --}}
                @endforeach
            </div>
        </div> <!-- end top-rated-series -->
        <div class="popular-series">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Series</h2>
            @foreach ($popularSeries->chunk(10) as $seriesChunk)
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($seriesChunk as $serie)
                            <div class="swiper-slide">
                                <div class="serie-grid">

                                    <livewire:serie :serie="$serie" />
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination swiper-pagination-white"></div>
                    <div class="swiper-scrollbar"></div>
                </div>
            @endforeach
        </div> <!-- end popular-tv -->
    </div>
@endsection

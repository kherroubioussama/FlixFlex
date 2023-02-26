<div class="container mx-auto py-4">
    <div class="container mx-auto px-4 pt-8">
        <div class="favorite-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">My favorite Movies</h2>
           
                @if (count($movieResults) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($movieResults as $movie)
                        <livewire:movie :movie="$movie" />
                    @endforeach
                </div>
                @else
                    <div class="py-4 px-6">
                        <div class="border border-primary text-white bg-primary  font-semibold py-3 px-2">
                            <p>No movies are favorited.</p>
                        </div>
                    </div>

                @endif

           
        </div> <!-- end favorite-movies -->
        <div class="favorite-series pt-2">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">My favorite Series</h2>
           
                @if (count($serieResults) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($serieResults as $serie)
                <livewire:serie :serie="$serie" />
            @endforeach
                </div>
                @else
                    <div class="py-4 px-6">
                        <div class="border border-primary text-white bg-primary  font-semibold py-3 px-2">
                            <p>No series are favorited.</p>
                        </div>
                    </div>

                @endif
                
        </div> <!-- end favorite-series -->
    </div>

</div>

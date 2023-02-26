<div class="mt-8">
    <div class="relative">
        <a href="{{ route('series.show', $serie['id']) }}">
            <img src="{{ $serie['poster_path'] }}" alt="poster" class="image hover:opacity-75 transition ease-in-out duration-150">
        </a>
        <div class="absolute top-0 right-0 mt-2 mr-2">
            <button class="{{ $favori ? 'text-red-400 hover:text-white' : 'text-white hover:text-red-400' }} focus:outline-none" wire:click="favorite">
                <svg class="w-10 h-10 fill-current" viewBox="0 0 24 24"  stroke="grey-300">
                    <path d="M16.5,3a5.5,5.5,0,0,0-5.5,5.5c0,1.58.92,3.77,2.46,5.79l2,2.22a.8.8,0,0,0,1.12,0l2-2.22c1.54-2,2.46-4.21,2.46-5.79A5.5,5.5,0,0,0,16.5,3ZM12,19.94l-.87-.93C8.92,16.83,7.5,14.06,7.5,11.5A3.5,3.5,0,0,1,11,8.15L12,9.16l1-1.01a3.5,3.5,0,0,1,3.5,6.05L12,19.94Z"/>
                </svg>
            </button>
            
        </div>
    </div>
    <div class="mt-2 flex justify-between items-center">
        <a href="{{ route('series.show', $serie['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $serie['name'] }}</a>
    </div>
    <div class="flex items-center text-gray-400 text-sm mt-1">
        <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
        <span class="ml-1">{{ $serie['vote_average'] }}</span>
        <span class="mx-2">|</span>
        <span>{{ $serie['first_air_date'] }}</span>
    </div>
    <div class="text-gray-400 text-sm">{{ $serie['genres'] }}</div>
</div>
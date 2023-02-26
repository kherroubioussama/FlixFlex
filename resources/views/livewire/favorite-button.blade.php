<div class="absolute top-0 right-0 mt-2 mr-2">
    <button class="{{ $isFavorite ? 'text-red-400 hover:text-white' : 'text-white hover:text-red-400' }} focus:outline-none" wire:click="toggleFavorite">
        <svg class="w-10 h-10 fill-current" viewBox="0 0 24 24"  stroke="grey-300">
            <path d="M16.5,3a5.5,5.5,0,0,0-5.5,5.5c0,1.58.92,3.77,2.46,5.79l2,2.22a.8.8,0,0,0,1.12,0l2-2.22c1.54-2,2.46-4.21,2.46-5.79A5.5,5.5,0,0,0,16.5,3ZM12,19.94l-.87-.93C8.92,16.83,7.5,14.06,7.5,11.5A3.5,3.5,0,0,1,11,8.15L12,9.16l1-1.01a3.5,3.5,0,0,1,3.5,6.05L12,19.94Z"/>
        </svg>
    </button>
</div>

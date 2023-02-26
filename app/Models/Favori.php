<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favori extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','type', 'tmdb_ids'];

    protected $casts = [
        'tmdb_ids' => 'array'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites(){
        return $this->belongsToMany(User::class);
    }

    public function isFavorited($tmdbId){
        if (auth()->check()){
            return $this->where('user_id', auth()->id())
            ->whereJsonContains('tmdb_ids', $tmdbId)
            ->exists();
        }
        
    }
}

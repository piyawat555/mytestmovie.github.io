<?php

namespace App\ViewModels;
use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;
// use App\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public function __construct($movie)
    {
        $this->movie = $movie;
    }
    public function movie(){
        return collect($this->movie)->merge([
                 'poster_path'=> 'https://image.tmdb.org/t/p/w500'.$this->movie['poster_path'],
                'vote_average'=>$this->movie['vote_average'] * 10 . '%',
                'release_date'=>Carbon::parse($this->movie['release_date'])->format('M d, y'),
                'genres'=>collect($this->movie['genres'])->pluck('name')->flatten()->implode(','),
                'crew'=>collect($this->movie['credits']['crew'])->take(2),
                'cast'=>collect($this->movie['credits']['cast'])->take(5)->map(function($cast){
                    return collect($cast)->merge([
                        'profile_path' => $cast['profile_path']
                            ? 'https://image.tmdb.org/t/p/w300'.$cast['profile_path']
                            : 'https://via.placeholder.com/300x450',
                            ]);
                }),
                'image'=>collect($this->movie['images']['backdrops'])->take(9),
        ])->only([
          'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres','crew','cast','image','videos',
         ]);
    }
}

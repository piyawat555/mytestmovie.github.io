<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Carbon;
class TvViewModel extends ViewModel
{
    public $popularTv;
    public $topRatetv;
    public $genres;
    public function __construct($popularTv,$topRatetv,$genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatetv =$topRatetv;
        $this->genres=$genres;
    }

    public function popularTv(){
        return $this->formatTv($this->popularTv);
    }
    public function topRatetv(){
        return $this->formatTv($this->topRatetv);
    }

    public function genres(){
            return collect($this->genres)->mapWithKeys(function($genres){
            return [$genres['id']=>$genres['name']];
        });
    }

    public function formatTv($tv){

        // return collect($tv)->map(function($tvshow){
        //     return $tvshow;
        // })->dump();
        return collect($tv)->map(function($tvshow){
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            return collect($tvshow)->merge([
                'poster_path'=> 'https://image.tmdb.org/t/p/w500'.$tvshow['poster_path'],
                'vote_average'=>$tvshow['vote_average'] * 10 . '%',
                'first_air_date'=>Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres'=>$genresFormatted,
                 ])->only([
                   'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
                 ]);
        });
    }
}

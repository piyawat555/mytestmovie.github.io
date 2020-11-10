<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $social;
    public $credits;
    public function __construct($actor,$social,$credits)
    {
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function actor(){
        return collect($this->actor)->merge([
            'birthday'=>Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age'=>Carbon::parse($this->actor['birthday'])->age,
            'profile_path'=>$this->actor['profile_path'] ? 'https://image.tmdb.org/t/p/w500'.$this->actor['profile_path']
            : 'https://viaplaceholder.com/300x450',
        ]);
    }

    public function social(){
        return collect($this->social)->merge([
            'twitter' => $this->social['twitter_id'] ? 'https://twitter.com/'.$this->social['twitter_id']: null,
            'instagram' => $this->social['instagram_id'] ? 'https://instagram.com/'.$this->social['instagram_id']: null,
            'facebook' => $this->social['facebook_id'] ? 'https://facebook.com/'.$this->social['facebook_id']: null,
        ]);
    }

    public function KnowforMovie(){

            $castMovie = collect($this->credits)->get('cast');
            return collect($castMovie)->sortByDesc('popularity')->take(5)->map(function($cast){
                if(isset($cast['title'])){
                   $title = $cast['title'];
                }else if(isset($cast['name'])){
                    $title = $cast['name'];
                }else{
                    $title = 'Untitled';
                }
                return collect($cast)->merge([
                    'poster_path'=>$cast['poster_path'] ?
                    'https://image.tmdb.org/t/p/w185'.$cast['poster_path'] :
                    'https://via.placeholder.com/185x278',
                    'title' => $title,
                    'linkToPage' =>$cast['media_type'] === 'movie' ? route('movies.show', $cast['id']) : route('tv.show',$cast['id'])
                ])->only([
                    'poster_path','title','id','media_type','linkToPage'
                ]);
            });
    }
    public function credits(){

        $dateMovie = collect($this->credits)->get('cast');
        return collect($dateMovie)->map(function($date){
            if(isset($date['release_date'])){
                $releaseDate = $date['release_date'];
            }else if (isset($date['first_air_date'])){
                $releaseDate = $date['first_air_date'];
            }else{
                $releaseDate = '';
            }

            if(isset($date['title'])){
                $title = $date['title'];
            }else if(isset($date['name'])){
                $title = $date['name'];
            }else{
                $title = 'Untitled';
            }

            return collect($date)->merge([
                'release_date'=> $releaseDate,
                'release_year'=> isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title'=>$title,
                'character'=>isset($date['character']) ? $date['character'] : '',
            ]);
        })->sortByDesc('release_date');
        }
}

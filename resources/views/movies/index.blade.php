@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movie">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">ภาพยนต์ยอดนิยม</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularMovies as $popularMovie)
               <x-movie-card :popularMovie="$popularMovie" />
                @endforeach
            </div>
        </div>

        <div class="now-playing-movies py-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">กำลังฉายตอนนี้</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($nowPlayingMovies as $popularMovie)
                <x-movie-card :popularMovie="$popularMovie" />
                @endforeach
            </div>
        </div>
    </div>
@endsection

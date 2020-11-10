@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-tv">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">ซีรีย์ยอดนิยม</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularTv as $tvshow)
                <x-tv-card :tvshow="$tvshow" />
                 @endforeach
            </div>
        </div>

        <div class="now-playing-tv py-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">อันดับซีรีย์ยอดนิยม</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($topRatetv as $tvshow)
                <x-tv-card :tvshow="$tvshow" />
                 @endforeach
            </div>
        </div>
    </div>
@endsection

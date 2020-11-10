@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-green-800">
        <div class="container mx auto px-4 py-16 flex flex-col md:flex-row">
           <img src="{{$movie['poster_path']}}" class="w-64 md:w-96">
            <div class="md:ml-24">
              <h2 class="text-4xl font-semibold">ชื่อเรื่อง : {{$movie['title']}}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <svg class="fill-current text-orage-500 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 47.94 47.94"><path d="M26.285 2.486l5.407 10.956a2.58 2.58 0 001.944 1.412l12.091 1.757c2.118.308 2.963 2.91 1.431 4.403l-8.749 8.528a2.582 2.582 0 00-.742 2.285l2.065 12.042c.362 2.109-1.852 3.717-3.746 2.722l-10.814-5.685a2.585 2.585 0 00-2.403 0l-10.814 5.685c-1.894.996-4.108-.613-3.746-2.722l2.065-12.042a2.582 2.582 0 00-.742-2.285L.783 21.014c-1.532-1.494-.687-4.096 1.431-4.403l12.091-1.757a2.58 2.58 0 001.944-1.412l5.407-10.956c.946-1.919 3.682-1.919 4.629 0z" fill="#ed8a19"/></svg>
                    <span class="pl-2">คะแนนเฉลี่ย</span>
                    <span class="ml-1">{{$movie['vote_average']}}</span>
                    <span class="mx-2">|</span>
                    <span>วันที่ฉาย {{$movie['release_date']}}</span>
                    <span class="mx-2">|</span>
                     <span>
                        ประเภทภาพยนต์ {{$movie['genres']}}
                    </span>
                </div>
                <p class="text-gray-300 mt-8">
                    เรื่องย่อ : {{$movie['overview']}}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">นักแสดงแนะนำ</h4>
                    <div class="flex mt-4">
                        @foreach ($movie['crew'] as $crew)
                            <div class="mr-8">
                                <div>{{$crew['name']}}</div>
                            <div class="text-sm text-gray-400">{{$crew['job']}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
             <div>
        </div>
                    <div x-data="{ isOpen: false }">
                        @if (count($movie['videos']['results']) > 0)
                        <div class="mt-12">
                            <button
                                @click="isOpen = true"
                                class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150"
                            >
                                <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                <span class="ml-2">ตัวอย่างภาพยนต์</span>
                            </button>
                        </div>

                        <template x-if="isOpen">
                            <div
                                style="background-color: rgba(0, 0, 0, .5);"
                                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                            >
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button
                                                @click="isOpen = false"
                                                @keydown.escape.window="isOpen = false"
                                                class="text-3xl leading-none hover:text-gray-300">&times;
                                            </button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        @else
                        <div class="mt-8">
                            <button
                            class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150"
                        >
                            <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                            <span class="ml-2">ไม่มีตัวอย่างภาพยนต์</span>
                        </button>
                        </div>
                    @endif


                    </div>

                </div>
    </div>
</div>


<div class="movie-cast border-b border-green-800">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">นักแสดง</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($movie['cast'] as $cast)
                <div class="mt-8">
                    <a href="{{ route('actors.show', $cast['id']) }}">
                        <img src="{{ $cast['profile_path'] }}" alt="actor1" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</a>
                        <div class="text-sm text-gray-400">
                            {{ $cast['character'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>



    <div class="movie-images"x-data="{isOpen: false, image: ''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">รูปเกี่ยวกับภาพยนต์</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($movie['image'] as $image)
                <div class="mt-8">
                    <a
                    @click.prevent=
                    "isOpen = true
                    image='{{'https://image.tmdb.org/t/p/original/'.$image['file_path']}}'
                    "
                    href=""
                    >
                    <img src="{{'https://image.tmdb.org/t/p/w500/'.$image['file_path']}}" alt="">
                    </a>
                </div>
                @endforeach
            </div>

                    <div
                                        style="background-color: rgba(0, 0, 0, .5);"
                                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                                        x-show="isOpen"

                                       >
                                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                            <div class="bg-gray-900 rounded">
                                                <div class="flex justify-end pr-4 pt-2">
                                                    <button
                                                    @click="isOpen = false"
                                                        class="text-3xl leading-none hover:text-gray-300">&times;
                                                    </button>
                                                </div>
                                                <div class="modal-body px-8 py-8">
                                                        <img :src="image" alt="poster">
                                                </div>
                                            </div>
                                        </div>
                     </div>

        </div>
    </div>

@endsection

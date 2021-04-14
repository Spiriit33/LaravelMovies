<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie App</title>

    <link rel="stylesheet" href="/css/main.css">
    <livewire:styles>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="font-sans bg-gray-900 text-white">
    <nav class="border-b border-gray-800">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between px-4 py-6">
            <ul class="flex flex-col md:flex-row items-center">
                <li>
                    <a href="{{ route('movies.index') }}" style="font-weight: bold;">LaravelMovies
                    </a>
                </li>
                <li class="md:ml-16 mt-3 md:mt-0">
                    <a href="{{ route('movies.index') }}" class="hover:text-gray-300">Films</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{ route('tv.index') }}" class="hover:text-gray-300">Series</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{ route('actors.index') }}" class="hover:text-gray-300">Acteurs</a>
                </li>
                <div class="p-10">

                    <div class="dropdown inline-block relative">
                        <button class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
                            <span class="mr-1">Genres</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                        </button>
                        <ul class="dropdown-menu bg-dark absolute hidden text-gray-700 pt-1 p-3" style="background:#1a202c;">
                            @if(isset($genres))
                            @foreach ($genresHead as $genre)
                            <li class=""><a class="rounded-t hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{route('movies.genres',$genre['id'])}}">{{$genre}}</a></li>
                                @endforeach
                                @endif
                        </ul>
                    </div>

                </div>
            </ul>
            <style>
                .dropdown:hover .dropdown-menu {
                    display: block;
                }
            </style>
            <div class="flex flex-col md:flex-row items-center">
                <livewire:search-dropdown>
            </div>
        </div>
    </nav>
    @yield('content')
    <livewire:scripts>
    @yield('scripts')
</body>
</html>

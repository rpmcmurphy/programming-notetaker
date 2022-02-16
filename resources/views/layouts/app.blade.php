<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">

    <link href="{{ asset('css/prism.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Programming-Notes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav main-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('cats')) ? 'active' : '' }}" href="{{ route('cats.index') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('cats/create')) ? 'active' : '' }}" href="{{ route('cats.create') }}">Add category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('tags')) ? 'active' : '' }}" href="{{ route('tags.index') }}">Tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('tags/create')) ? 'active' : '' }}" href="{{ route('tags.create') }}">Add tag</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('notes')) ? 'active' : '' }}" href="{{ route('notes.index') }}">Notes list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('notes/create')) ? 'active' : '' }}" href="{{ route('notes.create') }}">Create note</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>{{-- ./navbar --}}

    <div class="container content">
        <div class="row">
            <div class="col-md-6 py-4 mt-3">
                <h4>@yield('title')</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
    </div>{{-- ./container --}}

    <div class="bottom-spacer"></div>

    <div class="container-fluid bg-primary">
        <div class="row">
            <div class="col-12">
                <div class="footer">
                    <p class="footer-copyright">
                        Made by rparbez
                    </p>
                </div>
            </div>
        </div>
    </div>{{-- ./container --}}

    <script src="{{ asset('js/prism.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
</body>

</html>

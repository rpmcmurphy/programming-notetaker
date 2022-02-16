@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="row">
    <div class="col-12">
        @if ($message = Session::get('message'))
            <div class="alert alert-success alert-block">
                {{ $message }}
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <ul class="list-group">
            @if(count($cats) > 0)
                @foreach($cats as $cat)
                    <li class="list-group-item">
                        <a href="{{ route('cats.show', $cat->id) }}" class="">{{ $cat->name }}</a>
                    </li>
                @endforeach
            @else
                <p>No categories yet</p>
            @endif
        </ul>
    </div>
    @if(count($cats) > 0)
    <div class="col-12 col-md-6 my-3 my-md-0">
        <div class="bg-primary py-3 px-3 text-white">
            Clcik to view or edit.
        </div>
    </div>
    @endif
</div>
@endsection
@extends('layouts.app')

@section('title', 'Home')

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
        <form action="{{ route('search') }}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="cat">Category</label>
                <select name="cat" id="cat" class="form-control">
                    <option value="">Select category (not mandatory)</option>
                    @foreach ($cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="tag">Tag</label>
                <select name="tag" id="tag" class="form-control">
                    <option value="">Select tag (not mandatory)</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="term" id="term" placeholder="Search by text, category">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        <ul class="list-group">
            @if(count($notes) > 0)
                @foreach($notes as $note)
                    <li class="list-group-item">
                        <a href="{{ route('notes.show', $note->id) }}" class="">{{ $note->note_name }}</a>
                    </li>
                @endforeach
            @else
                <p>No details yet</p>
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

<div class="row mt-3">
    <div class="col-12">
        {{ $notes->links() }}
    </div>
</div>

@endsection
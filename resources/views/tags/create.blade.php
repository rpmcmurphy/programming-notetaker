@extends('layouts.app')

@section('title', 'Create tag')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            {{-- create tag --}}
            <form class="" method="POST" action="{{ route('tags.store') }}">
                @csrf
                <div class="form-group mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tag-name">
                        Tag name
                    </label>
                    <input
                        class="form-control"
                        id="tag-name" type="text" name="tag_name" placeholder="Tag name">
                </div>
                <div class="flex items-center justify-between">
                    <input class="btn btn-primary" type="submit" placeholder="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection

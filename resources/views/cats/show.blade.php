@extends('layouts.app')

{{-- @section('title', 'Topic detail') --}}

@section('content')
    <div class="row">
        <div class="col-12 col-md-8">
            <h5 class="d-flex align-items-center justify-content-between mb-3">
                <span>{{ $cat->name }}</span>
                <a href="{{ route('cats.index') }}" class="text-muted text-small d-block mx-2">Back to categories</a>
            </h5>

            <form class="bg-white px-8 pt-6 pb-8 mb-4" method="POST"
                action="{{ route('cats.update', $cat->id) }}">
                @csrf
                <div class="form-group mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="category-name">
                        Topic name
                    </label>
                    <input class="form-control" id="category-name" type="hidden" name="id" value="{{ $cat->id }}">
                    <input class="form-control" id="category-name" type="text" name="cat_name" value="{{ $cat->name }}" placeholder="{{ $cat->name }}">
                </div>
                <div class="flex items-center justify-between">
                    <input class="btn btn-info " type="submit" placeholder="Submit">
                </div>
            </form>

            <hr>

            <form class="" role="form" method="POST"
                action="{{ route('cats.destroy', $cat->id) }}">
                @csrf

                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endsection

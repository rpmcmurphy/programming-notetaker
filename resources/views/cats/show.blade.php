@extends('layouts.app')

{{-- @section('title', 'Cat detail') --}}

@section('content')
    <div class="row">
        <div class="col-12">
            @if ($message = Session::get('message'))
                <div class="alert alert-success alert-block">
                    {{ $message }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
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
                        Category name
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

                <button onclick="return confirm('Are you sure you want to delete this item?')" type="submit" class="btn btn-danger">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endsection

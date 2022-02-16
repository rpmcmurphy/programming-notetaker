@extends('layouts.app')

@section('title', 'Create category')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            {{-- create category --}}
            <form class="" method="POST" action="{{ route('cats.store') }}">
                @csrf
                <div class="form-group mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="category-name">
                        Category name
                    </label>
                    <input
                        class="form-control"
                        id="category-name" type="text" name="cat_name" placeholder="Category name">
                </div>
                <div class="flex items-center justify-between">
                    <input class="btn btn-primary" type="submit" placeholder="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection

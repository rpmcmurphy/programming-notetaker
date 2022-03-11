@extends('layouts.app')

@section('title', 'Create notes')

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
        <div class="col-12 col-md-6">
            <form class="bg-white px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data" >
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="note-name">
                        Note name
                    </label>
                    <input
                        class="form-control"
                        id="note-name" type="text" name="note_name" placeholder="Note name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cat_ids">
                        Category
                    </label>
                    <select class="form-control" name="cat_ids[]" id="cat_ids" multiple="">
                        <option value="">Select categories</option>
                        @foreach($cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tag_ids">
                        Tag
                    </label>
                    <select class="form-control" name="tag_ids[]" id="tag_ids" multiple="">
                        <option value="">Select tags</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="note_text">
                        Note text
                    </label>
                    <textarea class="form-control d-none" name="note_text" id="note_text" cols="30" rows="10" placeholder="Note text"></textarea>
                    <div id="editor-container"></div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="note_codes">
                        Note codes
                    </label>
                    <textarea class="form-control" name="note_codes" id="note_codes" cols="30" rows="10" placeholder="Note codes"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="note-lang">
                        Note language
                    </label>
                    <input class="form-control" id="note-lang" type="text" name="note_lang" placeholder="Note code language, i.e, javascript">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="links">
                        Links
                    </label>
                    <textarea class="form-control" name="links" id="links" cols="30" rows="10" placeholder="Note links"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Images/Files
                    </label>
                    <input class="form-control" type="file" name="files_images[]" multiple>
                </div>
                <div class="flex items-center justify-between">
                    <input
                        class="btn btn-primary" type="submit" placeholder="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#cat_ids").select2({
                multiple: true,
                tags: true,
                placeholder: "Select category",
            });
            $("#tag_ids").select2({
                multiple: true,
                tags: true,
                placeholder: "Select tag",
            });
        });
    </script>
@endsection
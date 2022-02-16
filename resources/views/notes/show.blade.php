@extends('layouts.app')

@section('title', 'Notes detail')

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
                <span>{{ $notes->note_name }}</span>
                <a href="{{ route('notes.index') }}" class="text-muted text-small d-block mx-2">Back to list</a>
            </h5>

            <form class="bg-white px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('notes.update', $notes->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="note-name">
                        Note name
                    </label>
                    <input class="form-control" id="note-id" type="hidden" name="id" value="{{ $notes->id }}">
                    <input class="form-control" id="note-name" type="text" name="note_name" value="{{ $notes->note_name }}" 
                        placeholder="{{ $notes->note_name }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cat_ids">
                        Category
                    </label>
                    <select class="form-control" name="cat_ids[]" id="cat_ids" multiple="">
                        <option value="">Select category</option>
                        @foreach($cats as $cat)
                            <option value="{{ $cat->id }}" @if(in_array( $cat->id, $notes->cats->pluck('id')->toArray())) selected="" @endif>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tag_ids">
                        Tag
                    </label>
                    <select class="form-control" name="tag_ids[]" id="tag_ids" multiple="">
                        <option value="">Select tag</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" @if(in_array( $tag->id, $notes->tags->pluck('id')->toArray())) selected="" @endif>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="note_text">
                        Note text
                    </label>
                    <textarea class="form-control" name="note_text" id="note_text" cols="30" rows="10" placeholder="Note text">{{ $notes->note_text }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="note_codes">
                        Note codes
                    </label>
                    <textarea class="form-control" name="note_codes" id="note_codes" cols="30" rows="10" placeholder="Note codes">{{ $notes->note_codes }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="note-lang">
                        Note language
                    </label>
                    <input class="form-control" id="note-lang" type="text" name="note_lang" value="{{ $notes->note_lang }}" 
                        placeholder="Note code language, i.e, javascript">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="links">
                        Links
                    </label>
                    <textarea class="form-control" name="links" id="links" cols="30" rows="10" placeholder="Note links">{{ $notes->links }}</textarea>
                </div>
                <div class="mb-4">
                    <div class="row">
                        @if($notes->files_images)
                            @foreach(json_decode($notes->files_images) as $file)
                                <div class="col-12 col-md-4 mb-4">
                                    <div class="image-card card mb-4">
                                        <div class="card-body d-flex align-items-center justify-content-center pb-0">
                                            @switch($type = pathinfo($file, PATHINFO_EXTENSION))
                                                @case('jpg')
                                                @case('jpeg')
                                                @case('png')
                                                @case('gif')
                                                @case('bmp')
                                                    <img class="detail-files" src="{{ asset('storage/' . $file) }}" alt="{{ $notes->note_name }}" class="img-fluid">
                                                    @break
                                                @case('pdf')
                                                    <i class="far fa-file-pdf fa-5x text-danger"></i>
                                                    @break
                                                @case('doc')
                                                @case('docx')
                                                    <i class="far fa-file-word fa-5x text-primary"></i>
                                                    @break
                                                @default
                                                    <i class="far fa-file fa-5x text-info"></i>
                                            @endswitch
                                            <div class="d-flex flex-wrap justify-content-between w-100 mt-auto">
                                                <a class="btn btn-info btn-small mr-1 mb-3" href="{{ route('download', base64_encode('storage/' . $file)
                                                ) }}">Downlaod</a>
                                                <button class="btn btn-danger btn-small mb-3 delete-image" data-note_id="{{ $notes->id }}" data-file_link="{{ $file }}">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="flash-message mt-3"></div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="notes-name">
                        Images/Files
                    </label>
                    <input class="form-control" type="file" name="files_images[]" multiple>
                </div>
                <div class="flex items-center justify-between">
                    <input class="btn btn-info" type="submit" placeholder="Submit">
                </div>
            </form>

            <hr>

            <form class="text-right" role="form" method="POST"
                action="{{ route('notes.destroy', $notes->id) }}">
                @csrf

                <button onclick="return confirm('Are you sure you want to delete this item?')" type="submit" class="btn btn-danger">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <hr>

    <div class="conatiner">
        <div class="row">
            <div class="col-md-12">
                <pre><code class="language-{{ $notes->note_lang }}">{{ $notes->note_codes }}</code></pre>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#cat_ids").select2({
                multiple: true,
                tags: true,
                placeholder: "Select categories",
            });

            $("#tag_ids").select2({
                multiple: true,
                tags: true,
                placeholder: "Select tags",
            });

            $('.delete-image').click(function(e) {
                e.preventDefault();

                var note_id = $(this).data('note_id');
                var file_link = $(this).data('file_link');

                var that = $(this);

                $.ajax({
                    url: '{{ route('notes.delete_file') }}',
                    type: 'POST',
                    data: {
                        note_id: note_id,
                        file_link: file_link,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if(data.error == false) {
                            that.closest('.col-md-4').remove();
                            $('.flash-message').html('<div class="alert alert-success">' + data.message + '</div>');
                            setTimeout(() => {
                                $('.flash-message').html('');
                            }, 2500);
                        }
                    }
                });
            });
        });
    </script>
@endsection

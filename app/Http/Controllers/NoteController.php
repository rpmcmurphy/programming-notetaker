<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Tag;
use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class NoteController extends Controller
{
    // create resourceful controller methods
    public function index()
    {
        // return all notes
        $notes = Note::orderBy('created_at', 'DESC')->paginate(10);
        $cats = Cat::all();
        $tags = Tag::all();

        return view('notes.index', ['notes' => $notes, 'cats' => $cats, 'tags' => $tags]);
    }

    public function create()
    {
        // cat create form 

        $cats = Cat::all();
        $tags = Tag::all();
        return view('notes.create', ['cats' => $cats, 'tags' => $tags]);
    }

    public function store(Request $request)
    {
        // Store a note
        $this->validate($request, [
            'note_name' => 'required|min:3',
        ]);

        $notes = new Note();

        $notes->note_name = $request->note_name;
        $notes->note_text = $request->note_text;
        $notes->note_codes = $request->note_codes;
        $notes->note_lang = $request->note_lang;
        $notes->links = $request->links;

        if ($request->hasFile('files_images')) {

            $allowedfileExtension = ['pdf', 'jpg', 'png', 'gif', 'bmp', 'docx'];
            $files = $request->file('files_images');

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                $filename_without_ext = pathinfo($filename, PATHINFO_FILENAME);

                if ($check) {
                    $filename = $file->storeAs('files_images', $filename_without_ext . '_' . Str::random(5) . '.' .  $extension, 'public');
                    if ($filename) {
                        $stored_filenames[] = $filename;
                    }
                } else {
                    return Redirect::route('notes.create')->with('message', 'Your file extension is not allowed.');
                }
            }

            $notes->files_images = json_encode($stored_filenames);
        }

        $notes->save();

        $created_note = Note::find($notes->id);
        $created_note->cats()->attach($request->cat_ids);
        $created_note->tags()->attach($request->tag_ids);

        return Redirect::route('notes.index')->with('message', 'Your notes has been created.');
    }

    public function show($id)
    {
        // Show note
        $cats = Cat::all();
        $tags = Tag::all();
        $notes = Note::with(['cats', 'tags'])->findOrFail($id);

        return view('notes.show', ['notes' => $notes, 'cats' => $cats, 'tags' => $tags]);
    }

    public function edit($id)
    {
        // 
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'note_name' => 'required|min:3'
        ]);

        $notes = Note::where('id', $request->id)->firstOrFail();

        $notes->note_name = $request->note_name;
        $notes->note_text = $request->note_text;
        $notes->note_codes = $request->note_codes;
        $notes->note_lang = $request->note_lang;
        $notes->links = $request->links;

        if ($request->hasFile('files_images')) {

            $allowedfileExtension = ['pdf', 'jpg', 'png', 'gif', 'bmp', 'docx'];
            $files = $request->file('files_images');

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                $filename_without_ext = pathinfo($filename, PATHINFO_FILENAME);

                if ($check) {
                    $filename = $file->storeAs('files_images', $filename_without_ext . '_' . Str::random(5) . '.' .  $extension, 'public');
                    if ($filename) {
                        $stored_filenames[] = $filename;
                    }
                } else {
                    return Redirect::route('notes.create')->with('message', 'Your file extension is not allowed.');
                }
            }

            $notes->files_images = $notes->files_images ? json_encode(array_merge(json_decode($notes->files_images), $stored_filenames)) : json_encode($stored_filenames);
        }

        $notes->save();

        $created_note = Note::find($notes->id);
        $created_note->cats()->sync($request->cat_ids);
        $created_note->tags()->sync($request->tag_ids);

        return Redirect::route('notes.show', $notes->id)->with('message', 'Your notes has been updated');
    }

    public function delete_file(Request $request)
    {
        $note_id = $request->note_id;
        $file_link = $request->file_link;

        $notes = Note::where('id', $note_id)->firstOrFail();

        $files_images = json_decode($notes->files_images);

        $key = array_search($file_link, $files_images);

        if ($key !== false) {
            unset($files_images[$key]);
        }

        foreach ($files_images as $file) {
            $updated_file_paths[] = $file;
        }

        $notes->files_images = (isset($updated_file_paths) && !empty($updated_file_paths)) ? json_encode($updated_file_paths) : null;
        $notes->save();

        if ($notes) {

            $full_image_path = public_path('storage/' . $file_link);

            if (File::exists($full_image_path)) {
                File::delete($full_image_path);

                return response()->json([
                    'error' => false,
                    'message'  => 'Your file has been deleted.',
                ], 200);
            } else {
                return response()->json([
                    'error' => true,
                    'message'  => 'Your file has not been deleted.',
                ], 200);
            }
        } else {

            return response()->json([
                'error' => true,
                'message'  => 'Your file has not been deleted.',
            ], 200);
        }
    }

    public function destroy($id)
    {
        // Delete category
        $note = Note::find($id);
        $note->delete();

        return Redirect::route('notes.index')->with('message', $note->note_name . ' has been deleted.');
    }

    public function search_result(Request $request)
    {
        $term = $request->term;

        $cats = Cat::all();
        $tags = Tag::all();

        $cat = $request->cat;
        $tag = $request->tag;

        // $notes_query = DB::table('notes')
        //     ->when(isset($term), function ($query) use ($term) {
        //         $query->where('note_name', 'LIKE', '%' . $term . '%');
        //         $query->orWhere('note_text', 'LIKE', '%' . $term . '%');
        //         $query->orWhere('links', 'LIKE', '%' . $term . '%');
        //     })
        //     ->when(isset($cat), function ($query) use ($cat) {
        //         $query->whereHas(
        //             'cats',
        //             function ($query) use ($cat) {
        //                 $query->where('cats.id', $cat);
        //         });
        //     })
        //     ->when(isset($tag), function ($query) use ($tag) {
        //         $query->whereHas(
        //             'tags',
        //             function ($query) use ($tag) {
        //                 $query->where('tags.id', $tag);
        //         });
        //     })
        //     ->get();

        $notes = Note::with(['cats', 'tags'])->newQuery();

        if($request->has('term') && $request->term != '' && $request->term != null) {
            $notes->where(function ($query) use ($term) {
                $query->where('note_name', 'LIKE', '%' . $term . '%');
                $query->orWhere('note_text', 'LIKE', '%' . $term . '%');
                $query->orWhere('links', 'LIKE', '%' . $term . '%');
            });
        }

        if ($request->has('cat') && $request->cat != '' && $request->cat != null) {
            $notes->whereHas(
                'cats',
                function ($query) use ($request) {
                    $query->where('cats.id', $request->cat);
                }
            );
        }

        if ($request->has('tag') && $request->tag != '' && $request->tag != null) {
            $notes->whereHas(
                'tags',
                function ($query) use ($request) {
                    $query->where('tags.id', $request->tag);
                }
            );
        }

        $result = $notes->get();

        return view('notes.result', ['notes' => $result, 'cats' => $cats, 'tags' => $tags]);
    }
}

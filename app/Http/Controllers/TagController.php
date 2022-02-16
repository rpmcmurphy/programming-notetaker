<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TagController extends Controller
{
    // create resourceful controller methods
    public function index()
    {
        // return all tags
        $tags = Tag::orderBy('name')->get();
        return view('tags.index', ['tags' => $tags]);
    }

    public function create()
    {
        // tag create form 
        return view('tags.create');
    }

    public function store(Request $request)
    {
        // Store a tag
        $this->validate($request, [
            'tag_name' => 'required|min:3'
        ]);

        // Find if exists
        $tag = Tag::where('name', $request->tag_name)->first();

        if ($tag) {
            return Redirect::route('tags.index')->with('message', 'Tag already exists.');
        }

        $tag = new Tag();
        $tag->name = $request->tag_name;
        $tag->save();

        return Redirect::route('tags.index')->with('message', 'Your tag has been created');
    }

    public function show($id)
    {
        // Show tag
        return view('tags.show', ['tag' => Tag::findOrFail($id)]);
    }

    public function edit($id)
    {
        // 
    }

    public function update(Request $request)
    {
        // Update a tag
        $this->validate($request, [
            'tag_name' => 'required|max:255'
        ]);
        
        // Find if exists
        $existing_tag = Tag::where('name', $request->tag_name)->first();

        if ($existing_tag && $existing_tag->id != $request->id) {
            return Redirect::route('tags.index')->with('message', 'Tag already exists.');
        }

        $tag = Tag::where('id', $request->id)->firstOrFail();
        $tag->name = $request->input('tag_name');
        $tag->save();

        return Redirect::route('tags.index')->with('message', 'Your tag has been updated');
    }

    public function destroy($id)
    {
        // Delete tag
        $tag = Tag::find($id);
        $tag->delete();

        return Redirect::route('tags.index')->with('message', $tag->name . ' has been deleted.');
    }
}

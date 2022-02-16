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
        $tags = Tag::all();
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

        return Redirect::route('tags.index')->with('message', $tag->name . ' has been created');
    }
}

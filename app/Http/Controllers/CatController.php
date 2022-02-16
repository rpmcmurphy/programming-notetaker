<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CatController extends Controller
{
    // create resourceful controller methods
    public function index()
    {
        // return all cats
        $cats = Cat::orderBy('name')->get();
        return view('cats.index', ['cats' => $cats]);
    }

    public function create()
    {
        // cat create form 
        return view('cats.create');
    }

    public function store(Request $request)
    {
        // Store a cat
        $this->validate($request, [
            'cat_name' => 'required|min:3'
        ]);

        // Find if exists
        $existing_cat = Cat::where('name', $request->cat_name)->first();

        if ($existing_cat) {
            return Redirect::route('cats.index')->with('message', 'Category already exists.');
        }

        $cat = new Cat();
        $cat->name = $request->cat_name;
        $cat->save();

        return Redirect::route('cats.index')->with('message', 'Your category has been created');
    }

    public function show($id)
    {
        // Show category
        return view('cats.show', ['cat' => Cat::findOrFail($id)]);
    }

    public function edit($id)
    {
        // 
    }

    public function update(Request $request)
    {

        // Update a cat
        $this->validate($request, [
            'cat_name' => 'required|max:255'
        ]);

        // Find if exists
        $existing_cat = Cat::where('name', $request->cat_name)->first();

        if ($existing_cat && $existing_cat->id != $request->id) {
            return Redirect::route('cats.index')->with('message', 'Category already exists.');
        }

        $cat = Cat::where('id', $request->id)->firstOrFail();
        $cat->name = $request->input('cat_name');
        $cat->save();


        return Redirect::route('cats.index')->with('message', 'Your category has been updated');
    }

    public function destroy($id)
    {

        // Delete cat
        $cat = Cat::find($id);
        $cat->delete();

        return Redirect::route('cats.index')->with('message', $cat->name . ' has been created');
    }
}

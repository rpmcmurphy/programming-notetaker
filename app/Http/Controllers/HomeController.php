<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Tag;
use App\Models\Note;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // return all details
        $cats = Cat::all();
        $tags = Tag::all();
        $notes = Note::orderBy('created_at', 'DESC')->paginate(10);

        return view('home.index', ['notes' =>$notes, 'cats' =>$cats, 'tags' => $tags]);
    }
}
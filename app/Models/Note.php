<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['note_name', 'note_text', 'note_codes', 'links', 'files_images'];

    public function cats()
    {
        return $this->belongsToMany(Cat::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

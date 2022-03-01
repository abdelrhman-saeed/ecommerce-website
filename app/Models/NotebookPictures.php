<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class NotebookPictures extends Model
{
    use HasFactory;

    protected $fillable = [
        'notebook_id',
        'picture_path'
    ];

    public static function booted() {
        static::deleted(function ($notebook_picture) {
            Storage::delete('public/notebook_pictures/'. $notebook_picture->picture_path);
        });
    }
}

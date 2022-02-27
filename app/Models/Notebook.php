<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NotebookPictures;

class Notebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'notebook_type',
        'price',
        'discount',
        'quantity',
        'page_type',
        'page_count',
        'page_weight',
        'manufacturing_type',
        'cover_type',
        'size',
        'width',
        'height',
        'main_picture',
        'details'
    ];

    public function pictures() {
        return $this->hasMany(NotebookPictures::class);
    }
}
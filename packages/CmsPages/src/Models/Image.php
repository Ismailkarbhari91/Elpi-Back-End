<?php

namespace CmsPages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
    use HasFactory;

    protected $table = 'aboutimage';
    protected $fillable = [
        'images'
    ];
}
<?php

namespace CmsPages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model {
    use HasFactory;

    protected $table = 'aboutus';
    protected $fillable = [
        'section',
        'heading',
        'sub_heading',
        'content',
        'images',
        'locale'
    ];
}
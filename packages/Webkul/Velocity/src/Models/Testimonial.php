<?php

namespace Webkul\Velocity\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model {
    use HasFactory;

    protected $table = 'testimonial';
    protected $fillable = [
        'image_url',
        'customer_name',
        'description',
        'description_arabic',
        'locale'
    ];
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'shipping';
    // protected $fillable = ['first_name','last_name','country','address1','address2','city','state','zipcode','customer_id']; 
}

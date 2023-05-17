<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'billing';
    // protected $fillable = ['first_name','last_name','country','address1','address2','city','state','zipcode','email','phone','customer_id']; 
}

<?php

namespace RKREZA\Contact\Models;

use Illuminate\Database\Eloquent\Model;
use RKREZA\Contact\Contracts\ContactData as ContactDataContract;

class ContactData extends Model implements ContactDataContract
{
    protected $table = 'contactusdata';

    protected $guarded = ['id'];
}
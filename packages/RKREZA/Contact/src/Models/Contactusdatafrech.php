<?php

namespace RKREZA\Contact\Models;

use Illuminate\Database\Eloquent\Model;
use RKREZA\Contact\Contracts\Contactusdatafrech as ContactusdatafrechContract;

class Contactusdatafrech extends Model implements ContactusdatafrechContract
{
    protected $table = 'contactusdatafrech';

    protected $guarded = ['id'];
}


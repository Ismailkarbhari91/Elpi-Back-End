<?php

namespace RKREZA\Contact\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Webkul\Core\Eloquent\Repository;
use RKREZA\Contact\Models\ContactData;

class ContactDataRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model(): string
    {
        return 'RKREZA\Contact\Contracts\ContactData';
    }
}
<?php

namespace RKREZA\Contact\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \RKREZA\Contact\Models\Contact::class,
        \RKREZA\Contact\Models\ContactData::class,
        \RKREZA\Contact\Models\Contactusdatafrech::class
    ];
}
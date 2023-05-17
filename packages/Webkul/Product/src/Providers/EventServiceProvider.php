<?php

namespace Webkul\Product\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'catalog.attribute.create.after' => [
            'Webkul\Product\Listeners\ProductFlat@afterAttributeCreatedUpdated',
            'Webkul\Product\Listeners\ProductFlat@afterAttributeCreatedUpdateds'
        ],
        'catalog.attribute.update.after' => [
            'Webkul\Product\Listeners\ProductFlat@afterAttributeCreatedUpdated',
            'Webkul\Product\Listeners\ProductFlat@afterAttributeCreatedUpdateds'
        ],
        'catalog.attribute.delete.before' => [
            'Webkul\Product\Listeners\ProductFlat@afterAttributeDeleted',
            'Webkul\Product\Listeners\ProductFlat@afterAttributeDeletedNew'
        ],
        'catalog.product.create.after' => [
            'Webkul\Product\Listeners\ProductFlat@afterProductCreatedUpdated'
        ],
        'catalog.product.update.after' => [
            'Webkul\Product\Listeners\ProductFlat@afterProductCreatedUpdated'
        ],
    ];
}

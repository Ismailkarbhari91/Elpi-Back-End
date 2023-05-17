<?php
namespace CmsPages\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

/**
* HelloWorldServiceProvider
*
* @copyright 2020 Webkul Software Pvt. Ltd. (http://www.webkul.com)
*/
class CmsPagesServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap services.
    *
    * @return void
    */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/../Http/admin-routes.php');

        $this->loadRoutesFrom(__DIR__ . '/../Http/shop-routes.php');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'cmspage');

        // $this->publishes([
        //     __DIR__ . '/../../publishable/assets' => public_path('vendor/webkul/helloworld/assets'),
        // ], 'public');

        Event::listen('bagisto.admin.layout.head', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('cmspage::admin.layouts.style');
        });
    }

    /**
    * Register services.
    *
    * @return void
    */
    public function register()
    {

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin'
        );
    }
}

<?php

namespace Ivy\Providers;

use Illuminate\Support\ServiceProvider;

/**
* ServiceProvider
*
* The service provider for the modules. After being registered
* it will make sure that each of the modules are properly loaded
* i.e. with their routes, views etc.
*
* @author Kamran Ahmed <kamranahmed.se@gmail.com>
* @see http://kamranahmed.info/blog/2015/12/03/creating-a-modular-application-in-laravel/
* @package Ivy\Providers
*/
class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Will make sure that the required modules have been fully loaded
     * @return void
     */
    public function boot()
    {
        // For each of the registered modules, include their routes and Views
        // @todo - IVY - FIGURE OUT WHERE THIS ARRAY COMES FROM
        $modules = config("module.modules");

        foreach ($modules as $module) {
            // @todo - IVY - UPDATE THESE PATHS

            // Load the routes for each of the modules
            if (file_exists(__DIR__ . '/' . $module . '/routes.php')) {
                include __DIR__ . '/' . $module . '/routes.php';
            }

            // Load the views
            if (is_dir(__DIR__ . '/' . $module . '/Views')) {
                $this->loadViewsFrom(__DIR__ . '/' . $module . '/Views', $module);
            }
        }
    }

    /** [register description] */
    public function register() {}
}

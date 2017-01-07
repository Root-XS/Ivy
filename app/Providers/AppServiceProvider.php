<?php

namespace Ivy\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /** Bootstrap any application services. */
    public function boot()
    {
        /*
         * Custom Blade directives
         */

        // Prints HTML for a glyphicon
        // Usage: @glyphicon('plus-sign')
        \Blade::directive('glyphicon', function($expression) {
            return '<?php echo \'<span class="glyphicon glyphicon-\' . ' . $expression . ' . \'"></span>\'; ?>';
        });
    }

    /** Register any application services. */
    public function register() {}
}

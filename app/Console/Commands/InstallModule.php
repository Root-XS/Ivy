<?php

namespace Ivy\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class InstallModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:install {vendorPackage} {--sp=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install an Ivy module.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Install the package with composer
        $this->comment(PHP_EOL . 'Updating composer.json...' . PHP_EOL);

        $aComposerJson = json_decode(file_get_contents(base_path('composer.json')), true);
        $aComposerJson['require'][$this->argument('vendorPackage')] = '0.*';
        file_put_contents(base_path('composer.json'), json_encode($aComposerJson, JSON_PRETTY_PRINT));
        shell_exec('composer update');

        // Add module service provider
        // @todo facade? general list of Ivy modules?
        $this->comment(PHP_EOL . 'Updating config/app.php...' . PHP_EOL);
        $strAppConfig = file_get_contents(config_path('app.php'));
        if (!strpos($strAppConfig, $this->getServiceProvider())) {
            $strAppConfig = str_replace(
                '/* Begin Ivy Modules */',
                '/* Begin Ivy Modules */' . "\n        "
                    . $this->getServiceProvider(),
                $strAppConfig
            );
            file_put_contents(config_path('app.php'), $strAppConfig);
        }

        // Copy config, JS, & CSS files
        // @todo SEE https://laravel.com/docs/master/packages#public-assets
        $this->call('config:clear');
        $this->call('vendor:publish');

        // @todo ADD CSS/JS FILES TO HEADER - can this be part of the config file?

    }

    /**
     *
     */
    protected function getServiceProvider()
    {
        // Use user-specified input when available
        $strReturn = $this->option('sp');

        // Otherwise, figure it out from the vendorPackage
        if (!$strReturn) {
            $iSlashPos = strpos($this->argument('vendorPackage'), '/');
            $strReturn = substr_replace(
                studly_case(
                    str_replace('/', '-', $this->argument('vendorPackage'))
                ),
                '\\',
                $iSlashPos,
                0
            );
        }

        return $strReturn . 'ServiceProvider::class';
    }
}

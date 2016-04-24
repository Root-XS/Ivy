<?php

namespace Ivy\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class UninstallModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'uninstall-module {vendor}/{package}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall an Ivy module.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // @todo WARNING: THIS WILL DELETE ALL YOUR SETTINGS...

        $strPackage = $this->argument('vendor') . '/' . $this->argument('package');

        // Remove the package with composer
        $this->comment(PHP_EOL . 'Updating composer.json...' . PHP_EOL);

        $aComposerJson = json_decode(file_get_contents(base_path('composer.json')), true);
        unset($aComposerJson['require'][$strPackage]);
        file_put_contents(base_path('composer.json'), json_encode($aComposerJson));
        shell_exec('compser update');

        // @todo Delete config, JS, & CSS files

        // @todo REMOVE CSS/JS FILES FROM HEADER

        // @todo REMOVE MODULE FROM PHP LISTS - service provider? facade? general list of Ivy modules?

    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class InstallModule extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install-module {vendor}/{package}';

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
        $strPackage = $this->argument('vendor') . '/' . $this->argument('package');

        // Install the package with composer
        $this->comment(PHP_EOL . 'Updating composer.json...' . PHP_EOL);

        $aComposerJson = json_decode(file_get_contents(base_path('composer.json')), true);
        $aComposerJson['require'][$strPackage] = '>=1.0'; // @todo THIS PROBABLY DOESN'T WORK
        file_put_contents(base_path('composer.json'), json_encode($aComposerJson));
        shell_exec('compser update');

        // Copy config, JS, & CSS files
        // @todo SEE https://laravel.com/docs/master/packages#public-assets
        $this->call('vendor:publish');

        // @todo ADD CSS/JS FILES TO HEADER

        // @todo ADD MODULE TO PHP LISTS - service provider? facade? general list of Ivy modules?

    }

}

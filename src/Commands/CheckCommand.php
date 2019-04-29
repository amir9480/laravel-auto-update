<?php

namespace LaravelAutoUpdate\Commands;

use Illuminate\Console\Command;
use LaravelAutoUpdate\LaravelAutoUpdateFacade;

class CheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto-update:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check new version avalible.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($version = LaravelAutoUpdateFacade::check()) {
            $this->info("New update availble. $version");
        } else {
            $this->info("You already have lastest version.");
        }
    }
}

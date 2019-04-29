<?php

namespace LaravelAutoUpdate\Commands;

use Illuminate\Console\Command;
use LaravelAutoUpdate\LaravelAutoUpdateFacade;

class UpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto-update:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update to lastest version.';

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
        if (LaravelAutoUpdateFacade::check() == null) {
            return $this->info("You already have lastest version.");
        }
        $bar = $this->output->createProgressBar(3);
        $bar->setFormat("%current%/%max% [%bar%] %percent%% %message%");

        $bar->setMessage("Downloading...");
        $bar->start();
        LaravelAutoUpdateFacade::download();
        $bar->setMessage("Downloaded.");
        $bar->advance();

        $bar->setMessage("Extracting...");
        LaravelAutoUpdateFacade::extract();
        $bar->setMessage("Extracted.");
        $bar->advance();

        $bar->setMessage("Moving extracted files...");
        LaravelAutoUpdateFacade::move();
        $bar->setMessage("Updated successfully!");
        $bar->finish();
    }
}

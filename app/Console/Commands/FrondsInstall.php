<?php

namespace Fronds\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class FrondsInstall
 * TODO: remove coverage flag after implementation
 * @package Fronds\Console\Commands
 * @codeCoverageIgnore
 */
class FrondsInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fronds:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //
    }
}

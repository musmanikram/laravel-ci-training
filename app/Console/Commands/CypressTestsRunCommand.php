<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CypressTestsRunCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:cypress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Open cypress';

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
        $this->info('Opening cypress...');
        $cypressFilePath = base_path('node_modules/.bin/cypress');
        if (!file_exists($cypressFilePath)) {
            $this->error('Cypress file does not exist. Run `npm install` first and then try again');
        } else {
            exec("{$cypressFilePath} open");
        }
    }
}

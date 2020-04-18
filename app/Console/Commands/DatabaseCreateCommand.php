<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DatabaseCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:databases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create two databases 1. development 2. testing';

    private $databaseNames = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->databaseNames = [
            'laravel-ci-training-testing',
            'laravel-ci-training'
        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->info('Creating databases...');
            $charset = config('database.connections.mysql.charset', 'utf8mb4');
            $collation = config('database.connections.mysql.collation', 'utf8mb4_unicode_ci');

            foreach ($this->databaseNames as $database) {
                config(["database.connections.mysql.database" => null]);
                $databaseExist = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $database . "'");
                if (empty($databaseExist)) {
                    DB::statement("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET `$charset` COLLATE `$collation`;");
                    config(["database.connections.mysql.database" => $database]);
                    $this->info($database . ' successfully created');
                } else {
                    $this->info($database . ' already exist');
                }
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}

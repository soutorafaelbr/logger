<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;
use LaravelZero\Framework\Commands\Command;

class CreateDatabaseCommand extends Command
{
    protected $signature = 'db:create {name?}';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $schema =  $this->argument('name') ?? config('database.connections.mysql.database');
        $charset = config('database.connections.mysql.charset', 'utf8mb4');
        $collation = config('database.connections.mysql.collation', 'utf8mb4_unicode_ci');

        config(["database.connections.mysql.database" => null]);

        $sql = "CREATE DATABASE IF NOT EXISTS {$schema} CHARACTER SET $charset COLLATE $collation";

        DB::statement($sql);
    }

}

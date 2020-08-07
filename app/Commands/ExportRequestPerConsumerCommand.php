<?php

namespace App\Commands;

use App\Exports\RequestPerConsumerExport;
use LaravelZero\Framework\Commands\Command;

class ExportRequestPerConsumerCommand extends Command
{
    protected $signature = 'export:per-consumer';

    protected $description = 'Export request data per consumer.';

    public function handle()
    {
        (new RequestPerConsumerExport)->store('requests-per-consumer.csv', 'local');
    }
}

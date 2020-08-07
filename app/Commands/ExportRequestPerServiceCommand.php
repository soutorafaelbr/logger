<?php

namespace App\Commands;

use App\Exports\RequestPerServiceExport;
use LaravelZero\Framework\Commands\Command;

class ExportRequestPerServiceCommand extends Command
{
    protected $signature = 'export:per-service';

    protected $description = 'Export request data per service.';

    public function handle()
    {
        (new RequestPerServiceExport())->store('requests-per-services.csv', 'local');
    }
}

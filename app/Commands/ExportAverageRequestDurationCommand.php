<?php
namespace App\Commands;

use App\Exports\RequestAverageDurationPerServiceExport;
use LaravelZero\Framework\Commands\Command;

class ExportAverageRequestDurationCommand extends Command
{
    protected $signature = 'export:average-duration-per-service';

    protected $description = 'Export request average duration per service.';

    public function handle()
    {
        (new RequestAverageDurationPerServiceExport())->store('avg-duration-per-service.csv', 'local');
    }
}

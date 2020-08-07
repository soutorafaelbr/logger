<?php

namespace App\Commands;

use App\Services\ParseRequestToJsonService;
use LaravelZero\Framework\Commands\Command;

class ParseRequestDataFromJsonCommand extends Command
{
    protected $signature = 'parse-request';

    protected $description = 'Parse request data from a txt of new line delimited json.';

    public function handle(ParseRequestToJsonService $parseRequestToJsonService)
    {
        $parseRequestToJsonService->parse();
    }
}

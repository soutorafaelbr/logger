<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ExportCsvCommandsTest extends TestCase
{
    use DatabaseMigrations;

    public function testShouldGenerateCSVWithAvgRequestData()
    {
        Excel::fake();

        $this->artisan('export:average-duration-per-service')
            ->assertExitCode(0);

        Excel::assertStored('avg-duration-per-service.csv', 'local');
    }

    public function testShouldGenerateCSVWithRequestPerConsumer()
    {
        Excel::fake();

        $this->artisan('export:per-consumer')
            ->assertExitCode(0);

        Excel::assertStored('requests-per-consumer.csv', 'local');
    }

    public function testShouldGenerateCSVWithRequestPerService()
    {
        Excel::fake();

        $this->artisan('export:per-service')
            ->assertExitCode(0);

        Excel::assertStored('requests-per-service.csv', 'local');
    }
}

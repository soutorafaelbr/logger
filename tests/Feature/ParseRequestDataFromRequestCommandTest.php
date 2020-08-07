<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ParseRequestDataFromRequestCommandTest extends TestCase
{
    use RefreshDatabase;

    public function testMustStoreDataRequest()
    {
        $mockedData = $this->getMockTxtData();
        $mockedFile = Storage::get('test.txt');

        Storage::fake('local');

        Storage::fake()
            ->put(
                'logs.txt',
                $mockedFile
            );

        $this->artisan('parse-request')
            ->assertExitCode(0);

        $this->assertDatabaseHas(
            'requests',
            $mockedData
        );
    }

    private function getMockTxtData()
    {
        $content = json_decode(Storage::get('test.txt'), true);

        return [
            'consumer_id' => $content['authenticated_entity']['consumer_id']['uuid'],
            'service_id'  => $content['service']['id'],
            'name'        => $content['service']['name'],
            'kong'        => $content['latencies']['kong'],
            'duration'    => $content['latencies']['request'],
            'proxy'       => $content['latencies']['proxy'],
        ];
    }
}

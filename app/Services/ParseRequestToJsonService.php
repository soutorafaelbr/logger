<?php


namespace App\Services;

use App\RequestBuilder;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ParseRequestToJsonService
{
    private Storage $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function parse(): void
    {
        $trimmedContent = $this->storage
            ->disk('local')
            ->get('logs.txt');

        $contents = preg_split('/\n/', $trimmedContent);

        foreach ($contents as $content) {
            $data = json_decode($content, true);

            if (!$data) {
                continue;
            }

            $this->buildRequest($data);
        }
    }

    private function buildRequest(array $content): void
    {
        (new RequestBuilder())
            ->setConsumer($content['authenticated_entity']['consumer_id']['uuid'])
            ->setService($content['service']['id'])
            ->setName($content['service']['name'])
            ->setKong($content['latencies']['kong'])
            ->setDuration($content['latencies']['request'])
            ->setProxy($content['latencies']['proxy'])
            ->save();
    }
}

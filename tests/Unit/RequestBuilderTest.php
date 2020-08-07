<?php

namespace Tests\Unit;

use App\RequestBuilder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RequestBuilderTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testShouldBuildARequest()
    {
        $consumer = $this->faker->uuid;
        $service  = $this->faker->uuid;
        $name     = $this->faker->name;
        $kong     = $this->faker->randomDigit;
        $proxy    = $this->faker->randomDigit;
        $duration = $this->faker->randomDigit;

        $request = (new RequestBuilder())
            ->setConsumer($consumer)
            ->setService($service)
            ->setName($name)
            ->setKong($kong)
            ->setProxy($proxy)
            ->setDuration($duration);

        $this->assertEquals($consumer, $request->getRequest()->consumer_id);
        $this->assertEquals($service, $request->getRequest()->service_id);
        $this->assertEquals($name, $request->getRequest()->name);
        $this->assertEquals($kong, $request->getRequest()->kong);
        $this->assertEquals($proxy, $request->getRequest()->proxy);
        $this->assertEquals($duration, $request->getRequest()->duration);
    }

    public function testShouldStoreARequest()
    {
        $consumer = $this->faker->uuid;
        $service  = $this->faker->uuid;
        $name     = $this->faker->name;
        $kong     = $this->faker->randomDigit;
        $proxy    = $this->faker->randomDigit;
        $duration = $this->faker->randomDigit;

        (new RequestBuilder())
            ->setConsumer($consumer)
            ->setService($service)
            ->setName($name)
            ->setKong($kong)
            ->setProxy($proxy)
            ->setDuration($duration)
            ->save();

        $this->assertDatabaseHas(
            'requests',
            [
                'consumer_id' => $consumer,
                'service_id'  => $service,
                'name'        => $name,
                'kong'        => $kong,
                'proxy'       => $proxy,
                'duration'    => $duration,
            ]
        );
    }
}

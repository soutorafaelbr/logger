<?php


namespace App;

use App\models\Request;

class RequestBuilder
{
    private Request $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function setConsumer($consumer): self
    {
        $this->request->consumer_id = $consumer;

        return $this;
    }

    public function setName($name): self
    {
        $this->request->name = $name;

        return $this;
    }

    public function setService($serviceId): self
    {
        $this->request->service_id = $serviceId;

        return $this;
    }

    public function setKong($kong): self
    {
        $this->request->kong = $kong;

        return $this;
    }

    public function setDuration($duration): self
    {
        $this->request->duration = $duration;

        return $this;
    }

    public function setProxy($proxy): self
    {
        $this->request->proxy = $proxy;

        return $this;
    }

    public function save(): bool
    {
        return $this->request->save();
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}

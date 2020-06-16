<?php

namespace App\Clients\Weather;

use GuzzleHttp\Client;

class WeatherClient
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}

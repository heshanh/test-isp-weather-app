<?php

namespace Tests\Feature;

use App\Services\WeatherAPI\WeatherAPIService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class WeatherResponseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected $weatherAPIService;

    protected $mockHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockHandler = new MockHandler();

        $client = new Client([
            'handler' => $this->mockHandler,
        ]);

        $this->weatherAPIService = new WeatherAPIService($client);
    }

    public function testForecastForBrisbane(): void
    {
        $this->mockHandler->append(new Response(200, [], file_get_contents(base_path('tests') . '/Responses/Forecast/brisbane.json')));

        $forecast = $this->weatherAPIService->getForecastByCity('brisbane')->getResponse();

        $this->assertEquals('Brisbane', $forecast['location']['name']);
    }

    public function testForecastReturnsThreeDaysByDefault(): void
    {
        $this->mockHandler->append(new Response(200, [], file_get_contents(base_path('tests') . '/Responses/Forecast/brisbane.json')));

        $forecast = $this->weatherAPIService->getForecastByCity('brisbane')->getResponse();

        $this->assertCount(3, $forecast['forecast']['forecastday']);

    }

    public function testErrorForInvalidLocation(): void
    {
        $this->expectException(\App\Services\WeatherAPI\Exceptions\NoLocationFoundException::class);

        $this->mockHandler->append(new Response(400, [], file_get_contents(base_path('tests') . '/Responses/Forecast/error.json')));

        $this->weatherAPIService->getForecastByCity('ThisIsNotARealCity')->getResponse();

    }
}

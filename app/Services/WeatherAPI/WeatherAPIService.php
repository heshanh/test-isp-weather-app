<?php

namespace App\Services\WeatherAPI;


use App\Services\WeatherAPI\Exceptions\NoLocationFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use RuntimeException;

class WeatherAPIService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $forecastUrl;

    /**
     * @var string
     */
    private $apiKey;

    /**
     */
    private $serializer;

    public function __construct(Client $client)
    {
        $this->client = $client;

        $this->apiKey = env('WEATHERAPI_KEY');

        $this->forecastUrl = env('WEATHERAPI_BASEURL') . '/forecast.json';

    }

    /**
     * @param  string  $city
     * @param  int  $days
     * @return string
     * @throws NoLocationFoundException
     */
    public function getForecastByCity(string $city, int $days = 5)
    {
        $queryParams = [
            'key' => $this->apiKey,
            'q' => $city,
            'days' => $days
        ];

        try
        {
            $response = $this->client->get(
                $this->forecastUrl,
                ['query' => $queryParams]
            )->getBody()->getContents();

            return $this->jsonToObject($response);

        } catch (ClientException $exception)
        {
            throw new NoLocationFoundException(
                'No matching location found',
                $exception->getCode(),
                $exception
            );
        }
    }

    /**
     * @param  string  $json
     * @return WeatherResponse|null
     */
    private function jsonToObject(string $json): ?WeatherResponse
    {
        try
        {
            $data = json_decode((string)$json, true);

            return new WeatherResponse($data);

        } catch (\RuntimeException $exception)
        {
            throw new RuntimeException('Unable to parse response body into JSON');
        }

    }

}

<?php

namespace App\Console\Commands;

use App\Services\WeatherAPI\WeatherAPIService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client([
           'base_uri' => env('WEATHERAPI_BASEURL')
        ]);

        try
        {
            $weatherService = new WeatherAPIService($client);

            $response = $weatherService->getForecastByCity('brisbane');

            dd($response->getForecast());

        }catch (\Exception $clientException)
        {
            dd($clientException->getMessage());
        }


    }
}

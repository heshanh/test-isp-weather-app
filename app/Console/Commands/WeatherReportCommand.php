<?php

namespace App\Console\Commands;

use App\Services\WeatherAPI\Exceptions\NoLocationFoundException;
use App\Services\WeatherAPI\WeatherAPIService;
use Illuminate\Console\Command;

class WeatherReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:report {cities}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var WeatherAPIService
     */
    private $weatherAPIService;

    /**
     * Create a new command instance.
     *
     * @param  WeatherAPIService  $weatherAPIService
     */
    public function __construct(WeatherAPIService $weatherAPIService)
    {
        parent::__construct();

        $this->weatherAPIService = $weatherAPIService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cities = $this->argument('cities');

        $citiesArray = explode(',', $cities);

        $headers = ['City', 'Max Temp (c)'];

        $table = collect($citiesArray)->map(function ($city) {

            try
            {
                $forecast = ($this->weatherAPIService->getForecastByCity($city));

                return [
                    $city,
                    implode(',', $forecast->getForecast()->toArray())
                ];

            } catch (NoLocationFoundException $exception)
            {
                return [
                    $city,
                    $exception->getMessage()
                ];
            }
        });

        $this->line('Max temp for the next three days');

        $this->table($headers, $table);
    }
}

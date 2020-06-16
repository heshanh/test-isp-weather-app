<?php


namespace App\Services\WeatherAPI;


class WeatherResponse
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getTempC()
    {
        return $this->data['current']['temp_c'];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getForecastByDay(): \Illuminate\Support\Collection
    {
        return collect($this->data['forecast']['forecastday'])->map(static function ($day)
        {
            return [
                'date' => $day['date'],
                'maxTemp' => $day['day']['maxtemp_c']
                ];
        });
    }

    public function getForecast(): \Illuminate\Support\Collection
    {
        return collect($this->data['forecast']['forecastday'])->map(static function ($day)
        {
            return $day['day']['maxtemp_c'];
        });
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->data;
    }
}

# Weather App

## How to install the app

**Get an API key from https://www.weatherapi.com**

Update the values in .env file
```
WEATHERAPI_KEY=XXXX
WEATHERAPI_BASEURL=http://api.weatherapi.com/v1
```

> Install laravel packages
>
`` composer install``

> Install frotned pacakges
> 
``yarn install``

> Run laravel Mix
>
``npm run production``

> Run the laravel web server
>
``php artisan serve``

## Running the console command 
`` php artisan weather:report paris,brisbane,paris,Melbourne,Sydney``

## Running tests
`` ./vendor/bin/phpunit``

### Known Issues
- weatherapi only returns 3 records even though its stated in their docos that it should return 5.
Their own api mock tool has a **days** options however this also does not seem to work

- When an invalid city is submitted via the frontned the graceful error is not so graceful. 
It will tigger a simple javascript **alert()** instead of a notification. 

- Did not have enough time to implement a full test coverage
- Execption tests not correctly implemented. The test for when an invalid city is entered is 
not passing.
 


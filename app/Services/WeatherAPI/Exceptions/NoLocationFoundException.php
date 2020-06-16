<?php

namespace App\Services\WeatherAPI\Exceptions;

use Exception;
use Throwable;

final class NoLocationFoundException extends Exception
{
    /**
     * @var Throwable|null
     */

    /**
     * WorkListUploadErrorException constructor.
     * @param  string  $message
     * @param  int  $code
     * @param  Throwable|null  $previous
     */
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

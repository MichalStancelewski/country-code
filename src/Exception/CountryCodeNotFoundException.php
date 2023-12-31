<?php
declare(strict_types=1);

namespace CountryCode\Exception;

use Exception;
use Throwable;

class CountryCodeNotFoundException extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
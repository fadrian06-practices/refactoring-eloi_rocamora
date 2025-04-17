<?php

declare(strict_types=1);

namespace FasLatam\Exceptions;

abstract class PersoExceptions extends \RuntimeException
{
    protected $message = 'General Error Ocurred.';
}

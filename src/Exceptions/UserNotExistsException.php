<?php

declare(strict_types=1);

namespace FasLatam\Exceptions;

class UserNotExistsException extends PersoExceptions
{
    protected $message = 'Access denied.';
}

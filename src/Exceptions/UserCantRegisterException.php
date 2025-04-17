<?php

declare(strict_types=1);

namespace FasLatam\Exceptions;

class UserCantRegisterException extends PersoExceptions
{
    protected $message = 'Unable to register.';
}

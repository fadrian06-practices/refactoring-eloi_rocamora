<?php

namespace App\Exceptions;

class UserCantRegisterException extends PersoExceptions
{
  protected $message = 'Unable to register.';
}

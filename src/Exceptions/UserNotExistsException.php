<?php

namespace App\Exceptions;

class UserNotExistsException extends PersoExceptions
{
  protected $message = 'Access denied.';
}

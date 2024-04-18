<?php

namespace Exceptions;

use RuntimeException;

abstract class PersoExceptions extends RuntimeException
{
  protected $message = 'General Error Ocurred.';
}

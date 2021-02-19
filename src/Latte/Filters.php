<?php

declare(strict_types=1);

namespace App\Latte;

use Nette\StaticClass;


class Filters
{
  use StaticClass;

  public static function formatPrice(float $value) : string
  {
    return $value > 0 ? sprintf('$%.2f', $value) : 'Free';
  }
}

<?php

declare(strict_types=1);

namespace App\Components\ShippingSelector;


interface ShippingSelectorFactory
{
  public function create() : ShippingSelectorControl;
}

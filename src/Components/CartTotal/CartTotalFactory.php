<?php

declare(strict_types=1);

namespace App\Components\CartTotal;


interface CartTotalFactory
{
  public function create() : CartTotalControl;
}

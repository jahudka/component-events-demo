<?php

declare(strict_types=1);

namespace App\Components\CartTotal;

use Nette\Bridges\ApplicationLatte\Template;


class CartTotalDefaultTemplate extends Template
{
  public float $items;
  public float $shipping;
}

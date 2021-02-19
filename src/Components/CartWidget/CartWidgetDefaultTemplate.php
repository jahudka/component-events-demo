<?php

declare(strict_types=1);

namespace App\Components\CartWidget;

use App\Model\Entity\Cart;
use Nette\Bridges\ApplicationLatte\Template;


class CartWidgetDefaultTemplate extends Template
{
  public Cart|null $cart;
  public float $total;
}

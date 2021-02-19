<?php

declare(strict_types=1);

namespace App\Components\CartListing;

use App\Model\Entity\CartItem;
use Nette\Bridges\ApplicationLatte\Template;


class CartListingDefaultTemplate extends Template
{
  /** @var CartItem[] */
  public array $items;
}

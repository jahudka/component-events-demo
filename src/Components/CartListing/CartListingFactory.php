<?php

declare(strict_types=1);

namespace App\Components\CartListing;


interface CartListingFactory
{
  public function create() : CartListingControl;
}

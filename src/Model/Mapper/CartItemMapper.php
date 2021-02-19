<?php

declare(strict_types=1);

namespace App\Model\Mapper;

use Nextras\Orm\Mapper\Mapper;


class CartItemMapper extends Mapper
{
  public function getTableName() : string
  {
    return 'cart_items';
  }
}

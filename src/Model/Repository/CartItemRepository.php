<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\CartItem;
use App\Model\Mapper\CartItemMapper;
use Nextras\Orm\Repository\IDependencyProvider;
use Nextras\Orm\Repository\Repository;


/**
 * @method getById(int $id): CartItem|null
 */
class CartItemRepository extends Repository
{
  public static function getEntityClassNames() : array
  {
    return [CartItem::class];
  }

  public function __construct(CartItemMapper $mapper, IDependencyProvider $dependencyProvider = null)
  {
    parent::__construct($mapper, $dependencyProvider);
  }
}

<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\Cart;
use App\Model\Mapper\CartMapper;
use Nextras\Orm\Repository\IDependencyProvider;
use Nextras\Orm\Repository\Repository;


/**
 * @method getById(int $id): Cart|null
 */
class CartRepository extends Repository
{
  public static function getEntityClassNames() : array
  {
    return [Cart::class];
  }

  public function __construct(CartMapper $mapper, IDependencyProvider $dependencyProvider = null)
  {
    parent::__construct($mapper, $dependencyProvider);
  }
}

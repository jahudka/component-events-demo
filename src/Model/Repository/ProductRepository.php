<?php

declare(strict_types=1);

namespace App\Model\Repository;

use App\Model\Entity\Product;
use App\Model\Mapper\ProductMapper;
use Nextras\Orm\Repository\IDependencyProvider;
use Nextras\Orm\Repository\Repository;


/**
 * @method getById(int $id): Product|null
 */
class ProductRepository extends Repository
{
  public static function getEntityClassNames() : array
  {
    return [Product::class];
  }

  public function __construct(ProductMapper $mapper, IDependencyProvider $dependencyProvider = null)
  {
    parent::__construct($mapper, $dependencyProvider);
  }
}

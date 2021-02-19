<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;


/**
 * @property int $id {primary}
 * @property string $shippingMethod
 * @property OneHasMany|CartItem[] $items {1:m CartItem::$cart, orderBy=[id=ASC]}
 */
class Cart extends Entity
{

}

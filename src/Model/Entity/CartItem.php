<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Nextras\Orm\Entity\Entity;


/**
 * @property int $id {primary}
 * @property Cart $cart {m:1 Cart::$items}
 * @property Product $product {m:1 Product, oneSided=true}
 * @property int $quantity
 */
class CartItem extends Entity
{

}

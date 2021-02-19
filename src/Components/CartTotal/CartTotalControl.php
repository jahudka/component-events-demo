<?php

declare(strict_types=1);

namespace App\Components\CartTotal;

use App\Model\Entity\Cart;
use App\Model\Entity\CartItem;
use App\Model\MagicBox;
use Nette\Application\UI\Control;
use Nextras\Orm\Entity\IEntity;


/**
 * @property-read CartTotalDefaultTemplate $template
 */
class CartTotalControl extends Control
{
  public function __construct(
    private MagicBox $magicBox
  ) {}

  public function render() : void
  {
    $this->template->items = $this->magicBox->getCartItemsTotal();
    $this->template->shipping = $this->magicBox->getCartShippingTotal();
    $this->template->render(__DIR__ . '/templates/default.latte');
  }

  public function onAfterRemove(IEntity $entity) : void
  {
    if ($entity instanceof CartItem) {
      $this->redrawControl('items');
      $this->redrawControl('total');
    }
  }

  public function onAfterUpdate(IEntity $entity) : void
  {
    $this->redrawControl($entity instanceof Cart ? 'shipping' : 'items');
    $this->redrawControl('total');
  }
}

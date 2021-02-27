<?php

declare(strict_types=1);

namespace App\Components\CartListing;

use App\Model\MagicBox;
use App\Model\Entity\CartItem;
use Contributte\Nextras\Orm\Events\Listeners\AfterRemoveListener;
use Contributte\Nextras\Orm\Events\Listeners\AfterUpdateListener;
use Nette\Application\UI\Control;
use Nextras\Orm\Entity\IEntity;
use Nittro\Bridges\NittroUI\ComponentUtils;


/**
 * @AfterUpdate(CartItem)
 * @AfterRemove(CartItem)
 * @property-read CartListingDefaultTemplate $template
 */
class CartListingControl extends Control implements AfterUpdateListener, AfterRemoveListener
{
  use ComponentUtils;

  private array|null $items = null;

  public function __construct(
    private MagicBox $magicBox
  ) {}

  public function render() : void
  {
    $this->template->items = $this->getItems();
    $this->template->render(__DIR__ . '/templates/default.latte');
  }

  public function handleClear() : void
  {
    $this->magicBox->clearCart();
    $this->postGet('this');
    $this->redrawControl('list');
    $this->items = [];
  }

  public function handleUpdateQuantity(int $itemId, int $quantity) : void
  {
    $this->magicBox->updateCartQuantities([$itemId => $quantity]);
    $this->postGet('this');
    $this->redrawControl('dummy');
  }

  public function onAfterUpdate(IEntity $entity) : void
  {
    if ($entity instanceof CartItem) {
      $this->redrawControl('list');
      $this->items[] = $entity;
    }
  }

  public function onAfterRemove(IEntity $entity) : void
  {
    if ($entity instanceof CartItem) {
      $this->redrawControl('dummy');
    }
  }

  private function getItems() : array
  {
    if ($this->items === null) {
      $cart = $this->magicBox->getCart();
      $this->items = $cart ? iterator_to_array($cart->items) : [];
    }

    return $this->items;
  }
}

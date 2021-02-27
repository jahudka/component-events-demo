<?php

declare(strict_types=1);

namespace App\Components\CartListing;

use App\Model\MagicBox;
use Nette\Application\UI\Control;
use Nittro\Bridges\NittroUI\ComponentUtils;


/**
 * @property-read CartListingDefaultTemplate $template
 */
class CartListingControl extends Control
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
    $this->items = $this->magicBox->updateCartQuantities([$itemId => $quantity]);
    $this->postGet('this');
    $this->redrawControl('list');
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

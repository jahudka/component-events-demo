<?php

declare(strict_types=1);

namespace App\Components\CartWidget;

use App\Model\Entity\CartItem;
use App\Model\MagicBox;
use Contributte\Nextras\Orm\Events\Listeners\AfterRemoveListener;
use Contributte\Nextras\Orm\Events\Listeners\AfterUpdateListener;
use Nette\Application\UI\Control;
use Nextras\Orm\Entity\IEntity;


/**
 * @AfterUpdate(CartItem)
 * @AfterRemove(CartItem)
 * @property-read CartWidgetDefaultTemplate $template
 */
class CartWidgetControl extends Control implements AfterUpdateListener, AfterRemoveListener
{
  public function __construct(
    private MagicBox $magicBox
  ) {}

  public function render() : void
  {
    $this->template->cart = $this->magicBox->getCart();
    $this->template->total = $this->magicBox->getCartItemsTotal();
    $this->template->render(__DIR__ . '/templates/default.latte');
  }

  public function onAfterRemove(IEntity $entity) : void
  {
    $this->redrawIfNeeded($entity);
  }

  public function onAfterUpdate(IEntity $entity) : void
  {
    $this->redrawIfNeeded($entity);
  }

  private function redrawIfNeeded(IEntity $entity) : void
  {
    if ($entity instanceof CartItem) {
      $this->redrawControl('items');
      $this->redrawControl('total');
      $this->redrawControl('badge');
    }
  }
}

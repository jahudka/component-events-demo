<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\MagicBox;
use Nette\Application\UI\Presenter;


class HomePresenter extends Presenter
{
  public function __construct(
    private MagicBox $magicBox,
  ) {
    parent::__construct();
  }

  public function actionDefault() : void
  {
    $cart = $this->magicBox->getCart(true);

    if (!$cart->items->count()) {
      $this->magicBox->addToCart(1);
      $this->magicBox->addToCart(2);
      $this->magicBox->addToCart(3);
    }

    $this->redirect('Cart:');
  }
}

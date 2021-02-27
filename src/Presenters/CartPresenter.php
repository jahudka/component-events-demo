<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\CartListing\CartListingControl;
use App\Components\CartListing\CartListingFactory;
use App\Components\CartTotal\CartTotalControl;
use App\Components\CartTotal\CartTotalFactory;
use App\Components\CartWidget\CartWidgetControl;
use App\Components\CartWidget\CartWidgetFactory;
use App\Components\ShippingSelector\ShippingSelectorControl;
use App\Components\ShippingSelector\ShippingSelectorFactory;
use Nittro\Bridges\NittroUI\Presenter;


class CartPresenter extends Presenter
{
  public function __construct(
    private CartWidgetFactory $cartWidgetFactory,
    private CartListingFactory $cartListingFactory,
    private CartTotalFactory $cartTotalFactory,
    private ShippingSelectorFactory $shippingSelectorFactory
  )
  {
    parent::__construct();
  }

  public function createComponentCartWidget() : CartWidgetControl
  {
    return $this->cartWidgetFactory->create();
  }

  public function createComponentCartListing() : CartListingControl
  {
    return $this->cartListingFactory->create();
  }

  public function createComponentCartTotal() : CartTotalControl
  {
    return $this->cartTotalFactory->create();
  }

  public function createComponentShippingSelector() : ShippingSelectorControl
  {
    return $this->shippingSelectorFactory->create();
  }
}

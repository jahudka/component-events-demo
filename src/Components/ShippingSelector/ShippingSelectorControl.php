<?php

declare(strict_types=1);

namespace App\Components\ShippingSelector;


use App\Model\MagicBox;
use Nette\Application\UI\Control;
use Nittro\Bridges\NittroUI\ComponentUtils;

/**
 * @property-read ShippingSelectorDefaultTemplate $template
 */
class ShippingSelectorControl extends Control
{
  use ComponentUtils;

  public function __construct(
    private MagicBox $magicBox
  ) {}

  public function render() : void
  {
    $this->template->methods = $this->magicBox->getShippingMethods();
    $this->template->render(__DIR__ . '/templates/default.latte');
  }

  public function createComponentForm() : ShippingSelectorForm
  {
    $cart = $this->magicBox->getCart(true);
    $methods = array_map(fn(array $method) => $method['label'], $this->magicBox->getShippingMethods());
    $form = new ShippingSelectorForm($methods, $cart->shippingMethod);
    $form->onSuccess[] = [$this, 'saveShippingMethod'];
    return $form;
  }

  public function saveShippingMethod(ShippingSelectorForm $form, array $values) : void
  {
    $this->magicBox->saveShippingMethod($values['shippingMethod']);
    $this->postGet('this');
    $this->redrawControl('dummy');
  }
}

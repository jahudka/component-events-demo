<?php

declare(strict_types=1);

namespace App\Components\ShippingSelector;

use Nette\Application\UI\Form;


class ShippingSelectorForm extends Form
{

  public function __construct(array $methods, string $defaultMethod)
  {
    parent::__construct();

    $this->addRadioList('shippingMethod', items: $methods)
      ->setRequired(true);

    $this->setDefaults(['shippingMethod' => $defaultMethod]);

    $this->addSubmit('save');
  }
}

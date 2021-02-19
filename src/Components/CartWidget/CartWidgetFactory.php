<?php

declare(strict_types=1);

namespace App\Components\CartWidget;


interface CartWidgetFactory
{
  public function create() : CartWidgetControl;
}

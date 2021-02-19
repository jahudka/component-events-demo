<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Entity\Cart;
use App\Model\Entity\CartItem;
use LogicException;
use Nette\Http\Session;
use Nette\Http\SessionSection;


class MagicBox
{
  private const sessionSection = 'app/cart';

  private const shippingMethods = [
    'nbd' => ['label' => 'Next Day Delivery', 'price' => 4.99],
    'std' => ['label' => 'Standard Delivery', 'price' => 1.99],
    'pickup' => ['label' => 'Personal Pickup', 'price' => 0],
  ];

  private SessionSection|null $sessionSection = null;
  private Entity\Cart|null $cart = null;

  public function __construct(
    private Repository\CartRepository $cartRepository,
    private Repository\CartItemRepository $cartItemRepository,
    private Repository\ProductRepository $productRepository,
    private Session $session
  ) {}

  public function getCart(bool $need = false) : Entity\Cart|null
  {
    if ($this->cart) {
      return $this->cart;
    }

    if ($session = $this->getSession($need)) {
      if ($id = $session['id']) {
        return $this->cart = $this->cartRepository->getById($id);
      }
    }

    if ($need) {
      $this->cart = new Cart();
      $this->cart->shippingMethod = 'std';
      $this->cartRepository->persistAndFlush($this->cart);
      $session['id'] = $this->cart->id;
      return $this->cart;
    }

    return null;
  }

  public function getCartItemsTotal() : float
  {
    $cart = $this->getCart(true);

    return array_sum(array_map(
      fn(Entity\CartItem $item) => $item->quantity * $item->product->unitPrice,
      iterator_to_array($cart->items->getIterator()),
    ));
  }


  public function getCartShippingTotal() : float
  {
    $cart = $this->getCart(true);
    return self::shippingMethods[$cart->shippingMethod]['price'];
  }

  public function getShippingMethods() : array
  {
    return self::shippingMethods;
  }

  public function saveShippingMethod(string $method) : void
  {
    $cart = $this->getCart(true);
    $cart->shippingMethod = $method;
    $this->cartRepository->persistAndFlush($cart);
  }

  public function addToCart(int $productId, int $quantity = 1) : Entity\CartItem
  {
    $product = $this->productRepository->getById($productId);

    if (!$product) {
      throw new LogicException('Product not found');
    }

    $item = new CartItem();
    $item->cart = $this->getCart(true);
    $item->product = $product;
    $item->quantity = $quantity;
    $this->cartItemRepository->persistAndFlush($item);

    return $item;
  }

  public function updateCartQuantities(array $quantities) : array
  {
    $cart = $this->getCart(true);
    $changed = [];

    foreach ($cart->items as $item) {
      if (isset($quantities[$item->id]) && $item->quantity !== $quantities[$item->id]) {
        if ($quantities[$item->id] === 0) {
          $this->cartItemRepository->remove($item);
        } else {
          $item->quantity = $quantities[$item->id];
          $this->cartItemRepository->persist($item);
          $changed[] = $item;
        }
      }
    }

    $this->cartItemRepository->flush();

    return $changed;
  }

  public function clearCart() : void
  {
    if ($cart = $this->getCart()) {
      foreach ($cart->items as $item) {
        $this->cartItemRepository->remove($item);
      }

      $this->cartItemRepository->flush();
    }
  }

  private function getSession(bool $force = false) : SessionSection|null
  {
    if ($this->sessionSection) {
      return $this->sessionSection;
    }

    if ($force || $this->session->exists()) {
      return $this->sessionSection = $this->session->getSection(self::sessionSection);
    }

    return null;
  }
}

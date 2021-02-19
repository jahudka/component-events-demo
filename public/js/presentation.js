(function() {
  const map = {
    1: '.cart-container .cart',
    2: '.cart_area > .container > .row:first-child',
    3: '.shipping-method-area',
    4: '.cart-total-area',
  };

  document.addEventListener('keydown', handleKey);
  document.addEventListener('keyup', handleKey);

  function handleKey(evt) {
    if (evt.target.closest('a, button, input, select, textarea') || !(evt.key in map)) {
      return;
    }

    for (const target of document.querySelectorAll(map[evt.key])) {
      target.classList.toggle('presentation-highlight', evt.type === 'keydown');
    }
  }
})();

(function() {
  const map = {
    1: '.cart-container .cart, .cart-container .cart .cart-list',
    2: '#snippet-cartTotal-items, #snippet-cartTotal-total',
    3: '.shipping-method-area .custom-control:nth-child(3)',
    4: '#snippet-cartTotal-shipping, #snippet-cartTotal-total'
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

(function() {
  const map = {
    1: '#snippet-cartListing-list > tr:first-child .total_price span',
    2: '.cart-container .cart',
    3: '.cart-container .cart .cart-list',
    4: '#snippet-cartTotal-items, #snippet-cartTotal-total',
    5: '#snippet-cartTotal-shipping, #snippet-cartTotal-total',
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

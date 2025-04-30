function addToCart(productId) {
  let cart = JSON.parse(localStorage.getItem('cart')) || {};
  cart[productId] = (cart[productId] || 0) + 1;
  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartCounter();

  showToast("Το προϊόν προστέθηκε στο καλάθι!");
}



function updateCartCounter() {
  const cart = JSON.parse(localStorage.getItem('cart')) || {};
  const count = Object.values(cart).reduce((a, b) => a + b, 0);
  const badge = document.getElementById('cart-count');
  if (badge) badge.textContent = count;
}

document.addEventListener('DOMContentLoaded', updateCartCounter);


document.addEventListener("DOMContentLoaded", () => {
  console.log("🛒 cart.js loaded");

  const cart = JSON.parse(localStorage.getItem("cart")) || {};
  console.log("📦 Καλάθι:", cart);

  const itemsContainer = document.getElementById("cart-items");
  const totalEl = document.getElementById("cart-total");

  fetch("fetch_products.php")
    .then(res => res.json())
    .then(products => {
      console.log("📦 Προϊόντα από βάση:", products);

      let total = 0;
      itemsContainer.innerHTML = "";

      Object.entries(cart).forEach(([productId, quantity]) => {
        const product = products.find(p => p.id == productId);
        if (!product) return;

        const price = parseFloat(product.price);
        const subtotal = quantity * price;
        total += subtotal;

        const row = document.createElement("tr");
        row.innerHTML = `
          <td class="border px-4 py-2 flex items-center gap-3">
            <img src="${product.image}" alt="${product.name}" class="w-16 h-16 object-contain rounded" />
            <span>${product.name}</span>
          </td>
          <td class="border px-4 py-2">${quantity}</td>
          <td class="border px-4 py-2">€${price.toFixed(2)}</td>
          <td class="border px-4 py-2">€${subtotal.toFixed(2)}</td>
          <td class="border px-4 py-2 text-right">
            <button onclick="removeFromCart(${product.id})"
              class="text-red-600 hover:underline text-sm">Αφαίρεση</button>
          </td>
        `;
        itemsContainer.appendChild(row);
      });

      totalEl.textContent = total.toFixed(2) + "€";
    });
});

function removeFromCart(productId) {
  const cart = JSON.parse(localStorage.getItem("cart")) || {};
  delete cart[productId];
  localStorage.setItem("cart", JSON.stringify(cart));
  location.reload(); // ανανεωση της προβολης εδω
}
window.removeFromCart = removeFromCart;

function renderMiniCart() {
  const cart = JSON.parse(localStorage.getItem('cart')) || {};
  const itemsContainer = document.getElementById('mini-cart-items');
  const totalContainer = document.getElementById('mini-cart-total');

  if (!itemsContainer || !totalContainer) return;

  fetch('fetch_products.php')
    .then(res => res.json())
    .then(products => {
      itemsContainer.innerHTML = '';
      let total = 0;

      Object.keys(cart).forEach(productId => {
        const product = products.find(p => p.id == productId);
        if (product) {
          const quantity = cart[productId];
          const subtotal = product.price * quantity;
          total += subtotal;

          const item = document.createElement('div');
          item.className = 'flex justify-between items-center';
          item.innerHTML = `
            <span class="truncate max-w-[120px]">${product.name} × ${quantity}</span>
            <span>€${subtotal.toFixed(2)}</span>
          `;
          itemsContainer.appendChild(item);
        }
      });

      totalContainer.textContent = `€${total.toFixed(2)}`;
    });
}

// ανανεωση μινι καρτ οταν αλλαζει το καλαθι
document.addEventListener('DOMContentLoaded', () => {
  updateCartCounter();
  renderMiniCart();
});

window.addEventListener('storage', () => {
  updateCartCounter();
  renderMiniCart();
});


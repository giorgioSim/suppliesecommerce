<?php include 'partials/header.php'; ?>

<div class="container mx-auto px-4 py-8">
  <h1 class="text-2xl font-bold mb-4">Ολοκλήρωση Παραγγελίας</h1>

  <form id="checkout-form" class="space-y-4">
    <div>
      <label for="name" class="block font-semibold">Όνομα</label>
      <input type="text" name="name" id="name" required class="w-full border p-2 rounded">
    </div>

    <div>
      <label for="email" class="block font-semibold">Email</label>
      <input type="email" name="email" id="email" required class="w-full border p-2 rounded">
    </div>

    <button type="submit"
      class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded font-semibold">
      Υποβολή Παραγγελίας
    </button>

    <p id="success-message" class="text-green-600 font-semibold mt-4 hidden">
      ✅ Η παραγγελία σου καταχωρήθηκε με επιτυχία!
    </p>

  </form>
</div>

<script>
document.getElementById('checkout-form').addEventListener('submit', async (e) => {
  e.preventDefault();

  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const cart = JSON.parse(localStorage.getItem('cart')) || {};

  if (Object.keys(cart).length === 0) {
    alert("Το καλάθι είναι άδειο!");
    return;
  }

  const response = await fetch('place_order.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ name, email, cart })
  });

  const result = await response.json();
  if (result.success) {
    localStorage.removeItem('cart');
    document.getElementById('checkout-form').reset();
    document.getElementById('success-message').classList.remove('hidden');
    updateCartCounter(); // Ενημέρωση μετρητή
  } else {
    alert("Κάτι πήγε στραβά...");
  }
});
</script>

<script src="add-to-cart.js"></script>
<?php include 'partials/footer.php'; ?>

<?php include 'partials/header.php'; ?>

<div class="max-w-4xl mx-auto mt-10 p-4 bg-white shadow rounded-lg">
  <h1 class="text-2xl font-bold mb-6">🛒 Το Καλάθι Μου</h1>
  <table class="w-full text-left border">
  <thead>
  <tr>
    <th class="border px-4 py-2">Προϊόν</th>
    <th class="border px-4 py-2">Ποσότητα</th>
    <th class="border px-4 py-2">Τιμή</th>
    <th class="border px-4 py-2">Σύνολο</th>
    <th class="border px-4 py-2"></th> <!-- κουμπι αφαιρεσης-->
  </tr>
</thead>

    <tbody id="cart-items"></tbody>
  </table>

  <div class="text-right mt-4 text-lg font-semibold">
    Σύνολο: <span id="cart-total">0.00€</span>
  </div>

  <div class="text-right mt-4">
    <a href="checkout.php" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded">
      Ολοκλήρωση Παραγγελίας
    </a>
  </div>
</div>

<script src="add-to-cart.js"></script> <!-- 👈 προσθέτουμε αυτό -->
<script src="cart.js" type="module"></script>


<?php include 'partials/footer.php'; ?>


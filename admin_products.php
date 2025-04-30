<?php include 'partials/header.php'; ?>
<?php require 'db.php'; ?>

<div class="max-w-5xl mx-auto py-10 px-4">
  <h1 class="text-3xl font-bold mb-6">Προϊόντα</h1>

  <a href="add_product.php" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
    ➕ Προσθήκη Προϊόντος
  </a>

  <table class="w-full border text-left">
    <thead>
      <tr>
        <th class="border px-4 py-2">#</th>
        <th class="border px-4 py-2">Εικόνα</th>
        <th class="border px-4 py-2">Όνομα</th>
        <th class="border px-4 py-2">Τιμή</th>
        <th class="border px-4 py-2">Κατηγορία</th>
        <th class="border px-4 py-2">Ενέργειες</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stmt = $pdo->query("SELECT * FROM products");
      foreach ($stmt as $product):
      ?>
      <tr>
        <td class="border px-4 py-2"><?= $product['id'] ?></td>
        <td class="border px-4 py-2">
          <img src="<?= htmlspecialchars($product['image']) ?>" class="h-12 w-12 object-contain" alt="">
        </td>
        <td class="border px-4 py-2"><?= htmlspecialchars($product['name']) ?></td>
        <td class="border px-4 py-2">€<?= number_format($product['price'], 2) ?></td>
        <td class="border px-4 py-2"><?= htmlspecialchars($product['category']) ?></td>
        <td class="border px-4 py-2">
          <a href="edit_product.php?id=<?= $product['id'] ?>" class="text-blue-600 hover:underline mr-2">✏️ Επεξεργασία</a>
          <a href="delete_product.php?id=<?= $product['id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('Είσαι σίγουρος;')">🗑️ Διαγραφή</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include 'partials/footer.php'; ?>

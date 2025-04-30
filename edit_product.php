<?php

include 'partials/header.php';
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) die("ID δεν βρέθηκε.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $image = $_POST['image'];
  $category = $_POST['category'];

  $stmt = $pdo->prepare("UPDATE products SET name=?, description=?, price=?, image=?, category=? WHERE id=?");
  $stmt->execute([$name, $description, $price, $image, $category, $id]);

  header('Location: admin_products.php');
  exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();
?>
<div class="max-w-xl mx-auto py-10 px-4">
  <h1 class="text-2xl font-bold mb-6">Επεξεργασία Προϊόντος</h1>
  <form method="POST" class="space-y-4">
    <input name="name" type="text" value="<?= htmlspecialchars($product['name']) ?>" required class="w-full border p-2 rounded">
    <textarea name="description" required class="w-full border p-2 rounded"><?= htmlspecialchars($product['description']) ?></textarea>
    <input name="price" type="number" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required class="w-full border p-2 rounded">
    <input name="image" type="text" value="<?= htmlspecialchars($product['image']) ?>" required class="w-full border p-2 rounded">
    <input name="category" type="text" value="<?= htmlspecialchars($product['category']) ?>" required class="w-full border p-2 rounded">
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Αποθήκευση</button>
  </form>
</div>
<?php include 'partials/footer.php'; ?>

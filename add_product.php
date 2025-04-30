<?php
include 'partials/header.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $image = $_POST['image'];
  $category = $_POST['category'];

  $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image, category) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute([$name, $description, $price, $image, $category]);

  header('Location: admin_products.php');
  exit;
}
?>
<div class="max-w-xl mx-auto py-10 px-4">
  <h1 class="text-2xl font-bold mb-6">Προσθήκη Προϊόντος</h1>
  <form method="POST" class="space-y-4">
    <input name="name" type="text" placeholder="Όνομα" required class="w-full border p-2 rounded">
    <textarea name="description" placeholder="Περιγραφή" required class="w-full border p-2 rounded"></textarea>
    <input name="price" type="number" step="0.01" placeholder="Τιμή" required class="w-full border p-2 rounded">
    <input name="image" type="text" placeholder="URL Εικόνας" required class="w-full border p-2 rounded">
    <input name="category" type="text" placeholder="Κατηγορία" required class="w-full border p-2 rounded">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Αποθήκευση</button>
  </form>
</div>
<?php include 'partials/footer.php'; ?>

<?php
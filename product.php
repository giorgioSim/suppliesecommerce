<?php include 'partials/header.php'; ?>
<?php require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) die("Το προϊόν δεν βρέθηκε");

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) die("Το προϊόν δεν βρέθηκε");
?>

<div class="max-w-4xl mx-auto py-10 px-4">
  <div class="bg-white shadow p-6 rounded-lg">
    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="h-64 w-full object-contain mb-4">
    <h1 class="text-2xl font-bold mb-2"><?= htmlspecialchars($product['name']) ?></h1>
    <p class="text-gray-700 mb-2"><?= htmlspecialchars($product['description']) ?></p>
    <p class="text-purple-600 font-semibold mb-4">€<?= number_format($product['price'], 2) ?></p>
    <button onclick="addToCart(<?= $product['id'] ?>)"
      class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-2 rounded">Προσθήκη στο καλάθι</button>
  </div>

  <?php
$stmt = $pdo->prepare("SELECT * FROM products WHERE category = ? AND id != ? LIMIT 4");
$stmt->execute([$product['category'], $product['id']]);
$related = $stmt->fetchAll();
?>

<?php if ($related): ?>
  <h2 class="text-xl font-semibold mt-10 mb-4">Σχετικά προϊόντα</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
    <?php foreach ($related as $item): ?>
      <div class="bg-white shadow rounded p-4">
        <img src="<?= htmlspecialchars($item['image']) ?>" class="h-32 w-full object-contain mb-2">
        <h3 class="font-bold text-sm"><?= htmlspecialchars($item['name']) ?></h3>
        <p class="text-purple-600 font-semibold">€<?= number_format($item['price'], 2) ?></p>
        <a href="product.php?id=<?= $item['id'] ?>" class="text-blue-500 text-sm mt-2 inline-block">Δες περισσότερα</a>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<script src="add-to-cart.js"></script>
<script src="toast.js"></script>


<?php include 'partials/footer.php'; ?>
<?php include 'partials/header.php'; ?>
<?php require 'db.php'; ?>

<?php
$category = $_GET['category'] ?? null;
if (!$category) die("Κατηγορία δεν βρέθηκε");

$sort = $_GET['sort'] ?? '';
$min = $_GET['min_price'] ?? '';
$max = $_GET['max_price'] ?? '';
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$perPage = 6;
$offset = ($page - 1) * $perPage;

$query = "SELECT * FROM products WHERE category = ?";
$params = [$category];

if ($min !== '') {
  $query .= " AND price >= ?";
  $params[] = $min;
}
if ($max !== '') {
  $query .= " AND price <= ?";
  $params[] = $max;
}

switch ($sort) {
  case 'name_asc':  $query .= " ORDER BY name ASC"; break;
  case 'name_desc': $query .= " ORDER BY name DESC"; break;
  case 'price_asc': $query .= " ORDER BY price ASC"; break;
  case 'price_desc': $query .= " ORDER BY price DESC"; break;
  default: $query .= " ORDER BY id DESC";
}

$query .= " LIMIT $perPage OFFSET $offset";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll();

// Count total products for pagination
$countQuery = "SELECT COUNT(*) FROM products WHERE category = ?";
$countParams = [$category];
if ($min !== '') {
  $countQuery .= " AND price >= ?";
  $countParams[] = $min;
}
if ($max !== '') {
  $countQuery .= " AND price <= ?";
  $countParams[] = $max;
}
$countStmt = $pdo->prepare($countQuery);
$countStmt->execute($countParams);
$totalProducts = $countStmt->fetchColumn();
$totalPages = ceil($totalProducts / $perPage);
?>

<div class="max-w-6xl mx-auto px-4 py-10">
  <h1 class="text-2xl font-bold mb-6">Κατηγορία: <?= htmlspecialchars($category) ?></h1>

  <form method="GET" class="mb-6 flex flex-wrap gap-4 items-center">
    <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
    <label class="text-sm font-medium">
      Ταξινόμηση:
      <select name="sort" class="ml-2 border p-1 rounded">
        <option value="">Default</option>
        <option value="name_asc" <?= $sort === 'name_asc' ? 'selected' : '' ?>>Όνομα (Α-Ω)</option>
        <option value="name_desc" <?= $sort === 'name_desc' ? 'selected' : '' ?>>Όνομα (Ω-Α)</option>
        <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Τιμή ↑</option>
        <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Τιμή ↓</option>
      </select>
    </label>

    <label class="text-sm font-medium">
      Από:
      <input type="number" name="min_price" step="0.01" value="<?= htmlspecialchars($min) ?>" class="ml-1 w-24 border p-1 rounded">
    </label>

    <label class="text-sm font-medium">
      Έως:
      <input type="number" name="max_price" step="0.01" value="<?= htmlspecialchars($max) ?>" class="ml-1 w-24 border p-1 rounded">
    </label>

    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded text-sm">Εφαρμογή</button>
  </form>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <?php foreach ($products as $product): ?>
      <div class="bg-white shadow rounded-lg p-4 flex flex-col justify-between">
        <a href="product.php?id=<?= $product['id'] ?>">
          <img src="<?= htmlspecialchars($product['image']) ?>" class="h-40 w-full object-contain mb-4">
          <h3 class="font-bold text-sm hover:underline"><?= htmlspecialchars($product['name']) ?></h3>
        </a>
        <p class="text-purple-600 font-semibold">€<?= number_format($product['price'], 2) ?></p>
        <button onclick="addToCart(<?= $product['id'] ?>)"
                class="mt-2 text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l font-medium rounded-lg text-sm px-5 py-2.5 text-center">
          Προσθήκη στο καλάθι
        </button>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if ($totalPages > 1): ?>
    <div class="mt-10 flex justify-center space-x-2">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="category.php?category=<?= urlencode($category) ?>&sort=<?= urlencode($sort) ?>&min_price=<?= $min ?>&max_price=<?= $max ?>&page=<?= $i ?>"
           class="px-4 py-2 border rounded <?= $i == $page ? 'bg-purple-600 text-white' : 'bg-white text-purple-600' ?>">
          <?= $i ?>
        </a>
      <?php endfor; ?>
    </div>
  <?php endif; ?>
</div>

<script src="add-to-cart.js"></script>
<script src="toast.js"></script>

<?php include 'partials/footer.php'; ?>

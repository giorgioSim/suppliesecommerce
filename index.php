<?php include 'partials/header.php'; ?>
<?php require 'db.php'; ?>

<?php


$sort = $_GET['sort'] ?? '';
$min = $_GET['min_price'] ?? '';
$max = $_GET['max_price'] ?? '';
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$perPage = 6;
$offset = ($page - 1) * $perPage;

$query = "SELECT * FROM products WHERE 1";
$params = [];

$search = $_GET['search'] ?? '';
if ($search !== '') {
  $query .= " AND (name LIKE ? OR description LIKE ?)";
  $params[] = "%$search%";
  $params[] = "%$search%";
}


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

$countQuery = "SELECT COUNT(*) FROM products WHERE 1";
$countParams = [];
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




<?php
// για να βρεθει το προιον του μηνα
$bestStmt = $pdo->prepare("
  SELECT p.*, SUM(oi.quantity) AS total_sold
  FROM products p
  JOIN order_items oi ON p.id = oi.product_id
  JOIN orders o ON o.id = oi.order_id
  WHERE o.created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
  GROUP BY p.id
  ORDER BY total_sold DESC
  LIMIT 1
");
$bestStmt->execute();
$bestProduct = $bestStmt->fetch();

// για 2 τυχαια προιοντα
$carouselStmt = $pdo->prepare("SELECT * FROM products WHERE id != ? ORDER BY RAND() LIMIT 2");
$carouselStmt->execute([$bestProduct['id'] ?? 0]);
$carouselItems = $carouselStmt->fetchAll();

// για να μπει το προιον του μηνα στην αρχη
if ($bestProduct) {
  array_unshift($carouselItems, $bestProduct);
}
?>

<div class="relative overflow-hidden rounded-lg shadow mb-10 mx-auto w-full max-w-4xl">
  <div id="carousel" class="whitespace-nowrap transition-all duration-500">
    <?php foreach ($carouselItems as $item): ?>
      <div class="inline-block w-full sm:w-full md:w-full p-6 
        <?= ($bestProduct && $item['id'] == $bestProduct['id']) ? 'glow-border bg-yellow-50' : 'bg-white' ?>">

        <div class="flex flex-col md:flex-row items-center gap-6">
          <!-- εικονα -->
          <div class="flex-shrink-0 w-full md:w-1/2">
            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"
                 class="h-64 w-full object-contain rounded">
          </div>
          <!-- κειμενα -->
          <div class="w-full md:w-1/2 text-center md:text-left">
          <?php if ($bestProduct && $item['id'] == $bestProduct['id']): ?>
                <span class="block text-yellow-500 font-semibold mb-1">
                  <span class="inline-block pulse-crown">👑 Προϊόν του Μήνα</span>
                </span>
              <?php endif; ?>
            <h2 class="text-2xl font-bold text-purple-700 mb-2">
              <?= htmlspecialchars($item['name']) ?>
            </h2>
            <p class="text-sm text-gray-600 mb-4"><?= htmlspecialchars($item['description']) ?></p>
            <p class="text-xl font-semibold text-pink-600">€<?= number_format($item['price'], 2) ?></p>
            <button onclick="addToCart(<?= $item['id'] ?>)"
                    class="mt-2 text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Προσθήκη στο καλάθι
            </button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script>
let index = 0;
const slides = document.querySelectorAll('#carousel > div');
function showSlide(i) {
  const offset = i * slides[0].offsetWidth;
  document.getElementById('carousel').style.transform = `translateX(-${offset}px)`;
}
setInterval(() => {
  index = (index + 1) % slides.length;
  showSlide(index);
}, 3000);
</script>



<form method="GET" class="mb-6 flex flex-wrap gap-4 items-center justify-center">
  <label class="text-sm font-medium">
    Ταξινόμηση:
    <select name="sort" class="ml-2 border p-1 rounded">
      <option value="">Προκαθορισμένη</option>
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

<div class="container mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold mb-6">Προϊόντα</h1>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    <?php foreach ($products as $product): ?>
      <div class="bg-white shadow rounded-lg p-4 flex flex-col justify-between">
        <a href="product.php?id=<?= $product['id'] ?>">
          <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="h-40 w-full object-contain mb-4">
          <h2 class="text-lg font-semibold hover:underline"><?= htmlspecialchars($product['name']) ?></h2>
        </a>
        <p class="text-gray-600"><?= htmlspecialchars($product['category']) ?></p>
        <p class="text-purple-600 font-bold mt-2">€<?= number_format($product['price'], 2) ?></p>
        <button onclick="addToCart(<?= $product['id'] ?>)"
          class="mt-4 text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
          Προσθήκη στο καλάθι
        </button>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if ($totalPages > 1): ?>
    <div class="mt-10 flex justify-center space-x-2">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="index.php?sort=<?= urlencode($sort) ?>&min_price=<?= $min ?>&max_price=<?= $max ?>&page=<?= $i ?>"
           class="px-4 py-2 border rounded <?= $i == $page ? 'bg-purple-600 text-white' : 'bg-white text-purple-600' ?>">
          <?= $i ?>
        </a>
      <?php endfor; ?>
    </div>
  <?php endif; ?>
</div>

<script src="add-to-cart.js"></script>
<script src="toast.js"></script>

<script>
let index = 0;
const slides = document.querySelectorAll('#carousel > div');
function showSlide(i) {
  const offset = i * slides[0].offsetWidth;
  document.getElementById('carousel').style.transform = `translateX(-${offset}px)`;
}
setInterval(() => {
  index = (index + 1) % slides.length;
  showSlide(index);
}, 3000);
</script>

<script src="add-to-cart.js"></script>
<script src="toast.js"></script>

<?php include 'partials/footer.php'; ?>
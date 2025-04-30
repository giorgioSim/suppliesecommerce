<?php
require 'db.php';




// TOP 5 προϊόντα
$stmt = $pdo->query("
  SELECT p.name, SUM(oi.quantity) as total
  FROM order_items oi
  JOIN products p ON oi.product_id = p.id
  GROUP BY oi.product_id
  ORDER BY total DESC
  LIMIT 5
");

$topProducts = ['labels' => [], 'values' => []];
foreach ($stmt as $row) {
  $topProducts['labels'][] = $row['name'];
  $topProducts['values'][] = (int) $row['total'];
}

// ΕΣΟΔΑ ΑΝΑ ΜΗΝΑ
$stmt = $pdo->query("
  SELECT DATE_FORMAT(created_at, '%Y-%m') as month, SUM(total_price) as revenue
  FROM orders
  GROUP BY month
  ORDER BY month ASC
");

$monthlyRevenue = ['labels' => [], 'values' => []];
foreach ($stmt as $row) {
  $monthlyRevenue['labels'][] = $row['month'];
  $monthlyRevenue['values'][] = (float) $row['revenue'];
}

echo json_encode([
  'topProducts' => $topProducts,
  'monthlyRevenue' => $monthlyRevenue
]);

<?php
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$cart = $data['cart'] ?? [];

if (!$name || !$email || empty($cart)) {
  echo json_encode(['success' => false]);
  exit;
}

$total = 0;
foreach ($cart as $id => $qty) {
  $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
  $stmt->execute([$id]);
  $price = $stmt->fetchColumn();
  $total += $price * $qty;
}

$stmt = $pdo->prepare("INSERT INTO orders (customer_name, customer_email, total_price, created_at) VALUES (?, ?, ?, NOW())");
$stmt->execute([$name, $email, $total]);
$orderId = $pdo->lastInsertId();

foreach ($cart as $id => $qty) {
  $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
  $stmt->execute([$orderId, $id, $qty]);
}

echo json_encode(['success' => true]);

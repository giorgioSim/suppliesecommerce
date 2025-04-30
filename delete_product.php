<?php

require 'db.php';

$id = $_GET['id'] ?? null;
if ($id) {
  $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
  $stmt->execute([$id]);
}

header('Location: admin_products.php');
exit;

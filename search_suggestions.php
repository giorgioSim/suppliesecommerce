<?php
require 'db.php';
header('Content-Type: application/json');

$q = trim($_GET['q'] ?? '');

if (strlen($q) < 2) {
  echo json_encode([]);
  exit;
}

$stmt = $pdo->prepare("SELECT id, name, image FROM products WHERE name LIKE ? LIMIT 5");
$stmt->execute(["%$q%"]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);

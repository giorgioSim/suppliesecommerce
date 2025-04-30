<?php include 'partials/header.php'; ?>
<?php require 'db.php'; ?>

<div class="max-w-5xl mx-auto py-10 px-4">
  <h1 class="text-3xl font-bold mb-6">📦 Παραγγελίες</h1>

  <?php
  $stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
  $orders = $stmt->fetchAll();

  foreach ($orders as $order):
  ?>
    <div class="bg-white shadow-md rounded p-4 mb-6">
      <h2 class="text-lg font-semibold mb-2">Παραγγελία #<?= $order['id'] ?></h2>
      <p>Πελάτης: <?= htmlspecialchars($order['customer_name']) ?> (<?= htmlspecialchars($order['customer_email']) ?>)</p>
      <p>Σύνολο: €<?= number_format($order['total_price'], 2) ?></p>
      <p>Ημερομηνία: <?= $order['created_at'] ?></p>

      <h3 class="mt-4 font-semibold">Προϊόντα:</h3>
      <ul class="list-disc ml-6">
        <?php
        $stmtItems = $pdo->prepare("SELECT p.name, oi.quantity
                                    FROM order_items oi
                                    JOIN products p ON oi.product_id = p.id
                                    WHERE oi.order_id = ?");
        $stmtItems->execute([$order['id']]);
        foreach ($stmtItems as $item):
        ?>
          <li><?= htmlspecialchars($item['name']) ?> × <?= $item['quantity'] ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endforeach; ?>
</div>

<?php include 'partials/footer.php'; ?>

<?php include 'partials/header.php'; ?>
<?php require 'db.php'; ?>

<div class="max-w-4xl mx-auto py-10 px-4">
  <h1 class="text-3xl font-bold mb-6">Admin Panel</h1>

  <div class="mb-8 flex gap-4">
    <a href="admin_products.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">💠 Διαχείριση Προϊόντων</a>
    <a href="admin_orders.php" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">📦 Προβολή Παραγγελιών</a>
  </div>
</div>

<div class="my-12">
  <h2 class="text-xl font-semibold mb-4">📊 Στατιστικά Προϊόντων</h2>
  <canvas id="productChart" class="mb-10"></canvas>
  <canvas id="revenueChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="cart.js"></script>
<script src="add-to-cart.js"></script>



<script>
document.addEventListener("DOMContentLoaded", () => {
  fetch('chart_data.php')
    .then(res => res.json())
    .then(data => {
      // Προϊόντα
      new Chart(document.getElementById('productChart'), {
        type: 'bar',
        data: {
          labels: data.topProducts.labels,
          datasets: [{
            label: 'Πωλήσεις',
            data: data.topProducts.values,
            backgroundColor: 'rgba(151, 50, 246, 0.6)'
          }]
        },
        options: {
          responsive: true,
          plugins: { title: { display: true, text: 'Top 5 Προϊόντα' } }
        }
      });

      // Έσοδα
      new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
          labels: data.monthlyRevenue.labels,
          datasets: [{
            label: 'Έσοδα (€)',
            data: data.monthlyRevenue.values,
            borderColor: 'rgb(34, 197, 94)',
            fill: false
          }]
        },
        options: {
          responsive: true,
          plugins: { title: { display: true, text: 'Έσοδα ανά Μήνα' } }
        }
      });
    });
});
</script>


<?php include 'partials/footer.php'; ?>
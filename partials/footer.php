</main>

<!-- Newsletter -->
<div class="bg-purple-50 py-10 px-4 sm:px-6 lg:px-8">
  <div class="max-w-3xl mx-auto text-center">
    <h2 class="text-2xl font-bold text-purple-700 mb-4">Εγγραφή στο Newsletter μας!</h2>
    <p class="text-gray-600 mb-6">Μάθε πρώτος για νέες προσφορές, προϊόντα και εκπτώσεις.</p>
    <form class="flex flex-col sm:flex-row items-center gap-4 justify-center">
      <input type="email" name="email" placeholder="Το email σου..."
             class="w-full sm:w-80 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400 text-sm" />
      <button type="submit"
              class="w-full sm:w-auto bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l text-white font-semibold rounded px-6 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
        Εγγραφή
      </button>
    </form>
  </div>
</div>


<footer class="mt-auto w-full bg-white border-t text-gray-600 py-6 text-center text-sm">
    &copy; <?= date('Y') ?> Giorgio Supplies Store
    <span class="mx-2">|</span>
  <a href="admin.php" class="text-blue-500 hover:underline">Admin</a>
  </footer>

  <!-- FAQ Popup -->
<div id="faq-popup" class="fixed bottom-24 right-4 bg-white border border-purple-200 shadow-xl p-4 rounded-lg w-80 max-w-xs hidden z-50">
  <div class="flex justify-between items-center mb-2">
    <h3 class="font-semibold text-lg text-purple-700">Συχνές Ερωτήσεις</h3>
    <button onclick="toggleFAQ()" class="text-gray-500 hover:text-red-500 text-xl">&times;</button>
  </div>
  <ul class="text-sm text-gray-700 space-y-2 overflow-y-auto max-h-64">
    <li><strong>📦 Πότε θα παραλάβω την παραγγελία μου;</strong><br>Συνήθως σε 2-3 εργάσιμες ημέρες.</li>
    <li><strong>💳 Τρόποι Πληρωμής;</strong><br>Μόνο αντικαταβολή αυτή τη στιγμή.</li>
    <li><strong>🔁 Μπορώ να επιστρέψω προϊόντα;</strong><br>Ναι, εντός 14 ημερών.</li>
    <li><strong>🛒 Μπορώ να αλλάξω την παραγγελία μου;</strong><br>Επικοινώνησε άμεσα μαζί μας.</li>
    <li><strong>📧 Δεν πήρα email επιβεβαίωσης!</strong><br>Δες τα spam ή επικοινώνησε μαζί μας.</li>
  </ul>
</div>

<!-- Help  -->
<button onclick="toggleFAQ()"
        class="fixed bottom-5 right-4 bg-purple-600 text-white px-4 py-2 rounded-full shadow-lg hover:bg-purple-700 z-50 text-sm md:text-base">
  💬 Βοήθεια
</button>

<script>
  function toggleFAQ() {
    const popup = document.getElementById('faq-popup');
    popup.classList.toggle('hidden');
  }
</script>


  <script src="assets/js/cart.js"></script>
</body>
</html>

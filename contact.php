<?php include 'partials/header.php'; ?>

<div class="max-w-3xl mx-auto px-4 py-10">
  <h1 class="text-2xl font-bold mb-4">Επικοινωνία</h1>
  <p class="mb-6">Για οποιαδήποτε απορία, μπορείτε να επικοινωνήσετε μαζί μας συμπληρώνοντας την παρακάτω φόρμα ή στέλνοντάς μας email στο <strong>support@giorgiosupplies.com</strong>.</p>

  <form method="post" class="bg-white shadow p-6 rounded-lg space-y-4">
    <input type="text" name="name" placeholder="Το όνομά σας" class="w-full border p-2 rounded" required>
    <input type="email" name="email" placeholder="Το email σας" class="w-full border p-2 rounded" required>
    <textarea name="message" rows="5" placeholder="Το μήνυμά σας" class="w-full border p-2 rounded" required></textarea>
    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Αποστολή</button>
  </form>
</div>

<script src="add-to-cart.js"></script>
<script src="cart.js"></script>


<?php include 'partials/footer.php'; ?>

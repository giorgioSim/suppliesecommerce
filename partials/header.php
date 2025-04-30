<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <title>Giorgio Supplies Store</title>
  <link rel="icon" type="image/png" href="assets/icon.png">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
  tailwind.config = {
    darkMode: 'class',
    theme: {
      extend: {
        colors: {
          primary: '#a855f7',
          secondary: '#ec4899'
        }
      }
    }
  };
</script>

  <style>
    #main-menu {
      transition: max-height 0.3s ease-out;
    }

    <style>
  @keyframes fadeInOut {
    0% { opacity: 0; transform: translateY(-10px); }
    10%, 90% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(-10px); }
  }
  .animate-fade {
    animation: fadeInOut 3s ease-in-out;
  }

  @keyframes crownPulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.2); opacity: 0.8; }
  }

  .pulse-crown {
    display: inline-block;
    animation: crownPulse 1.5s infinite;
  }

  @keyframes glow {
    0% { box-shadow: 0 0 0px rgba(255, 215, 0, 0.5); }
    50% { box-shadow: 0 0 20px rgba(255, 215, 0, 0.8); }
    100% { box-shadow: 0 0 0px rgba(255, 215, 0, 0.5); }
  }

  .glow-border {
    border: 2px solid rgba(255, 215, 0, 0.6); /* gold */
    animation: glow 2s ease-in-out infinite;
    border-radius: 1rem;
  }

/* Fade-in animation */
.fade-enter {
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    display: block;
  }

  .fade-enter-active {
    opacity: 1;
    transform: translateY(0);
  }

  .fade-leave {
    opacity: 1;
    transform: translateY(0);
    transition: all 0.3s ease;
  }

  .fade-leave-active {
    opacity: 0;
    transform: translateY(-10px);
    display: none;
  }

</style>

  </style>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">

  <header class="bg-white shadow z-50 sticky top-0 mb-4">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
      <!-- Logo -->
      <a href="index.php" class="text-2xl font-bold bg-gradient-to-r from-purple-500 to-pink-500 text-transparent bg-clip-text">
        Giorgio Supplies Store
      </a>

         <!-- Mobile Burger Button -->
         <button id="menu-toggle" class="md:hidden focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>

       <!-- ναβ -->
    <nav id="main-menu" class="hidden md:flex md:flex-row flex-col md:space-x-6 text-sm font-medium bg-white md:bg-transparent w-full md:w-auto px-4 pb-4 md:px-0 md:pb-0">
      <a href="category.php?category=Notebooks" class="block py-1 md:py-0 hover:text-purple-600">Notebooks</a>
      <a href="category.php?category=Pens" class="block py-1 md:py-0 hover:text-purple-600">Pens</a>
      <a href="category.php?category=Backpacks" class="block py-1 md:py-0 hover:text-purple-600">Backpacks</a>
      <a href="category.php?category=Accessories" class="block py-1 md:py-0 hover:text-purple-600">Accessories</a>
      <a href="contact.php" class="block py-1 md:py-0 hover:text-purple-600">Contact</a>
      <a href="about.php" class="block py-1 md:py-0 hover:text-purple-600">About Us</a>
    </nav>

       <!-- αναζητηση -->
       <div class="relative hidden md:flex flex-1 max-w-xs">
         <input type="text" id="live-search" name="search"
         placeholder="Αναζήτηση..."
         autocomplete="off"
         class="w-full border border-gray-300 rounded px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
        <div id="search-results" class="absolute top-full left-0 right-0 bg-white border border-gray-200 shadow rounded mt-1 hidden z-50"></div>
      </div>


      <!-- καλαθι -->
      <div class="relative group ml-4 md:ml-0">
  <a href="cart.php" class="relative">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke-width="2" stroke="url(#cartGrad)" class="w-6 h-6">
      <defs>
        <linearGradient id="cartGrad" x1="0%" y1="0%" x2="100%" y2="0%">
          <stop offset="0%" stop-color="#a855f7" />
          <stop offset="100%" stop-color="#ec4899" />
        </linearGradient>
      </defs>
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.3 5.2a1 1 0 001 1.3h11.6a1 1 0 001-1.3L17 13M9 21h.01M15 21h.01" />
    </svg>
    <span id="cart-count"
          class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full">
      0
    </span>
  </a>

  

  <!-- Mini Cart -->
  <div id="mini-cart" class="absolute right-0 mt-2 w-64 bg-white border rounded-lg shadow-lg p-4 hidden z-50">
    <div id="mini-cart-items" class="max-h-60 overflow-y-auto text-sm text-gray-700 space-y-2"></div>
    <div class="border-t mt-2 pt-2 text-right">
      <div class="font-semibold">Σύνολο: <span id="mini-cart-total">0€</span></div>
      <a href="cart.php" class="text-purple-600 hover:underline text-sm mt-1 inline-block">Μετάβαση στο καλάθι →</a>
    </div>
  </div>
</div>
</div>
   
  </header>

  <script src="live-search.js" defer></script>
  <script src="cart.js" defer></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggle = document.getElementById('menu-toggle');
      const menu = document.getElementById('main-menu');

      toggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
      });
    });
  </script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const cartIcon = document.querySelector('.group > a');
    const miniCart = document.getElementById('mini-cart');

    if (cartIcon && miniCart) {
      cartIcon.addEventListener('mouseenter', () => {
        miniCart.classList.remove('hidden');
        miniCart.classList.add('fade-enter');
        setTimeout(() => {
          miniCart.classList.add('fade-enter-active');
        }, 10);
      });

      cartIcon.addEventListener('mouseleave', () => {
        miniCart.classList.remove('fade-enter', 'fade-enter-active');
        miniCart.classList.add('fade-leave');
        setTimeout(() => {
          miniCart.classList.add('fade-leave-active');
          miniCart.classList.add('hidden');
          miniCart.classList.remove('fade-leave', 'fade-leave-active');
        }, 300);
      });

      // για να κραταει το μινι καρτ ανοιχτο
      miniCart.addEventListener('mouseenter', () => {
        miniCart.classList.remove('hidden');
        miniCart.classList.add('fade-enter');
        setTimeout(() => {
          miniCart.classList.add('fade-enter-active');
        }, 10);
      });

      miniCart.addEventListener('mouseleave', () => {
        miniCart.classList.remove('fade-enter', 'fade-enter-active');
        miniCart.classList.add('fade-leave');
        setTimeout(() => {
          miniCart.classList.add('fade-leave-active');
          miniCart.classList.add('hidden');
          miniCart.classList.remove('fade-leave', 'fade-leave-active');
        }, 300);
      });
    }
  });
</script>


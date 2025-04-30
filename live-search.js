document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('live-search');
  const results = document.getElementById('search-results');

  input.addEventListener('input', () => {
    const query = input.value.trim();

    if (query.length < 2) {
      results.classList.add('hidden');
      return;
    }

    fetch(`search_suggestions.php?q=${encodeURIComponent(query)}`)
      .then(res => res.json())
      .then(data => {
        results.innerHTML = '';

        if (data.length === 0) {
          results.classList.add('hidden');
          return;
        }

        data.forEach(product => {
          const item = document.createElement('a');
          item.href = `product.php?id=${product.id}`;
          item.className = 'flex items-center gap-3 px-4 py-2 text-sm hover:bg-gray-100 text-gray-700';
          item.innerHTML = `
            <div class="flex items-center gap-3">
              <img src="${product.image}" alt="${product.name}" class="w-10 h-10 object-contain rounded">
               <span>${product.name}</span>
            </div>
`;

          results.appendChild(item);
        });

        results.classList.remove('hidden');
      });
  });

  // να κλεινει το ντροπ στο εξω κλικ
  document.addEventListener('click', e => {
    if (!e.target.closest('#live-search') && !e.target.closest('#search-results')) {
      results.classList.add('hidden');
    }
  });
});

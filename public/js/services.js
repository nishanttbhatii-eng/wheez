(function () {
  var searchInput = document.getElementById('svcSearchInput');
  var searchForm = document.getElementById('svcSearchForm');
  var filters = document.getElementById('svcFilters');
  var emptyState = document.getElementById('svcEmpty');
  var categories = document.querySelectorAll('.svc-category');
  var items = document.querySelectorAll('.svc-item');
  var activeFilter = 'all';

  function applyFilters() {
    var query = (searchInput && searchInput.value || '').trim().toLowerCase();
    var visibleCount = 0;

    categories.forEach(function (category) {
      var categoryId = category.getAttribute('data-category');
      var categoryMatch = activeFilter === 'all' || activeFilter === categoryId;
      var categoryVisibleItems = 0;

      category.querySelectorAll('.svc-item').forEach(function (item) {
        var name = item.getAttribute('data-name') || '';
        var textMatch = !query || name.indexOf(query) !== -1;
        var show = categoryMatch && textMatch;

        item.classList.toggle('svc-item--hidden', !show);
        if (show) {
          categoryVisibleItems++;
          visibleCount++;
        }
      });

      category.classList.toggle('svc-category--hidden', !categoryMatch || categoryVisibleItems === 0);
    });

    if (emptyState) {
      emptyState.hidden = visibleCount > 0;
    }
  }

  if (filters) {
    filters.addEventListener('click', function (e) {
      var button = e.target.closest('.svc-filter');
      if (!button) return;

      activeFilter = button.getAttribute('data-filter') || 'all';
      filters.querySelectorAll('.svc-filter').forEach(function (btn) {
        btn.classList.toggle('svc-filter--active', btn === button);
      });
      applyFilters();
    });
  }

  if (searchInput) {
    searchInput.addEventListener('input', applyFilters);
  }

  if (searchForm) {
    searchForm.addEventListener('submit', function (e) {
      e.preventDefault();
      applyFilters();
    });
  }
})();

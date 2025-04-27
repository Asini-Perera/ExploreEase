document.addEventListener('DOMContentLoaded', function () {
  const userIconLink = document.getElementById('user-icon-link');
  const dropdown = document.getElementById('user-dropdown');

  // Right-click to toggle dropdown
  userIconLink.addEventListener('click', function (e) {
  e.preventDefault();

    // Toggle visibility
   dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  });

  // Close dropdown when clicking outside
  document.addEventListener('click', function (e) {
    if (!userIconLink.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.style.display = 'none';
    }
  });
});

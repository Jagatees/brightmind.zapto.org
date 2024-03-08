document.addEventListener('DOMContentLoaded', function () {
  // Function to create and show the popup
  function showPopup(imgSrc) {
      // Create the overlay div
      var overlay = document.createElement('div');
      overlay.classList.add('overlay');

      // Create the popup container
      var popupContainer = document.createElement('div');
      popupContainer.classList.add('popup-container');

      // Create the image element for the popup
      var popupImage = document.createElement('img');
      popupImage.src = imgSrc;

      // Append the image to the popup container
      popupContainer.appendChild(popupImage);

      // Append the popup container to the overlay
      overlay.appendChild(popupContainer);

      // Append the overlay to the body
      document.body.appendChild(overlay);

      // Add click event to close the popup
      overlay.addEventListener('click', function () {
          document.body.removeChild(overlay);
      });
  }

  function updateActiveNavItem() {
    // Base URL, if your 'href' attributes are relative paths, you might need to adjust this
    var baseURL = window.location.protocol + '//' + window.location.host + window.location.pathname;
    
    // Get all nav-links
    var navLinks = document.querySelectorAll('.nav-link');

    // Remove the 'active' class from all the nav links
    navLinks.forEach(function(navLink) {
        navLink.classList.remove('active');
    });

    // Add 'active' class to the nav link that corresponds to the current URL
    navLinks.forEach(function(navLink) {
        // Check if navLink href matches the current URL or the URL ends with the href (for relative paths)
        if (baseURL.endsWith(navLink.getAttribute('href'))) {
            navLink.classList.add('active');
        }
    });

    // Special case for the register link since it doesn't have the 'nav-link' class
    var registerLink = document.querySelector('a[href="register.php"]');
    if (registerLink && baseURL.endsWith('register.php')) {
        registerLink.classList.add('active');
    }
}

// Call this function on load and when the URL changes
updateActiveNavItem();

  // Attach click event to all images with the class 'article-img'
  var images = document.querySelectorAll('.article-img');
  images.forEach(function (img) {
      img.addEventListener('click', function (event) {
          event.preventDefault(); // Prevent default link behavior
          var imgSrc = event.target.parentNode.href; // Get the URL of the large image
          showPopup(imgSrc);
      });
  });
});




    // Add click event listener to the sidebar links for Navigation
    const navLinks = document.querySelectorAll('.sidebare a');
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            // Remove active class from all links
            navLinks.forEach(function(navLink) {
                navLink.classList.remove('active');
            });

            // Add active class to the clicked link
            this.classList.add('active');

            // Hide all menus
            document.querySelectorAll('.menu').forEach(function(menu) {
                menu.classList.remove('active');
            });

            // Show the corresponding menu
            const menuId = this.getAttribute('data-menu-id');
            const menu = document.getElementById(menuId);
            if (menu) {
                menu.classList.add('active');

                // Position the menu to the right of the navigation link
                const rect = this.getBoundingClientRect();
                const menuTop = rect.top + window.pageYOffset + this.offsetHeight;
                const menuLeft = rect.right + window.pageXOffset;
                menu.style.top = menuTop + 'px';
                menu.style.left = menuLeft + 'px';
            }
        });
    });

    // Function to toggle menu visibility
    function toggleMenu() {
        document.querySelectorAll('.menu').forEach(function(menu) {
            menu.classList.toggle('active');

            // Position the menu
            if (menu.classList.contains('active')) {
                const linkId = menu.getAttribute('id').replace('-menu', '');
                const link = document.querySelector(`[data-menu-id="${linkId}"]`);
                if (link) {
                    const rect = link.getBoundingClientRect();
                    const menuTop = rect.top + window.pageYOffset + link.offsetHeight;
                    const menuLeft = rect.right + window.pageXOffset;
                    menu.style.top = menuTop + 'px';
                    menu.style.left = menuLeft + 'px';
                }
            }
        });
    }

    // Add click event listener to show menu link
    const showMenuLink = document.getElementById('showMenu');
    if (showMenuLink) {
        showMenuLink.addEventListener('click', function(event) {
            toggleMenu(); // Call toggleMenu to toggle menu visibility
            event.preventDefault(); // Prevent default link behavior
            event.stopPropagation(); // Prevent the event from propagating to the document click listener
        });
    }

// Function to hide menu when clicking outside
document.addEventListener('click', function(event) {
    const isClickInsideTop = document.querySelector('.top').contains(event.target);
    const isClickInsideSidebar = event.target.closest('.sidebare');
  
    // If the click is not inside the top div, sidebar, or menu, hide all menus
    if (!isClickInsideTop && !isClickInsideSidebar) {
        // Hide all menus
        document.querySelectorAll('.menu').forEach(function(menu) {
            menu.classList.remove('active');
        });
    }
});


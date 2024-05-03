<aside>
    <nav>

        <!-- Left menu logo -->
        <div class="top">
            <div class="logo">
                <img src="logo/logo.png" alt="Logo">
                <h2>Educ<span class="danger">ation</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-symbols-outlined">close</span>
            </div>
        </div>
        
        <!-- Sidebar menu -->
        <div class="sidebare">
            <a href="#" class="active">
                <span class="material-symbols-outlined">grid_view</span>
                <h3>Dashboard</h3>
            </a>
            <a href="#"  data-menu-id="user-menu">
                <span class="material-symbols-outlined">person</span>
                <h3>Users</h3>
            </a>
            <a href="#" data-menu-id="resource-menu">
                <span class="material-symbols-outlined">library_books</span>
                <h3>Resources</h3>
            </a>
            <a href="#" data-menu-id="course-menu">
                <span class="material-symbols-outlined">auto_stories</span>
                <h3>Course Online</h3>
            </a>
           
            <a href="#" id="event-link" data-menu-id="event-menu">
                <span class="material-symbols-outlined">event</span>
                <h3>Event</h3>
                <span class="message-count">26</span> 
            </a>
           
            <a href="#" data-menu-id="meeting-menu">
                <span class="material-symbols-outlined">groups</span>
                <h3>Meeting</h3>
            </a>

            <a href="#">
                <span class="material-symbols-outlined">logout</span>
                <h3>Logout</h3>
            </a>
        </div>

    </nav>
</aside>

<div class="menu" id="user-menu">
    <ul>
        <!-- Menu items for User -->
        <li><a href="#">Profile</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#">Messages</a></li>
    </ul>
</div>

<div class="menu" id="resource-menu">
    <ul>
        <!-- Menu items for Resources -->
        <li><a href="#">Books</a></li>
        <li><a href="#">Articles</a></li>
        <li><a href="#">Videos</a></li>
    </ul>
</div>

<div class="menu" id="course-menu">
    <ul>
        <!-- Menu items for Course Online -->
        <li><a href="#">Programming</a></li>
        <li><a href="#">Design</a></li>
        <li><a href="#">Marketing</a></li>
    </ul>
</div>

<div class="menu" id="event-menu">
    <ul>
        <!-- Menu items for Events -->
        <li><a href="#">Upcoming</a></li>
        <li><a href="#">Past</a></li>
    </ul>
</div>

<div class="menu" id="meeting-menu">
    <ul>
        <!-- Menu items for Meetings -->
        <li><a href="#">Schedule</a></li>
        <li><a href="#">Agenda</a></li>
        <li><a href="#">Participants</a></li>
    </ul>
</div>

<script>
    const navLinks = document.querySelectorAll('.sidebare a');
    const showMenuLink = document.getElementById('showMenu');

    // Add click event listener to each navigation link
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
    showMenuLink.addEventListener('click', function(event) {
        toggleMenu(); // Call toggleMenu to toggle menu visibility
        event.preventDefault(); // Prevent default link behavior
        event.stopPropagation(); // Prevent the event from propagating to the document click listener
    });

    // Add click event listener to close the menu when clicking outside of it or the sidebar
    document.body.addEventListener('click', function(event) {
        const isMenuClicked = document.querySelectorAll('.menu').some(menu => menu.contains(event.target));
        const isSidebarClicked = event.target.closest('.sidebare');
        const isShowMenuClicked = event.target.closest('#showMenu');

        if (!isMenuClicked && !isSidebarClicked && !isShowMenuClicked) {
            document.querySelectorAll('.menu').forEach(menu => menu.classList.remove('active'));
        }
    });

</script>
<style>
    /* Menu styles */
    .menu {
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        display: none;
        z-index: 999; /* Ensure menu appears above other content */
    }

    .menu.active {
        display: block;
    }

       
    /* Apply styles to message-count conteur  red color*/
    #event-link .message-count {
        background: var(--color-danger);
        color: var(--color-white);
        padding: 2px 10px;
        font-size: 11px;
        border-radius: var(--border-radius-1);
    }


   
    .menu a {
            display: block;
            color: #fff; /* Text color */
            padding: 10px 20px; /* Padding for each item */
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s; /* Transition for background and transform */
            position: relative;
            z-index: 1; /* Ensure links appear above overlay */
        }
 /* Hover effect */
 .menu a:hover {
    background-color: #555; /* Hover background color */
    transform: translateX(10px); /* Move item 10px to the right on hover */
  }

  /* 3D effect */
  .menu a::before {
    content: "";
    position: absolute;
    top: 0;
    left: -20px;
    height: 100%;
    width: 20px;
    background-color: #333; /* Same as navbar background */
    transform: skewX(-20deg);
    z-index: -1;
    transition: background-color 0.3s; /* Transition for background color */
  }

 

      /* Menu styles */
      .menu {
    display: none; /* Initially hide the menu */
    position: absolute;
    width: 200px; /* Width of the menu */
    background-color: rgba(255, 255, 255, 0.5); /* Transparent background */
    padding: 10px;
    z-index: 1; /* Ensure it's above other content */
    left: 200px; /* Position the menu 200px from the left edge of the navbar */
    border: none; /* Remove border */
}

  .menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .menu li {
    padding: 5px 0;
  }

  .menu-item:hover .menu-overlay {
    display: block; /* Show overlay on hover */
  }
</style>

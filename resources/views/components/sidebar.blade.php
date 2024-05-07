<aside>
    <nav>
        <!-- Left menu logo -->
        <div class="top">
            <div class="logo">
                <img src="{{ asset('logo/logo.png') }}" alt="Logo">
                <h2>Educ<span class="danger">ation</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-symbols-outlined">close</span>
            </div>
        </div>
        
        <!-- Sidebar menu -->
        <div class="sidebare">
            <a href="{{ route('Dashboard') }}" class="active">
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
        <li><a href="{{ route('student.profile.edit') }}">Edit Profile</a></li>
        <li><a href="#">Messages</a></li>
    </ul>
</div>

<div class="menu" id="resource-menu">
    <ul>
        <!-- Menu items for Resources -->
        <li><a href="{{ route('resource.index') }}" data-resource-view="my" id="my-resource-link">My Resource</a></li>
        <li><a href="{{ route('resource.index') }}" data-resource-view="all" id="all-resource-link">All Resource</a></li>
        
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
    document.addEventListener('DOMContentLoaded', function() {
        // Function to toggle between My Resource and All Resource
        function toggleResourceView(view) {
            const myResourceDiv = document.querySelector('.my-resource');
            const allResourceDiv = document.querySelector('.all-resource');

            // Show/hide divs based on the view
            if (view === 'my') {
                myResourceDiv.style.display = 'block';
                allResourceDiv.style.display = 'none';
            } else {
                myResourceDiv.style.display = 'none';
                allResourceDiv.style.display = 'block';
            }
        }

        // Initially hide both resource divs when the page loads
        const myResourceDiv = document.querySelector('.my-resource');
        const allResourceDiv = document.querySelector('.all-resource');
        myResourceDiv.style.display = 'none';
        allResourceDiv.style.display = 'none';

        // Function to get URL parameters
        function getUrlParameter(name) {
            name = name.replace(/[[]/, '\\[').replace(/[\]]/, '\\]');
            const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            const results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        };

        // Check if the URL contains the 'view' parameter and toggle resource view accordingly
        const viewParam = getUrlParameter('view');
        if (viewParam === 'all') {
            toggleResourceView('all');
        } else {
            toggleResourceView('my');
        }

        // Add click event listener to the sidebar links for Resource
        document.querySelectorAll('[data-resource-view]').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior

                // Get the view type from the data attribute
                const view = this.getAttribute('data-resource-view');
                
                // Toggle resource view
                toggleResourceView(view);

                // Redirect to the resource index page with the view type as a query parameter
                const resourceIndexUrl = `${this.href}?view=${view}`;
                window.location.href = resourceIndexUrl;
            });
        });
    });
</script>
<script>
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


</script>

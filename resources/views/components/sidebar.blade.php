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
            <a href="{{ route($role.'.dashboard') }}">
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
        <li><a href="{{ route($role.'.profile.edit') }}">Edit Profile</a></li>
        <li><a href="{{ route('users.List') }}">list Users</a></li>
    </ul>
</div>

<div class="menu" id="resource-menu">
    <ul>
        <!-- Menu items for Resources -->
        <li><a href="{{ route('resource.index', ['view' => 'my']) }}" data-resource-view="my" id="my-resource-link">My Resource</a></li>
        <li><a href="{{ route('resource.index', ['view' => 'all']) }}" data-resource-view="all" id="all-resource-link">All Resource</a></li>
        
      
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

    <!-- JavaScript scripts -->
    
    <script src="{{ asset('assets/js/sidbarehidandshowresource.js') }}"></script>
    <script src="{{ asset('assets/js/sidebaremenu.js') }}"></script>
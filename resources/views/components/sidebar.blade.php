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
            @if ($role != 'expert')
            <a href="#"  data-menu-id="user-menu">
                <span class="material-symbols-outlined">person</span>
                <h3>Users</h3>
            </a>
            
            <a href="#" data-menu-id="pubandads-menu">
                <span class="material-symbols-outlined">hail</span>
                <h3>pubandads</h3>
            </a>
            @if ($role != 'guest')
            <a href="#" data-menu-id="resource-menu">
                <span class="material-symbols-outlined">library_books</span>
                <h3>Resources</h3>
            </a>
            <a href="#" data-menu-id="course-menu">
                <span class="material-symbols-outlined">auto_stories</span>
                <h3>Course Online</h3>
            </a>
            @endif
            @endif
            @if ($role == 'expert')
            @if ($role != 'guest')
            <a href="#" id="event-link" data-menu-id="event-menu">
                <span class="material-symbols-outlined">event</span>
                <h3>Event</h3>
                <span class="message-count">26</span> 
            </a>
            @endif
            @endif
            @if ($role != 'expert')
            @if ($role != 'admin')
            @if ($role != 'guest')
            <a href="#" id="event-link" data-menu-id="meeting-menu">
                <span class="material-symbols-outlined">groups</span>
                <h3>Meeting</h3>
                <span class="message-count" id="invitation-count"></span>
            </a>
            @endif
            @endif
            @endif
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
        @if ($role != 'admin' && $role != 'guest')
        <li><a href="{{ route($role.'.profile.edit') }}">Edit Profile</a></li>
        @endif
        <li><a href="{{ route('users.List') }}">list Users</a></li>
        @if ($role == 'admin')
        <li><a href="{{ route('demande-inscriptions.index') }}">list demonde inscreption</a></li>
        @endif
    </ul>
</div>

<div class="menu" id="pubandads-menu">
    <ul>
            <!-- Menu items for Resources -->
            @if ($role != 'admin')
       
            <li><a href="{{ route('ads.create') }}">Create Ads</a></li>
            @if ($role != 'guest')
            <li><a href="{{ route('ads.list') }}" >My List Ads</a></li>
            @endif
            @endif
            @if ($role != 'guest')
            <li><a href="{{ route('ads.demandes_pub') }}" >List demande Pub</a></li>
            @endif
          
    </ul>
</div>
<div class="menu" id="resource-menu">
    <ul>
        <!-- Menu items for Resources -->
        @if ($role != 'admin')
        <li><a href="{{ route('resource.index', ['view' => 'my']) }}" data-resource-view="my" id="my-resource-link">My Resource</a></li>
        @endif
        <li><a href="{{ route('resource.index', ['view' => 'all']) }}" data-resource-view="all" id="all-resource-link">All Resource</a></li>
        
      
    </ul>
</div>

<div class="menu" id="course-menu">
    <ul>
        <!-- Menu items for Course Online -->
        @if ($role != 'admin')
        <li><a href="{{ route('cours-en-ligne.create') }}">Create coure</a></li>
        @endif
        <li><a href="{{ route('cours-en-ligne.list') }}">list Coure</a></li>
   
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
        @if ($role != 'admin')
        <li><a <a href="{{ route('reunions.create') }}">create</a></li>
        <li><a <a href="{{ route('reunions.invitation') }}">List Invitation</a></li>
        @endif
        <li><a <a href="{{ route('reunions.list') }}">List Reunions</a></li>
        
    </ul>
</div>

    <!-- JavaScript scripts -->
    
    <script src="{{ asset('assets/js/sidbarehidandshowresource.js') }}"></script>
    <script src="{{ asset('assets/js/sidebaremenu.js') }}"></script>

    <script>
        // Fetch the number of invitations for done reunions using AJAX
        fetch('{{ route("get-number-invite-reunion") }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('invitation-count').innerText = data;
            })
            .catch(error => console.error('Error fetching invitation count:', error));
    </script>
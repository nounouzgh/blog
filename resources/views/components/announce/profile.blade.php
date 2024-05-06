<div class="top">
    <!-- Menu button -->
    <button id="menu-btn">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <!-- Icon for mode dark and light -->
    <div class="theme-toggler">
        <span class="material-symbols-outlined active" id="light-mode">light_mode</span>
        <span class="material-symbols-outlined" id="dark-mode">dark_mode</span>
    </div>

    <!-- Profile -->
    <div class="profile">
        <!-- Text next to profile icon -->
        <div class="info">
            <p>Hey , </p> <b>{{$name}}</b>
            <small class="text-muted">{{$role}}</small>

        </div>

        <!-- Profile photo -->
        <!-- Profile photo -->
        <div class="profile-photo">
            <img src="{{ asset('assets/images/profile-' . $profileNumber . '.png') }}" alt="Click to Open Menu" id="menuImage">
        </div>

       <!--  le menu du profile -->
       <div class="action" id="action">                            
        
        @include('layouts.navigation')


        <!-- Pass the user role to the navigation component -->                                                   
    </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const lightModeIcon = document.getElementById('light-mode');
        const darkModeIcon = document.getElementById('dark-mode');

        lightModeIcon.addEventListener('click', function() {
            lightModeIcon.classList.add('active');
            darkModeIcon.classList.remove('active');
            // Add code to switch to light mode
        });

        darkModeIcon.addEventListener('click', function() {
            lightModeIcon.classList.remove('active');
            darkModeIcon.classList.add('active');
            // Add code to switch to dark mode
        });
    });
</script>

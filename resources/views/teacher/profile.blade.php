<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">
      
            <h2>Student Details:</h2>

        <!-- Overlay container -->
        <div id="overlay">
        <!-- Image list container -->
        <div id="imageListContainer">
            <!-- Background image -->
            <div id="imageListBackground"></div>
            <!-- Image list -->
            <div id="imageList" style="display: none;"></div>
        </div>
        </div>

        <!-- Profile list -->
        <ul class="profile-list">
        <!-- Profile item -->
        <li class="profile-item">
            <h3>Profile 1</h3>
            <!-- Profile image container -->
            <div class="profile-image-container">
      <!-- Wrap the image and the button inside a form element -->
        <form id="profileImageForm" action="{{ route('updateProfileImage') }}" method="POST">
            @csrf
            <!-- Set default profile image path here -->
            @if($user->image)
            <img class="profile-image" src="{{ asset($user->image) }}" alt="Profile Image" onclick="toggleImageList()">
             @else
             <img class="profile-image" src="{{ asset('storage/profile/man/face.jpg') }}" alt="Profile Image" onclick="toggleImageList()">
            @endif
             <!-- Hidden input to store the image source -->
            <input type="hidden" class="profile-image" name="profile_image_src" value="{{ asset('storage/profile/man/face.jpg') }}">
            <!-- Edit button -->
            <button type="submit">Update Image</button>
        </form>

            @if(session('success'))
                <div class="alert alert-info">
                    {{ session('success') }}
                </div>
            @endif
        </li>
</ul>

            <div class="user-info">
                <p>Name: {{ $user->name }}</p>
                <p>Prenom: {{ $user->prenom }}</p>
                <p>Compte Email: {{ $compte->email }}</p>
                <p>Teacher ID: {{ $teacher->id }}</p>
                <p>Teacher Specialite: {{ $teacher->specialite }}</p>
                <p>Teacher Date de Naissance: {{ $teacher->date_naissance }}</p>
                <!-- Add other teacher-specific details as needed -->
            </div>
            <!-- Edit button -->
            <button onclick="toggleEditForm()">Edit</button>
            <!-- Edit form (initially hidden) -->
            <form id="editForm" action="{{ route('teacher.profile.update') }}" method="POST" style="display: none;">
                @csrf
                @method('PUT')
                <!-- Input fields for editing teacher information -->
                <label for="user_name">Name:</label>
                <input type="text" name="user_name" value="{{ $user->name }}"><br>
                <label for="user_prenom">Prenom:</label>
                <input type="text" name="user_prenom" value="{{ $user->prenom }}"><br>
                <label for="specialite">Specialite:</label>
                <input type="text" name="specialite" value="{{ $teacher->specialite }}"><br>
                <label for="date_naissance">Date de Naissance:</label>
                <input type="text" name="date_naissance" value="{{ $teacher->date_naissance }}"><br>
                <!-- Add other input fields as needed -->
                <button type="submit">Update</button>
            </form>
            <!-- Delete button and form -->
            <div class="delete-form">
                <form id="deleteForm" action="{{ route('teacher.profile.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
           
            <!-- Success message section -->
            @if(session('success'))
                <p class="success-message">{{ session('success') }}</p>
            @endif
        </div> 
</x-slot>



</x-dashboard-layout>


<link rel="stylesheet" href="{{ asset('assets/css/pageprofile.css') }}">
<script src="{{ asset('assets/js/menuforprofileimage.js') }}"></script>

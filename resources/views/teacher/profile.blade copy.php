<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Teacher Information</title>
    <!-- Add CSS for success message -->
    <style>
        .success-message {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Show Teacher Information</h1>
    <h2>Teacher Details:</h2>

    <!-- Display current information -->
    <p>Name: {{ $user->name }}</p>
    <p>prenom: {{ $user->prenom }}</p>
    <p>Compte Email: {{ $compte->email }}</p>
    <p>Teacher ID: {{ $teacher->id }}</p>
    <p>Teacher Specialite: {{ $teacher->specialite }}</p>
    <p>Teacher Date de Naissance: {{ $teacher->grade }}</p>

    <!-- Edit button -->
    <button onclick="toggleEditForm()">Edit</button>

    <!-- Edit form (initially hidden) -->
   <!-- Add the 'prenom' input field to the form -->
<form id="editForm" action="{{ route('teacher.profile.update') }}" method="POST">
    @csrf
    @method('PUT')
    
    <!-- Input fields for editing user and teacher information -->
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="user_name" :value="$user->name" required autofocus />
        <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="prenom" :value="__('Prenom')" />
        <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="user_prenom" :value="$user->prenom" required />
        <x-input-error :messages="$errors->get('user_prenom')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="specialite" :value="__('Specialite')" />
        <x-text-input id="specialite" class="block mt-1 w-full" type="text" name="specialite" :value="$teacher->specialite" required />
        <x-input-error :messages="$errors->get('specialite')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="grade" :value="__('Grade')" />
        <x-text-input id="grade" class="block mt-1 w-full" type="text" name="grade" :value="$teacher->grade" required />
        <x-input-error :messages="$errors->get('grade')" class="mt-2" />
    </div>

    <!-- Add other input fields as necessary -->

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

    <script>
        function toggleEditForm() {
            var form = document.getElementById("editForm");
            var button = document.querySelector("button");
            if (form.style.display === "none") {
                form.style.display = "block";
                button.textContent = "Cancel";
            } else {
                form.style.display = "none";
                button.textContent = "Edit";
            }
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Student Information</title>
    <!-- Add CSS for success message -->
    <style>
        .success-message {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Show Student Information</h1>
    <h2>Student Details:</h2>

    <!-- Display current information -->
    <p>Name: {{ $user->name }}</p>
    <p>Compte Email: {{ $compte->email }}</p>
    <p>Student ID: {{ $student->id }}</p>
    <p>Student Specialite: {{ $student->specialite }}</p>
    <p>Student Date de Naissance: {{ $student->date_naissance }}</p>
    <p>Student Niveau: {{ $student->niveau }}</p>

    <!-- Edit button -->
    <button onclick="toggleEditForm()">Edit</button>

    <!-- Edit form (initially hidden) -->
    <form id="editForm" action="{{ route('student.profile.update') }}" method="POST" style="display: none;">
        @csrf
        @method('PUT')
        <!-- Input fields for editing student information -->
        <label for="name">Name:</label>
        <input type="text" name="user_name" value="{{ $user->name }}"><br>

        <label for="name">Prenom:</label>
        <input type="text" name="user_prenom" value="{{ $user->prenom }}"><br>
        
        <label for="specialite">Specialite:</label>
        <input type="text" name="specialite" value="{{ $student->specialite }}"><br>

        <label for="date_naissance">Date de Naissance:</label>
        <input type="text" name="date_naissance" value="{{ $student->date_naissance }}"><br>

        <label for="niveau">Niveau:</label>
        <input type="text" name="niveau" value="{{ $student->niveau }}"><br>

        <!-- Add other input fields as needed -->

        <button type="submit">Update</button>
    </form>
      <!-- Delete button and form -->
      <div class="delete-form">
        <form id="deleteForm" action="{{ route('student.profile.destroy') }}" method="POST">
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
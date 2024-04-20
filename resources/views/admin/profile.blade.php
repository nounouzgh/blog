<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Admin Information</title>
    <!-- Add CSS for success message -->
    <style>
        .success-message {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Show Admin Information</h1>
    <h2>Admin Details:</h2>

    <!-- Display current information -->
    <p>Name: {{ $admin->nom }} {{ $admin->prenom }}</p>
    <p>Compte Email: {{ $compte->email }}</p>
    <!-- Add other admin fields here as needed -->

    <!-- Edit button -->
    <button onclick="toggleEditForm()">Edit</button>

    <!-- Edit form (initially hidden) -->
    <form id="editForm" action="{{ route('admin.profile.update') }}" method="POST" style="display: none;">
        @csrf
        @method('PUT')
        <!-- Input fields for editing admin information -->
        <label for="nom">Nom:</label>
        <input type="text" name="nom" value="{{ $admin->nom }}"><br>

        <label for="prenom">Prenom:</label>
        <input type="text" name="prenom" value="{{ $admin->prenom }}"><br>

        <!-- Add other input fields as needed -->

        <button type="submit">Update</button>
    </form>

    <!-- Delete button and form -->
    <div class="delete-form">
        <form id="deleteForm" action="{{ route('admin.profile.destroy') }}" method="POST">
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

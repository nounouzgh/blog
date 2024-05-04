<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">
            <h2>Show Student Information</h2>
            <h2>Student Details:</h2>
        
            <!-- Display current information -->
            <div class="user-info">
                <p>Name: {{ $user->name }}</p>
                <p>Prenom: {{ $user->prenom }}</p>
                <p>Compte Email: {{ $compte->email }}</p>
                <p>Student ID: {{ $student->id }}</p>
                <p>Specialite: {{ $student->specialite }}</p>
                <p>Date de Naissance: {{ $student->date_naissance }}</p>
                <p>Niveau: {{ $student->niveau }}</p>
            </div>
        
            <!-- Edit button -->
            <button onclick="toggleEditForm()">Edit</button>
        
            <!-- Edit form (initially hidden) -->
            <form id="editForm" action="{{ route('student.profile.update') }}" method="POST" style="display: none;">
                @csrf
                @method('PUT')
                <!-- Input fields for editing student information -->
                <label for="user_name">Name:</label>
                <input type="text" name="user_name" value="{{ $user->name }}"><br>
        
                <label for="user_prenom">Prenom:</label>
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
        </div>
        <style>
            .insights {
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #f2f2f2;
                width: 400%; /* Set width to 100% */
                height: 100%; /* Set height to 100% */
            }
   

                .info-container {
                width: 90%; /* Set width to 100% */
                height: 90%; /* Set height to 100% */
                margin-left: 5%;/* Move the container to the right */
                max-width: 700px; /* Adjust max-width as needed */
                align-items: center;
                padding: 20px;
                background-color: white;
                border: 1px solid #ccc;
                box-sizing: border-box; /* Include padding and border in width and height calculations */
   
            }
        
            .info-container .user-info {
                border: 1px solid #ccc;
                padding: 10px;
                margin-bottom: 10px;
            }
        
            .info-container .delete-form {
                margin-top: 10px;
            }
        
            .info-container .success-message {
                color: green;
                margin-top: 10px;
            }
        </style>
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
        

    </x-slot>

    <!-- Recent Updates section -->
    <x-slot name="recentUpdates">
        <x-update 
        :profileNumber="1"
        :name="'Mike Tyzon'"
        :cour="'informatique'"
        :description="'intergation'"
        :timer="'2 minutes ago'"
    />
        <x-update 
        :profileNumber="1"
        :name="'Mike Tyzon'"
        :cour="'informatique'"
        :description="'intergation'"
        :timer="'2 minutes ago'"
    />
    <x-update 
    :profileNumber="1"
    :name="'Mike Tyzon'"
    :cour="'informatique'"
    :description="'intergation'"
    :timer="'2 minutes ago'"
/>

    </x-slot>

    <!-- List Coure section -->
    <x-slot name="ListCoure">
        <x-itemcostomers
        :icon="'forum'" 
        :title="'Online Forum'" 
        :subtitle="'Last 24 hours'" 
        :percentage="'60%'" 
        :count="'3849'" 
        />
        <x-itemoffline
        :icon="'forum'" 
        :title="'Online Forum'" 
        :subtitle="'Last 24 hours'" 
        :percentage="'39%'" 
        :count="'3849'" 
        />
        <x-itemonline
        :icon="'forum'" 
        :title="'Online Forum'" 
        :subtitle="'Last 24 hours'" 
        :percentage="'39%'" 
        :count="'3849'" 
        />

         <!-- Include the component with data -->
     
         <x-add-resource-button icon="add" title="Add Product" />

    </x-slot>
</x-dashboard-layout>

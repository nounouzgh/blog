<x-dashboard-layout>
    <x-slot name="contenu">
        <!-- Edit Resource Form -->
    <div class="insights">
     <div class="info-container">
        <div class="card">
            <div class="card-header">{{ __('Edit Resource') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('resource.update', $resource->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $resource->name }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required>{{ $resource->description }}</textarea>
                    </div>

                    <!-- Add other fields here if needed -->

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

        <!-- Other dashboard content here -->
    </div>
</div>
    </x-slot>
</x-dashboard-layout>
<style>  /* Main container for the dashboard layout */
     .insights {
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #f2f2f2;
                width: 300%; /* Set width to 100% */
                height: 100%; /* Set height to 100% */
                max-width: 750px; /* Adjust max-width as needed */
            }

            /* Container for the entire dashboard layout */
            .x-dashboard-layout {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 20px;
            }

            .info-container {
                margin-left: 5%; /* Move the container to the right */
                width: 300%; /* Set width to 100% */
                height: 100%; /* Set height to 100% */
                max-width: 750px; /* Adjust max-width as needed */
                align-items: center;
                padding: 20px;
                background-color: white;
                border: 1px solid #ccc;
                box-sizing: border-box; /* Include padding and border in width and height calculations */
            }
    
    /* Card styles */
    .card {
        margin-bottom: 20px; /* Add space between cards */
    }
    
    .card-header {
        background-color: #007bff; /* Header background color */
        color: white;
        padding: 10px 20px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }
    
    .card-body {
        padding: 20px;
    }
    
    /* Form styles */
    .form-group {
        margin-bottom: 20px;
    }
    
    label {
        font-weight: bold;
    }
    
    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.3s ease-in-out;
    }
    
    input[type="text"]:focus,
    textarea:focus {
        outline: none;
        border-color: #66afe9;
        box-shadow: 0 0 5px #66afe9;
    }
    
    button[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }
    
    button[type="submit"]:hover {
        background-color: #0056b3;
    }
    
</style>

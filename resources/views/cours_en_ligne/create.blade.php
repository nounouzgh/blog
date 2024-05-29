<x-dashboard-layout>

    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">

            <div class="title">
                <h1>Create Cours En Ligne Event</h1>
            </div>

            <!-- Display Success and Error Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('cours-en-ligne.store') }}">
                @csrf
                <div class="form-group">
                    <label for="event">Event:</label>
                    <input type="text" name="event" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="duree">Duration:</label>
                    <input type="time" name="duree" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="prix">Price:</label>
                    <input type="number" name="prix" class="form-control" required min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label for="specialite">Specialization:</label>
                    <input type="text" name="specialite" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="prerequis">Prerequisites:</label>
                    <div id="prerequis">
                        <input type="text" name="prerequis[0][description]" class="form-control">
                    </div>
                    <button type="button" class="btn btn-primary" id="addPrerequis">Add Prerequisite</button>
                </div>
                <button type="submit" class="btn btn-success">Create</button>
            </form>
        </div>
    </x-slot>

</x-dashboard-layout>

<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">

    <script>
        let index = 1;
        document.getElementById('addPrerequis').addEventListener('click', function() {
            const div = document.createElement('div');
            div.innerHTML = `<input type="text" name="prerequis[${index}][description]" class="form-control">`;
            document.getElementById('prerequis').appendChild(div);
            index++;
        });
    </script>

    <style>


.title {
    text-align: center;
    margin: 0 0 2rem; /* for write in mid */
    margin-left: 20%;/* Move the container to the right */
    padding: 0 20px; /* Adjust padding as needed */
    width: 60%;
}

.title h1 {
    font-size: 2.5rem;
    color: #333; /* Adjust color as needed */
    font-weight: bold; /* Optionally make the font bold */
    text-transform: uppercase; /* Optionally transform text to uppercase */
    letter-spacing: 2px; /* Optionally adjust letter spacing */
}

/* Add a subtle shadow effect to the title */
.title h1 {
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

/* Optionally, add a border-bottom to the title */
.title h1 {
    border-bottom: 2px solid #333;
    padding-bottom: 0.5rem;
}



.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    color: #333;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}



.btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
}

.btn-primary {
    background-color: #0069d9;
}

.btn-success {
    background-color: #28a745;
}

.btn:hover {
    background-color: #0056b3;
}

.btn:focus {
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

#addPrerequis {
    margin-top: 10px;
}

.alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }

    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }
        </style>
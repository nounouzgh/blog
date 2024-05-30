<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">
            <div class="backgrand">
                <div class="title">
                    <h1>Create Event</h1>
                </div>
                @if ($errors->any())
                    <div class="error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('events.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" id="description" name="description" value="{{ old('description') }}">
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" value="{{ old('date') }}">
                    </div>
                    <div class="form-group">
                        <label for="duree">Duration (minutes):</label>
                        <input type="number" id="duree" name="duree" value="{{ old('duree') }}">
                    </div>
                    <div class="form-group">
                        <label for="prix">Price:</label>
                        <input type="text" id="prix" name="prix" value="{{ old('prix') }}">
                    </div>
                    <div class="form-group">
                        <label for="specialite">Specialty:</label>
                        <input type="text" id="specialite" name="specialite" value="{{ old('specialite') }}">
                    </div>
                    <div class="form-group">
                        <label for="nbr_de_place">Number of Places:</label>
                        <input type="number" id="nbr_de_place" name="nbr_de_place" value="{{ old('nbr_de_place') }}">
                    </div>
                    <div class="form-group">
                        <button type="submit">Create Event</button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-dashboard-layout>


<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">

<style>
/* General styles */


/* General styles */
.backgrand {
    width: 80%;
    max-width: 600px;
    margin: 50px auto; /* Center the container */
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.title {
    text-align: center;
    margin-bottom: 20px;
}

.title h1 {
    font-size: 2.5rem;
    color: #333;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    border-bottom: 2px solid #333;
    padding-bottom: 0.5rem;
}

.error {
    color: #dc3545;
    margin-bottom: 20px;
}

.success {
    color: #28a745;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"],
input[type="date"],
input[type="number"] {
    width: calc(100% - 12px); /* Adjusted width to accommodate border */
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s ease; /* Smooth transition on border color */
}

input[type="text"]:focus,
input[type="date"]:focus,
input[type="number"]:focus {
    border-color: #007bff; /* Change border color on focus */
    outline: none; /* Remove default outline */
}

button[type="submit"] {
    width: 100%;
    padding: 0.5rem;
    border: none;
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth transition on background color */
}

button[type="submit"]:hover {
    background-color: #0056b3;
}


</style>
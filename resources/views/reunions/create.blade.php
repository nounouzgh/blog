<x-dashboard-layout>

    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">

            <div class="backgrand">

         
                <div class="title">
                    <h1>Create Reunion</h1>
                </div>
                <div class="form-container">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('reunions.store') }}" method="POST" class="form">
                        @csrf
                        <div class="form-group">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="duree" class="form-label">Durée (minutes)</label>
                            <input type="number" class="form-control" id="duree" name="duree" value="{{ old('duree') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="specialite" class="form-label">Spécialité</label>
                            <input type="text" class="form-control" id="specialite" name="specialite" value="{{ old('specialite') }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Reunion</button>
                    </form>
                </div>
        
        </div>
    </div>
    </x-slot>

</x-dashboard-layout>

<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">

<style>
/* General styles */




.backgrand {
    display: center;
    background-image: url('/storage/backgrand/renion.jpg');
    width: 95%; /* Set width to 100% */
    height: 95%; /* Set height to 100% */
  
}
/*title*/
/* Additional CSS for title */

.title {
    text-align: center;
    margin-bottom: 2rem;
    
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

/* Adjust margin and padding for the title */
.title {
    margin-bottom: 2rem; /* Adjust margin as needed */
    padding: 0 20px; /* Adjust padding as needed */
    width: 30%;
    
}

.form-container {
   
    max-width: 400px;
    width: 60%;
    margin: 0 auto;
    background: linear-gradient(145deg, #f3f3f3, #dcdcdc);
    padding: 20px;
    border-radius: 15px;
    box-shadow: 
        10px 10px 30px rgba(0, 0, 0, 0.1), 
        -10px -10px 30px rgba(255, 255, 255, 0.5);
    transform: perspective(500px) rotateX(3deg);

 
}



/* Form styles */
/* Form styles */

.form-group {
    margin-bottom: 1.5rem;
    
}

.form-group label {
    font-size: 1.2rem;
    display: block;
    margin-bottom: 0.5rem;
    color: #555; /* Text color for labels */
}

.form-control {
    font-size: 1rem;
    padding: 0.5rem;
    border: 1px solid #ced4da; /* Border color */
    border-radius: 0.25rem; /* Border radius */
}

.btn-primary {
    font-size: 1rem;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.25rem;
    background-color: #0d6efd; /* Button background color */
    color: #fff; /* Button text color */
    transition: background-color 0.3s ease; /* Smooth transition */
}

.btn-primary:hover {
    background-color: #0b5ed7; /* Hover background color */
}

.btn-primary:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.5); /* Focus shadow */
}

/* Alert styles */
.alert {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
    padding: .75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem;
}

/* Responsive styles */
@media (max-width: 576px) {
    .container {
        margin-top: 1rem;
    }

    .title h1 {
        font-size: 2rem;
    }

    .btn-primary {
        font-size: 0.9rem;
    }
}
/* Focus state for form input fields */
.form-control:focus {
    border-color: #0d6efd;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

/* Style alert messages */
.alert {
    font-size: 0.9rem;
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border-radius: 0.25rem;
}

/* Style form button */
.btn-primary {
    font-size: 1rem;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.25rem;
    background-color: #0d6efd;
    color: #fff;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0b5ed7;
}

.btn-primary:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.5);
}
</style>

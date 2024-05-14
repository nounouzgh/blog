<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">
            <h1>Demande d'Inscription</h1>
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Nom: {{ $demandeInscription->nom }}</<p>
                    <p class="card-title">prenom: {{ $demandeInscription->prenom }}</<p>
                    <p class="card-text">Email: {{ $demandeInscription->email }}</p>
                    <p class="card-text">Specialite: {{ $demandeInscription->specialite }}</p>
                    <p class="card-text">Date de création: {{ $demandeInscription->created_at }}</p>
                    <p class="card-text">État: {{ $demandeInscription->expert->users->compte->etat }}</p>
                   
                </div>
            </div>
            <div class="button-container">
                <div>
                    <a href="{{ route('demande-inscriptions.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
                <div>
                    <form action="{{ route('demande-inscriptions.destroy', $demandeInscription->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to delete this demande inscription?')">Active</button>
                    </form>
                </div>
            </div>
            
        </div>
    </x-slot>
</x-dashboard-layout>

<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">

<style>
    /* Container styling */
    .info-container {
        margin: 20px;
    }

    /* Card styling */
    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .card-body {
        padding: 20px;
    }

    /* Title styling */
    .card-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    /* Text content styling */
    .card-text {
        font-size: 1.1rem;
        margin-bottom: 8px;
    }

    /* Button container styling */
.button-container {
    margin-top: 10px; /* Adjust the top margin as needed */
}

/* Styling for the buttons */
.button-container > div {
    display: inline-block; /* Ensure buttons stay in the same line */
}

/* Styling for the first button */
.button-container > div:first-child {
    margin-right: 10px; /* Adjust the margin between buttons */
}


    /* Button styling */
    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Arrow icon styling */
    .btn-primary i {
        margin-right: 5px;
    }
</style>

<x-dashboard-layout>
    <x-slot name="contenu">
        <div class="info-container">
            <div class="title">
                <h1>List of Cours En Ligne</h1>
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

            <table class="table">
                <thead>
                    <tr>
                        <th>coure</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Specialization</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coursEnLigne as $cours)
                        <tr>
                            <td>{{ $cours->event }}</td>
                            <td>{{ $cours->description }}</td>
                            <td>{{ $cours->date }}</td>
                            <td>{{ $cours->duree }}</td>
                            <td>{{ $cours->prix }}</td>
                            <td>{{ $cours->specialite }}</td>
                        </tr>
                    @endforeach
                    <tr></tr>
                </tbody>
            </table>
            <x-pagination :paginator="$coursEnLigne" />
        </div>
      
    </x-slot>
</x-dashboard-layout>
<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">

<style>
    .title {
        text-align: center;
        margin: 0 0 2rem;
        margin-left: 20%;
        padding: 0 20px;
        width: 55%;
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

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #f4f4f4;
        text-align: left;
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

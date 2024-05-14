<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">
            <h1>Demandes d'Inscription</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Specialite</th>
                        <th>Date de création</th>
                        <th>État</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($DemandeInscription->isEmpty())
                        <tr>
                            <td colspan="6">No results found.</td>
                        </tr>
                    @else
                        @foreach ($DemandeInscription as $demande)
                            <tr>
                                <td>{{ $demande->nom }}</td>
                                <td>{{ $demande->email }}</td>
                                <td>{{ $demande->specialite }}</td>
                                <td>{{ $demande->created_at }}</td>
                                <td>{{  $demande->expert->users->compte->etat }}</td>
                                <td>
                                    <form action="{{ route('demande-inscriptions.destroy', $demande->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="btn activate-btn" onclick="return confirm('Are you sure you want to delete this demande inscription?')">Active</button>
                                    </form>
                                    <a href="{{ route('demande-inscriptions.show', $demande->id) }}" class="btn btn-primary">Show</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <!-- Pagination Links -->
            <x-pagination :paginator="$DemandeInscription" />
        </div>
    </x-slot>
</x-dashboard-layout>

<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/tablestructure.css') }}">

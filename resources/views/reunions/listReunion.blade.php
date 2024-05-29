<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">


            <h1>List of Reunions</h1>
        
            <div class="table-container">
                <table class="table table-3d">
                    <thead>
                     
                        <tr>
                            <th>nom</th>
                            <th>specialite</th>
                            <th>date</th>
                            <th>duree</th>
                            <th>Action</th>
    
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($newreunions as $reunion)
                            <tr>
                                <td>{{ $reunion->nom }}</td>
                                <td>{{ $reunion->specialite }}</td>
                                <td>{{ $reunion->date }}</td>
                                <td>{{ $reunion->duree }}</td>
                                <td>
                                    <div class="btn-group d-flex" role="group" style="white-space: nowrap;">
                                        <a href="{{ route('reunion.inviter', ['reunionId' => $reunion->id]) }}">
                                            <button class="btn btn-danger btn-sm btn-3d mr-1"><span class="material-symbols-outlined">
                                                add_box
                                                </span></button>
                                        </a>
                              
                                     
                                        <a><form action="{{ route('reunions.participate', $reunion->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to Join this reunion?');">
                                            @csrf
                                        
                                            <button type="submit" class="btn btn-danger btn-sm btn-3d mr-1">  <span class="material-symbols-outlined">library_add</span></button>
                                        </form> </a>


                                        <a><form action="{{ route('reunions.destroy', $reunion->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this reunion?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-3d mr-1"><span class="material-symbols-outlined">delete</span></button>
                                        </form> </a>
                                       
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No reunions found.</td>
                            </tr>
                        @endforelse
                    <tr></tr>
                    </tbody>
                </table>
            </div>
            <x-pagination :paginator="$newreunions" />
        </div>
    </x-slot>
  </x-dashboard-layout>
  <link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">

  <style>
    
    .table-container {
        overflow-x: auto;
    }

    .table-3d {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
    }

    .table-3d th,
    .table-3d td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
        background-color: #f2f2f2;
    }

    .table-3d th {
        background-color: #007bff;
        color: white;
    }

    .table-3d tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table-3d th,
    .table-3d td {
        transition: all 0.3s;
    }

    .btn-3d {
        padding: 6px 12px; /* Updated padding */
        border: 1px solid #007bff; /* Added border */
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px; /* Updated font size */
    }

    .btn-3d:hover {
        background-color: #0056b3;
        color: white;
    }

    .search-container {
        margin-top: 1%;
    margin-bottom: 2px;
  }
  .search-container input[type=text] {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    font-size: 16px;
    background-color: #f8f8f8;
    transition: border-color 0.3s ease-in-out;
  }
  .search-container input[type=text]:focus {
    outline: none;
    border-color: #66afe9;
    box-shadow: 0 0 5px #66afe9;
  }
  tr:hover td {
    background-color: #e0e0e0;
  }
 
</style>

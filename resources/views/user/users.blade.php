<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">
            <!-- Display success message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display error message -->
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <h1>List of Users</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Creation Date</th> <!-- Added a column for action buttons -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                @if($user->image)
                                    <img class="profile-image" src="{{ asset($user->image) }}" >
                                @else
                                    <img class="profile-image" src="{{ asset('storage/profile/man/face.jpg') }}" >
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->compte->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>{{ $user->compte->etat == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td> <!-- Displaying created_at timestamp -->

                            <td>
                                @if($user->compte->etat == 1)
                                    <form id="blockForm" action="{{ route('user.block', ['idcompte' => $user->compte->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn block-btn" type="submit">Block</button>
                                    </form>
                                @else
                                    <form id="activateForm" action="{{ route('user.activate', ['idcompte' => $user->compte->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn activate-btn" type="submit">Activate</button>
                                    </form>
                                @endif
                                <form id="deleteForm" action="{{ route('user.delete', ['idcompte' => $user->compte->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn delete-btn" type="submit">Delete</button>
                                </form>
                                <a href="{{ route('signals.show', ['id' => $user->id]) }}" class="btn btn-primary btn-sm btn-3d">
                                    <span class="material-symbols-outlined">report</span>
                                    <span class="message-count">{{ $user->signal->count() }}</span>
                                </a>
                           
                            </td>
                       </tr>
                    @endforeach
                <tr></tr>
                </tbody>
            </table>
                  
            <!-- Pagination Links -->
            <x-pagination :paginator="$users" />
        </div>
    </x-slot>
</x-dashboard-layout>

<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">

<style>/* Style for the table */
    .info-container table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .info-container th,
    .info-container td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    
    .info-container th {
        background-color: #f2f2f2;
    }
    
    /* Style for buttons */
    .info-container .btn {
        padding: 8px 12px;
        border: none;
        color: #fff;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
        margin-right: 5px;
        display: inline-block; /* Make buttons display inline */
    }
    
    .btn.block-btn {
        background-color: #ffff00; /* Red color for block button */
    }
    
    .btn.activate-btn {
        background-color: #28a745; /* Green color for activate button */
    }
    
    .btn.delete-btn {
        background-color: #d31717; /* Gray color for delete button */
    }

/* Style for the anchor tag buttons */
.info-container a.btn {
    color: #000; /* Change text color to black */
    text-decoration: none; /* Remove underline */
    padding: 8px 12px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    background-color: #721c24;
    border-radius: 50%;
    transition: background-color 0.3s, color 0.3s; /* Add transition effect for background color and text color */
}

/* Hover effect */
/* Hover effect for all buttons */
.info-container a.btn:hover,
.btn.delete-btn:hover,
.btn.activate-btn:hover,
.btn.activate-btn:hover,
.btn.block-btn:hover {
    background-color: #007bff; /* Change background color on hover */
    color: #fff; /* Change text color on hover */
}


    .info-container .btn:hover {
        opacity: 0.9; /* Reduce opacity on hover for all buttons */
    }
    
    /* Profile image styling */
    .profile-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
    }
    
    /* Style for success message */
    .alert.alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        padding: 8px 12px;
        margin-bottom: 10px;
        border-radius: 4px;
    }
    
    /* Style for error message */
    .alert.alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
        padding: 8px 12px;
        margin-bottom: 10px;
        border-radius: 4px;
    }

    
</style>

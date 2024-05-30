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
                            @if ($user->compte)
                            <td>{{ $user->compte->email }}</td>
                            @else
                            <td>Guest@hotmail.com</td>
                            @endif
                            <td>{{ $user->role->name }}</td>
                            @if ($user->compte)
                            <td>{{ $user->compte->etat == 1 ? 'Active' : 'Inactive' }}</td>
                            @else
                                <td>Inactive</td>
                            @endif
                            <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td> <!-- Displaying created_at timestamp -->
                        
                        <td>
                            @if($user->compte)

                            @if(auth()->user()->role->name!="guest")

                            @if(auth()->user()->role->name=="admin")
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
                                @endif
                                <a href="{{ route('signals.show', ['id' => $user->id]) }}" class="btn btn-primary btn-sm btn-3d ">
                                    <span class="material-symbols-outlined">report</span>
                                    <span class="message-count">{{ $user->signal->count() }}</span>
                                </a>
                           
                                   
                                @endif
                                @endif
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
<link rel="stylesheet" href="{{ asset('assets/css/tablestructure.css') }}">

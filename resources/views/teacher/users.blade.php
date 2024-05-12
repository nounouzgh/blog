<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">
        <h1>List of Users</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->compte->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->compte->etat == 1 ? 'Active' : 'Inactive' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

</div>
</x-slot>

</x-dashboard-layout>
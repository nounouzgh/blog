<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">
            <!-- Success message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Error message -->
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <h1>List of Ads</h1>

            <!-- Filter buttons -->
            <div>
                <button class="btn btn-primary" style="background-color: green;">
                    <a href="{{ route('ads.indexlist_user_ads', ['view' => 'accepted']) }}" style="color: white;">Accepted</a>
                </button>
                <button class="btn btn-primary" style="background-color: yellow;">
                    <a href="{{ route('ads.indexlist_user_ads', ['view' => 'waiting']) }}" style="color: black;">Waiting</a>
                </button>
                <button class="btn btn-primary">
                    <a href="{{ route('ads.indexlist_user_ads', ['view' => 'all']) }}" style="color: black;">All</a>
                </button>
            </div>

            <!-- Table to display ads -->
            <table id="ads-table" class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Owner name</th>
                        <th>Owner prenom</th>
                        <th>Owner email</th>
                        <th>Owner tel</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($AdsAndDemandePub as $ad)
                        <tr class="ad-row" data-status="{{ $ad->demandePub->accepted ? 'accepted' : 'waiting' }}">
                            <td>{{ $ad->demandePub->nom }}</td>
                            <td>{{ $ad->owner->name }}</td>
                            <td>{{ $ad->owner->prenom }}</td>
                            <td>{{ $ad->owner->email }}</td>
                            <td>{{ $ad->owner->tel }}</td>
                            <td>{{ $ad->description }}</td>
                            <td>{{ $ad->demandePub->accepted ? 'Accepted' : 'Waiting' }}</td>
                            <td>
                                <form action="{{ route('ads.delete', $ad->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="color: white; background-color: red;">Delete</button>
                                </form>
                                @if (auth()->user()->role->name === 'admin' && !$ad->demandePub->accepted)
                                <form action="{{ route('ads.accept', $ad->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success" style="color: white; background-color: green;">Accept</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No ads found.</td>
                        </tr>
                    @endforelse
                    <tr> </tr>
                </tbody>
        
            </table>

            <!-- Pagination Links -->
            <x-pagination :paginator="$AdsAndDemandePub" />
        </div>
    </x-slot>
</x-dashboard-layout>

<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/tablestructure.css') }}">

<style>
    /* Style for status column */
.ad-row[data-status="accepted"] td:nth-child(7) {
    background-color: green;
    color: white;
}

.ad-row[data-status="waiting"] td:nth-child(7) {
    background-color: yellow;
    color: black;
}
</style>

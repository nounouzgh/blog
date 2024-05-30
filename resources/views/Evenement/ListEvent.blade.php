<!-- events.blade.php -->

<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">
            <div class="backgrand">
                <div class="title">
                    <h1>List of Events</h1>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Duration (minutes)</th>
                            <th>Price</th>
                            <th>Specialty</th>
                            <th>Number of Places</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->description }}</td>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->duree }}</td>
                                <td>{{ $event->prix }}</td>
                                <td>{{ $event->specialite }}</td>
                                <td>{{ $event->nbr_de_place }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                     <!-- Pagination Links -->
            <x-pagination :paginator="$events" />
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
        max-width: 800px;
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

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

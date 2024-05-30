<x-dashboard-layout>
    <x-slot name="contenu">
        <!-- Main ad container -->
        <div class="info-container">
            <div class="ad-container">
                <!-- Display ad details -->
                <div class="ad-details">
                    <h1>Ad Details</h1>
                    <h2>Ad ID: {{ $ad->id }}</h2>
                    <h3>Title: {{ $ad->demandePub->nom }}</h3>
                    <p><strong>Specialite: </strong>{{ $ad->specialite }}</p>
                    <p><strong>Date: </strong>{{ $ad->date }}</p>
                    <p><strong>Tel: </strong>{{ $ad->owner->tel }}</p>
                    <p><strong>Description: </strong>{{ $ad->description }}</p>
                </div>

                <!-- Toggle buttons -->
                <div class="toggle-buttons">
                    <button id="show-competences">Competences</button>
                    <button id="show-piece-joints">Show Piece Joints</button>
                </div>

                <!-- Justification Compitences -->
                <div class="competences" @if(request()->input('view') !== 'competences') style="display: none;" @endif>
                    <h4>Justification Compitences</h4>
                    @if ($compitences->count())
                        <ul>
                            @foreach ($compitences as $compitence)
                                <li>{{ $compitence->description }}</li>
                            @endforeach
                        </ul>
                        <!-- Pagination links for competences -->
                        <x-paginationMultilpleInpage :paginator="$compitences" />
                    @else
                        <p>No justification competences found.</p>
                    @endif
                </div>

                <!-- Piece Joints -->
                <div class="piece-joints" @if(request()->input('view') !== 'piece-joints') style="display: none;" @endif>
                    <h4>Piece Joints</h4>
                    @if ($pieceJoints->count())
                        <ul>
                            @foreach ($pieceJoints as $resource)
                                <div class="card">
                                    <div class="card-header">{{ __('File Contents') }}</div>
                                    <div class="card-body">
                                        @php
                                            $filePath = 'public/' . $resource->lien;
                                            $mimeType = Storage::mimeType($filePath);
                                        @endphp

                                            @if (strpos($mimeType, 'video') !== false)
                                            <video id="videoPlayer" width="100%" height="auto" controls>
                                                <source src="{{ route('ads.view_fileinCader', ['id' => $resource->id]) }}" type="{{ $mimeType }}">
                                                Your browser does not support the video tag.
                                            </video>
                                            @elseif (strpos($mimeType, 'image') !== false)
                                            <img src="{{ route('ads.view_fileinCader', ['id' => $resource->id]) }}" alt="File Image">
                                            @elseif (strpos($mimeType, 'pdf') !== false)
                                            <embed class="pdf-embed" src="{{ route('ads.view_fileinCader', ['id' => $resource->id]) }}" type="{{ $mimeType }}">
                                            @elseif (strpos($mimeType, 'audio') !== false)
                                            <audio controls>
                                                <source src="{{ route('ads.view_fileinCader', ['id' => $resource->id]) }}" type="{{ $mimeType }}">
                                                Your browser does not support the audio tag.
                                            </audio>
                                            @else
                                            <p>This file type is not supported for direct display.</p>
                                            @endif
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                        <!-- Pagination links for pieceJoints -->
                        <x-paginationMultilpleInpage :paginator="$pieceJoints" />
                    @else
                        <p>No piece joints found.</p>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>
</x-dashboard-layout>

<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/tablestructure.css') }}">

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the value of the 'view' parameter from the URL
        const urlParams = new URLSearchParams(window.location.search);
        let viewParam = urlParams.get('view');

        // If the 'view' parameter is not set, set it to a default value (e.g., 'competences')
        if (!viewParam) {
            viewParam = 'competences';
            // Push the default value to the URL without reloading the page
            history.pushState(null, null, window.location.pathname + '?view=' + viewParam);
        }

        // Select the div elements
        const competences = document.querySelector('.competences');
        const piecejoints = document.querySelector('.piece-joints');

        // If the 'view' parameter is 'piece-joints', display the piece-joints section
        if (viewParam === 'piece-joints') {
            competences.style.display = 'none';
            piecejoints.style.display = 'block';
        } else { // Otherwise, display the competences section (default)
            competences.style.display = 'block';
            piecejoints.style.display = 'none';
        }

        // Update the view parameter when toggling between sections
        function updateViewParam(view) {
            // Get the current query parameters
            const params = new URLSearchParams(window.location.search);
            // Update the 'view' parameter value
            params.set('view', view);
            // Generate the new URL with updated parameters
            const newUrl = window.location.pathname + '?' + params.toString();
            // Push the new URL to the browser history without reloading the page
            history.pushState(null, null, newUrl);
            // Update viewParam
            viewParam = view;
        }

        // Add event listeners to toggle buttons
        const showCompetencesBtn = document.getElementById('show-competences');
        const showPieceJointsBtn = document.getElementById('show-piece-joints');

        showCompetencesBtn.addEventListener('click', function() {
            competences.style.display = 'block';
            piecejoints.style.display = 'none';
            if (viewParam !== 'competences') {
                updateViewParam('competences');
            }
        });

        showPieceJointsBtn.addEventListener('click', function() {
            competences.style.display = 'none';
            piecejoints.style.display = 'block';
            if (viewParam !== 'piece-joints') {
                updateViewParam('piece-joints');
            }
        });

        // Update pagination links to include the 'view' parameter
        const paginationLinks = document.querySelectorAll('.pagination-list a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default action of the link
                const targetView = viewParam; // Get the current view parameter
                const href = link.getAttribute('href');
                const targetUrl = new URL(href, window.location.origin);
                targetUrl.searchParams.set('view', targetView); // Preserve the current view parameter
                window.location.href = targetUrl.toString(); // Navigate to the new URL
            });
        });
    });
</script>

<style>
/* RebuildMidDivContainet.css */
.info-container {
    display: flex;
    justify-content: center;
}

.ad-container {
    width: 80%;
    margin: 0 auto;
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.ad-details {
    margin-bottom: 20px;
}

.ad-details h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

.ad-details h2, .ad-details h3 {
    font-size: 18px;
    margin-bottom: 5px;
}

.ad-details p {
    margin-bottom: 5px;
}

.toggle-buttons {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.toggle-buttons button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    margin: 0 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.toggle-buttons button:hover {
    background-color: #0056b3;
}

.competences, .piece-joints {
    margin-bottom: 20px;
}

.competences h4, .piece-joints h4 {
    font-size: 20px;
    margin-bottom: 10px;
}

.competences ul, .piece-joints ul {
    list-style: none;
    padding: 0;
}

.competences ul li, .piece-joints ul li {
    margin-bottom: 5px;
}

.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
}

.card-header {
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.card-body {
    padding: 10px;
}

.pdf-embed {
    width: 100%;
    height: 400px; /* Adjust height as needed */
}

.pagination-list {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination-list a {
    color: #007bff;
    text-decoration: none;
    padding: 5px 10px;
    margin: 0 5px;
    border: 1px solid #007bff;
    border-radius: 4px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.pagination-list a:hover {
    background-color: #007bff;
    color: #fff;
}
</style>

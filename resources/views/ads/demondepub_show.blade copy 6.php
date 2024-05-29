<x-dashboard-layout>
    <x-slot name="contenu">
        <!-- Main ad container -->
        <div class="ad-container">
            <!-- Display ad details -->
            <div class="ad-details">
                <h1>Ad Details</h1>
                <h2>Ad ID: {{ $ad->id }}</h2>
                <h3>Title: {{$ad->demandePub->nom}}</h3>
                <p><strong>Specialite: </strong>{{ $ad->specialite }}</p>
                <p><strong>Date: </strong>{{ $ad->date }}</p>
                <p><strong>Tel: </strong>{{ $ad->owner->tel  }}</p>
                <p><strong>Description: </strong>{{ $ad->description }}</p>
            </div>                            
            <!-- Toggle buttons -->
            <div class="toggle-buttons">
                <button id="show-competences">    <a href="{{ route('ads.show', ['id' => $ad->id]) }}"  type="hidden" name="view" value="competences"> </a> Competences</button>
                <button id="show-piece-joints"> <a href="{{ route('ads.show', ['id' => $ad->id]) }}" type="hidden" name="view" value="piece-joints"> </a>Show Piece Joints</button>
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
                        @foreach ($pieceJoints as $piece)
                            <div class="card">
                                <div class="card-header">{{ __('File Contents') }}</div>
                                <div class="card-body">
                                    @if (strpos($mimeType[$piece->id], 'video') !== false)
                                        <!-- Embed the video content within the card body -->
                                        <video id="videoPlayer" width="100%" height="auto" controls>
                                            <source src="{{ route('ads.view_fileinCader', ['id' => $piece->id]) }}" type="{{ $piece->mime_type }}">
                                            Your browser does not support the video tag.
                                        </video>
                                    @elseif (strpos($mimeType[$piece->id], 'image') !== false)
                                        <!-- Display the file as an image -->
                                        <img src="{{ route('ads.view_fileinCader', ['id' => $piece->id]) }}" alt="File Image">
                                    @elseif (strpos($mimeType[$piece->id], 'pdf') !== false)
                                        <!-- Display the file as a PDF -->
                                        <embed class="pdf-embed" src="{{ route('ads.view_fileinCader', ['id' => $piece->id]) }}" type="{{ $piece->mime_type }}">
                                    @elseif (strpos($mimeType[$piece->id], 'audio') !== false)
                                        <!-- Embed the audio content within the card body -->
                                        <audio controls>
                                            <source src="{{ route('ads.view_fileinCader', ['id' => $piece->id]) }}" type="{{ $piece->mime_type }}">
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
    </x-slot>
</x-dashboard-layout>

<link rel="stylesheet" href="{{ asset('assets/css/customStyles.css') }}">

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
    
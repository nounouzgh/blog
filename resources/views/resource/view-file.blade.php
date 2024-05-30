<x-dashboard-layout>
    <x-slot name="contenu">
        <!-- File Contents Display -->
        <div class="insights" id="insights">
            <div class="info-container" id="info-container">
                <div class="card">
                    <div class="card-header">{{ __('File Contents') }}</div>
                    <div class="card-body">
                        @if (strpos($mimeType, 'video') !== false)
                            <video id="videoPlayer" width="100%" height="auto" controls>
                                <source src="{{ route('resource.view_fileinCader', ['id' => $resource->id]) }}" type="{{ $mimeType }}">
                                Your browser does not support the video tag.
                            </video>
                        @elseif (strpos($mimeType, 'image') !== false)
                            <img src="{{ route('resource.view_fileinCader', ['id' => $resource->id]) }}" alt="File Image">
                        @elseif (strpos($mimeType, 'pdf') !== false)
                            <embed class="pdf-embed" src="{{ route('resource.view_fileinCader', ['id' => $resource->id]) }}" type="{{ $mimeType }}">
                        @elseif (strpos($mimeType, 'audio') !== false)
                            <audio controls>
                                <source src="{{ route('resource.view_fileinCader', ['id' => $resource->id]) }}" type="{{ $mimeType }}">
                                Your browser does not support the audio tag.
                            </audio>
                        @else
                            <p>This file type is not supported for direct display.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-dashboard-layout>

<style>
/* Main container styling */
.insights {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f2f2f2;
    width: 300%; /* Set width to 100% */
    height: 100%; /* Set height to 100% */
    max-width: 750px; /* Adjust max-width as needed */
}

/* Container for the entire dashboard layout */
.x-dashboard-layout {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

.info-container {
    margin-left: 5%; /* Move the container to the right */
    width: 300%; /* Set width to 100% */
    height: 100%; /* Set height to 100% */
    max-width: 750px; /* Adjust max-width as needed */
    align-items: center;
    padding: 20px;
    background-color: white;
    border: 1px solid #ccc;
    box-sizing: border-box; /* Include padding and border in width and height calculations */
}

.card {
    margin-bottom: 20px;
}

.card-header {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.card-body {
    padding: 0;
}

/* Adjust video player size */
#videoPlayer {
    width: 100%;
    height: auto;
}

/* Adjust PDF embed size */
.pdf-embed {
    width: 100%;
    height: 500px; /* Adjust height as needed */
}
</style>

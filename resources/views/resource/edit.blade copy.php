<x-dashboard-layout>
    <x-slot name="contenu">
        <!-- File Contents Display -->
        <div class="insights">
            <div class="info-container">
                <div class="card">
                    <div class="card-header">{{ __('File Contents') }}</div>
                    <div class="card-body">
                        <!-- Embed the video content within the card body -->
                        <video id="videoPlayer" width="100%" height="auto" controls allowfullscreen>>
                            <source src="{{ route('resource.view_filerun', $resource->id) }}" type="{{ $resource->mime_type }}">
                            Your browser does not support the video tag.
                        </video>
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
</style>

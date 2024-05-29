<x-dashboard-layout>
    <x-slot name="contenu">
        <!-- Display ad details -->
        <div class="info-container">
            <div class="ad-container">
                <h1>Ad Details</h1>

                <h2>Ad ID: {{ $ad->id }}</h2>
                <h3>{{ $ad->title }}</h3>
                <p><strong>Specialite: </strong>{{ $ad->specialite }}</p>
                <p><strong>Date: </strong>{{ $ad->date }}</p>
                <p><strong>Tel: </strong>{{ $ad->tel }}</p>
                <p><strong>Description: </strong>{{ $ad->description }}</p>

                <!-- Justification Compitences -->
                <h4>Justification Compitences</h4>
                @if ($compitences->count())
                    <ul>
                        @foreach ($compitences as $compitence)
                            <li>{{ $compitence->description }}</li>
                        @endforeach
                    </ul>
                    <!-- Pagination links for compitences -->
                    <x-paginationMultilpleInpage :paginator="$compitences" />
                    @else
                    <p>No justification compitences found.</p>
                @endif
            </div>

            <!-- Piece Joints -->
            <div class="piece-joints">
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

<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/tablestructure.css') }}">

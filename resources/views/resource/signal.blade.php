<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
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

            /* Panel styling */
            .panel {
                margin-bottom: 20px;
                border: 1px solid #dddddd;
                border-radius: 5px;
            }

            .panel-heading {
                background-color: #f5f5f5;
                padding: 10px;
                border-bottom: 1px solid #dddddd;
            }

            .panel-body {
                padding: 15px;
            }

            /* Styling for signals */
            .well {
                margin-bottom: 15px;
                background-color: #f9f9f9;
                border: 1px solid #dddddd;
                border-radius: 5px;
                padding: 15px;
                position: relative;
            }

            .well strong {
                color: #333333;
                font-size: 16px;
            }

            .well .profile-photo {
                position: absolute;
                top: 15px;
                right: 15px;
            }

            .well .profile-photo img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
            }

            /* Delete button */
            .btn-delete {
                position: absolute;
                top: auto;
                right: auto;
                background-color: #dc3545; /* Red color for delete button */
                border-color: #dc3545;
                color: #fff; /* Text color */
                padding: 4px 8px; /* Adjust padding */
                border-radius: 5px; /* Rounded corners */
                font-size: 8px; /* Font size */
                transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease; /* Smooth transition */
                z-index: 10000; /* Adjust the z-index value as needed */
            }

            .btn-delete:hover {
                background-color: #c82333; /* Darker red color on hover */
                border-color: #bd2130;
                color: #fff; /* Text color */
            }

            /* Add signal form */
            .add-signal-form {
                margin-top: 20px;
            }

            .add-signal-form h4 {
                margin-bottom: 10px;
                color: #333333;
                font-size: 18px;
            }

            .add-signal-form input[type="text"] {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                box-sizing: border-box;
                font-size: 16px;
                margin-bottom: 10px;
            }

            .add-signal-form button[type="submit"] {
                background-color: #337ab7;
                border-color: #2e6da4;
                color: #ffffff;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .add-signal-form button[type="submit"]:hover {
                background-color: #286090;
            }

            /* Pagination styles */
            .pagination-list {
                display: inline-flex;
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .page-item {
                margin-right: 5px; /* Adjust spacing between pagination items */
            }

            .page-link {
                display: inline-block;
                padding: 5px 10px; /* Adjust padding as needed */
                text-decoration: none;
                color: #007bff; /* Link color */
                background-color: #fff;
                border: 1px solid #dee2e6;
                border-radius: .25rem;
            }

            .page-link:hover {
                color: #0056b3; /* Hover color */
                background-color: #e9ecef;
                border-color: #dee2e6;
            }

            .page-item.disabled .page-link {
                pointer-events: none;
                cursor: not-allowed;
                color: #6c757d;
                background-color: #e9ecef;
                border-color: #07ad39;
                font-size: 15px; /* Adjust the font size as needed */
            }

            .page-item.active .page-link {
                color: #fff;
                background-color: #007bff; /* Active background color */
                border-color: #007bff;
            }
        </style>

        <div class="insights">
            <div class="info-container">
                <div class="panel panel-default">
                    <div class="panel-heading">Signals</div>
                    <div class="panel-body">
                        <!-- Display existing signals -->
                        @foreach($signals as $signal)
                            <div class="well">
                                <div class="profile-photo">
                                    @if($signal->user->image)
                                        <img src="{{ asset($signal->user->image) }}" alt="User Profile Photo">
                                    @else
                                        <img src="{{ asset('storage/profile/man/face.jpg') }}" alt="Default Profile Photo">
                                    @endif
                                </div>
                                <strong>User: {{ $signal->user->name }}</strong><br>
                                Cause: {{ $signal->cause }}
                                <!-- You can add more details if needed -->
                            </div>
                        @endforeach

                        <!-- Add signal form -->
                        <div class="well add-signal-form">
                            <h4>Send Signal</h4>
                            <form method="POST" action="{{ route('resource.signal.store', ['id' => $resource->id]) }}">
                                @csrf
                                <div>
                                    <label for="cause">Cause:</label>
                                    <input type="text" id="cause" name="cause" required>
                                </div>
                                <button type="submit">Send Signal</button>
                            </form>
                        </div>

                        <!-- Pagination Links -->
                        @if ($signals->hasPages())
                            <div class="pagination" style="margin-top: 20px; margin-bottom: 20px; text-align: center;">
                                <ul class="pagination-list" style="display: inline-flex; list-style: none; padding: 0; margin: 0;">
                                    {{-- First Page Link --}}
                                    <li class="page-item {{ $signals->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $signals->url(1) }}">First</a>
                                    </li>

                                    {{-- Previous Page Link --}}
                                    @if ($signals->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                            <span class="page-link">Previous</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $signals->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
                                        </li>
                                    @endif

                                    {{-- Page Numbers --}}
                                    @php
                                        $start = max(1, $signals->currentPage() - 2);
                                        $end = min($start + 4, $signals->lastPage());
                                    @endphp
                                    @for ($i = $start; $i <= $end; $i++)
                                        <li class="page-item {{ $i == $signals->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $signals->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    {{-- Next Page Link --}}
                                    @if ($signals->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $signals->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                            <span class="page-link">Next</span>
                                        </li>
                                    @endif

                                    {{-- Last Page Link --}}
                                    <li class="page-item {{ $signals->currentPage() == $signals->lastPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $signals->url($signals->lastPage()) }}">Last</a>
                                    </li>
                                </ul>

                                <div class="pagination-info" style="margin-top: 10px; text-align: center; margin-bottom: 20px;">
                                    <p>Page {{ $signals->currentPage() }} of {{ $signals->lastPage() }} - Showing {{ $signals->firstItem() }} to {{ $signals->lastItem() }} of {{ $signals->total() }} results</p>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </x-slot>

</x-dashboard-layout>

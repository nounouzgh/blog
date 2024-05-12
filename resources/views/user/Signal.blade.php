<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <!-- Existing signals -->
        <div class="info-container">
            <div class="panel panel-default">
                <div class="panel-heading">Signals for {{ $userreport->name }}</div>
                <div class="panel-body">
                    @if($signals->count() > 0)
                        @foreach($signals as $signal)
                            <div class="well">
                                <div class="profile-photo">
                                    <!-- Display user's profile photo -->
                                    @if($signal->user->image)
                                        <img src="{{ asset($signal->user->image) }}" alt="User Profile Photo">
                                    @else
                                        <img src="{{ asset('storage/profile/man/face.jpg') }}" alt="Default Profile Photo">
                                    @endif
                                </div>
                            <!-- Display user's name and signal text -->
                            <div class="signal-info">
                                <div class="user-name">
                                    <strong>User: {{ $signal->user->name }}</strong>
                                </div>
                                <div class="signal-cause">
                                    {{ $signal->cause }}
                                </div>
                            </div>

                            </div>
                        @endforeach
                    @else
                        <p>No signals found for this user.</p>
                    @endif
                </div>
            </div>
            
            <!-- Pagination Links -->
            <x-pagination :paginator="$signals" />

            <!-- Add new signal form -->
            <div class="panel panel-default">
                <div class="panel-heading">Add New Signal</div>
                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('signals.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $userreport->id }}">
                        
                        <div class="form-group">
                            <label for="cause">Cause:</label>
                            <textarea name="cause" class="form-control" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
</x-dashboard-layout>

<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">

<style>
    /* Style for info container */
    .info-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Style for panel */
    .panel {
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f9f9f9;
    }

    /* Style for panel heading */
    .panel-heading {
        padding: 10px 15px;
        background-color: #007bff;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        color: #fff;
        font-weight: bold;
    }

    /* Style for panel body */
    .panel-body {
        padding: 15px;
    }

    /* Style for well */
    .well {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 4px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Style for profile photo */
    .profile-photo img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }

    /* Style for form group */
    .form-group {
        margin-bottom: 20px;
    }

    /* Style for alert */
    .alert {
        margin-bottom: 20px;
    }

    /* Style for button */
    .btn {
        display: inline-block;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #0056b3;
    }
   /* Style for signal info container */
.signal-info {
    display: flex; /* Use flexbox */
    align-items: center; /* Align items vertically */
    margin-bottom: 10px;
}

/* Style for user name */
.user-name strong {
    color: #007bff; /* User name color */
    font-weight: bold;
    margin-right: 10px; /* Add margin between user name and signal cause */
}

/* Style for signal cause */
/* Style for signal cause */
.signal-cause {
    color: #333; /* Signal text color */
    flex: 1; /* Occupy remaining space */
    padding: 10px; /* Add padding for better readability */
    background-color: #f5f5f5; /* Light background color */
    border-radius: 4px; /* Rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}

/* Hover effect */
.signal-cause:hover {
    background-color: #ebebeb; /* Darken background on hover */
}


</style>

<x-dashboard-layout>
    <!-- Main content -->
    <x-slot name="contenu">
        <div class="info-container">

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        @php
        $user = Auth::guard('compte')->user()->user;
        @endphp
            @if ($user)
            <a href="{{ route('expert.profile.edit') }}">Edit Profile</a>
                <p>User ID: {{ $user->id }}</p>
                <p>User Name: {{ $user->name }}</p>
                <p>User LastName: {{ $user->prenom }}</p>
                <p>User Role: {{ $user->role->name }}</p>
                <p>User etat: {{ $user->compte->etat }}</p>
                {{-- Access other properties of the user as needed --}}
            @else
                <p>No user associated with this compte.</p>
            @endif

            @if (session('message'))

                {{ session('message') }}
            @endif
                </p>
               
            </h2>
       
</div>
</x-slot>
</x-dashboard-layout>

<style>


.insights {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f2f2f2;
        width: 400%; /* Set width to 100% */
        height: 100%; /* Set height to 100% */
    }

    .info-container {
        width: 95%; /* Set width to 100% */
        height: 95%; /* Set height to 100% */
        margin-left: 5%;/* Move the container to the right */
        max-width: 730px; /* Adjust max-width as needed */
        align-items: center;
        padding: 20px;
        background-color: white;
        border: 1px solid #ccc;
        box-sizing: border-box; /* Include padding and border in width and height calculations */
    }
    /* CSS styles for the Card_Disane_Annance section */

    /* Style for the Card_Disane_Annance section */
    .Card_Disane_Annance {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* how many to show in same  line*/
        gap: 1.8em;
        margin-top: 1.1em; /* Apply margin to the Card_Disane_Annance section */
        padding: 0 1em; /* Added padding */
    }

    /* Style for individual insight divs */
    .Card_Disane_Annance > div {
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        margin-top: 1em;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 300ms ease;
    }

    /* Hover effect for individual insight divs */
    .Card_Disane_Annance > div:hover {
        transform: translateY(-5px); /* Lift the card on hover */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Enhance box shadow */
    }

    /* Styling for the icon spans */
    .Card_Disane_Annance > div span {
    background: #007bff;
    padding: 0.5em;
    border-radius: 50%;
    color: #ffffff;
    font-size: 2em;
    position: auto; /* Position the icon */
    top: 10px; /* Adjust vertical position */
    left: 10px; /* Adjust horizontal position */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Added box shadow */
}


    /* Color variations for different types of Card_Disane_Annance */
    .Card_Disane_Annance > div.sales span {
        background: #333333;
    }

    .Card_Disane_Annance > div.expenses span {
        background: #dc3545;
    }

    .Card_Disane_Annance > div.income span {
        background: #28a745;
    }

    /* Styling for the middle section of the insight divs */
    .Card_Disane_Annance > div .middle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px; /* Adjust margin */
    }

    /* Styling for heading inside insight divs */
    .Card_Disane_Annance h3 {
        margin: 0;
        font-size: 1.2em; /* Increase font size */
        color: #333333; /* Change font color */
    }

    .Card_Disane_Annance h1 {
        margin: 0;
        font-size: 2em; /* Increase font size */
        color: #007bff; /* Change font color */
    }

    /* Styling for the progress indicator */
    .Card_Disane_Annance .progress {
        position: relative;
        width: 92px;
        height: 92px;
        border-radius: 50%;
    }

    /* Resizing SVG for the progress indicator */
    .Card_Disane_Annance svg {
        width: 7em;
        height: 7em;
    }

    /* Styling for the circles inside the progress indicator */
    .Card_Disane_Annance svg circle {
        fill: none;
        stroke: #007bff;
        stroke-width: 14;
        stroke-linecap: round;
        transform: translate(5px, 5px);
        stroke-dasharray: 110;
        stroke-dashoffset: 92;
    }

    /* Adjusting stroke dash array and offset for different types of Card_Disane_Annance */
    .Card_Disane_Annance .sales svg circle {
        stroke-dasharray: -30;
        stroke-dashoffset: 200;
    }

    .Card_Disane_Annance .expenses svg circle {
        stroke-dasharray: 90;
        stroke-dashoffset: 92;
    }

    .Card_Disane_Annance .income svg circle {
        stroke-dasharray: 110;
        stroke-dashoffset: 35;
    }

    /* Styling for the number display in the middle of the progress indicator */
    .Card_Disane_Annance .progress .number {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.5em; /* Increase font size */
        color: #007bff; /* Change font color */
    }

    /* Styling for the small text below the middle section */
    .Card_Disane_Annance small {
        display: block; /* Ensure each line is displayed as a block */
        font-size: 0.8em; /* Decrease font size */
        color: #999999; /* Change font color */
        margin-top: 5px; /* Adjust margin */
    }
</style>

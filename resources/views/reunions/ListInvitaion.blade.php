<x-dashboard-layout>
  <!-- Main content -->
  <x-slot name="contenu">
      <div class="info-container">
          <h1>Invitations</h1>
      
          <!-- Waiting Invitations Section -->
          <h2>Waiting Invitations</h2>
          <div class="Card_Disane_Annance">
              @forelse($waitingInvitations as $invitation)
                  <x-card-invite-annance :invitation="$invitation" />
              @empty
                  <p>No waiting invitations found.</p>
              @endforelse
          </div>
          <x-paginationMultilpleInpage :paginator="$waitingInvitations" />
        

          <!-- Done Invitations Section -->
          <h2>Done Invitations</h2>
          <div class="Card_Disane_Annance">
              @forelse($doneInvitations as $invitation)
                  <x-card-invite-annance :invitation="$invitation" />
              @empty
                  <p>No done invitations found.</p>
              @endforelse
          </div>

          <!-- Pagination for done invitations -->
             <!-- Pagination Links -->
             <x-paginationMultilpleInpage :paginator="$doneInvitations" />
      </div>
  </x-slot>
</x-dashboard-layout>

<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">

<style>
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
  .Card_Disane_Annance > div.done span {
      background: #dee4df;
  }

  .Card_Disane_Annance > div.waiting span {
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

  /* Styling for the small text below the middle section */
  .Card_Disane_Annance small {
      display: block; /* Ensure each line is displayed as a block */
      font-size: 0.8em; /* Decrease font size */
      color: #999999; /* Change font color */
      margin-top: 5px; /* Adjust margin */
  }
</style>

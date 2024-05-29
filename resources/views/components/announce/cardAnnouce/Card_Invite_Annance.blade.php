
    <!-- invite Card_Disane_Annance -->
    @php
    $currentDate = now();
    @endphp
   @if ($invitation->reunion->date >= $currentDate)
    <div class="invite waiting">
      <span class="material-symbols-outlined">analytics</span>
      
    @else
    <div class="invite done">
        <span class="material-symbols-outlined">analytics</span>
    @endif
      <div class="middle ">
        <div class="left">
            <h3>Reunion Name: {{ $invitation->reunion->nom }}</h3>
            <h3>Reunion Date: {{ $invitation->reunion->date }} </h3>
            <h3>Reunion Duration: {{ $invitation->reunion->duree }} min</h3>
            <h3>Invitation Date: {{ $invitation->invitation_date }}</h3>
            <h3>Invitation Specialty: {{ $invitation->reunion->specialite }}</h3>
        </div>
      </div>
      <small class="text-muted"> {{ $invitation->created_at }}</small>
    </div>


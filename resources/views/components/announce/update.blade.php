<!-- resources/views/components/update.blade.php -->

<div class="update">
    <!-- Profile photo -->
    <div class="profile-photo">
        <img src="{{ asset('assets/images/profile-' . $profileNumber . '.png') }}" alt="Profile Photo">
    </div>
    
    <!-- Message -->
    <div class="message">
        <p><b>{{ $name }}</b> <b style="color: red;">{{ $cour }}</b> {{ $description }}</p>
        <small class="text-muted">{{ $timer }}</small>
    </div>
</div>

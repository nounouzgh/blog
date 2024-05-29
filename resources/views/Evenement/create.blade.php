<!DOCTYPE html>
<html>
<head>
    <title>Create Event</title>
</head>
<body>
    <h1>Create Event</h1>
    
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        
        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="{{ old('description') }}">
        </div>
        
        <div>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="{{ old('date') }}">
        </div>
        
        <div>
            <label for="duree">Duration (minutes):</label>
            <input type="number" id="duree" name="duree" value="{{ old('duree') }}">
        </div>
        
        <div>
            <label for="prix">Price:</label>
            <input type="text" id="prix" name="prix" value="{{ old('prix') }}">
        </div>
        
        <div>
            <label for="specialite">Specialty:</label>
            <input type="text" id="specialite" name="specialite" value="{{ old('specialite') }}">
        </div>
        
        <div>
            <label for="nbr_de_place">Number of Places:</label>
            <input type="number" id="nbr_de_place" name="nbr_de_place" value="{{ old('nbr_de_place') }}">
        </div>
        
        <div>
            <label for="expere_id">Expert ID:</label>
            <input type="number" id="expere_id" name="expere_id" value="{{ old('expere_id') }}">
        </div>
        
        <div>
            <button type="submit">Create Event</button>
        </div>
    </form>
</body>
</html>

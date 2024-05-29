<x-dashboard-layout>
    <x-slot name="contenu">
        <!-- Bootstrap CSS only for the content -->
        <div class="info-container">
         
            <div class="infoads">
                @if(session('success'))
                <div class="alert alert-success" style="color: green;">{{ session('success') }}</div>
            @endif
            
                <div class="container-fluid mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="info-container">
                                <h2 class="text-center mb-4">Create Ads</h2>
                                <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="jump">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        
                                    </div>
                                        <div class="form-group">
                                            <label for="specialite">Specialite</label>
                                            <input type="text" class="form-control" id="specialite" name="specialite" required>
                                        </div>
                                  </div>
                                   
                                  <div class="jump">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tel">Tel</label>
                                        <input type="text" class="form-control" id="tel" name="tel" required>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="justification_compitences">Justification Compitences</label>
                                        <input type="text" class="form-control" id="justification_compitences" name="justification_compitences[]">
                                        <small class="form-text text-muted">Add multiple by separating with commas or use the button below to add more fields.</small>
                                    </div>
                                    <button type="button" class="btn btn-secondary mb-2" id="addCompitence">Add Another Justification Compitence</button>
                                    <div class="form-group" id="piece_joints">
                                        <label for="piece_joints">Piece Joints</label>
                                        <input type="file" class="form-control-file mt-2" id="piece_joints_lien" name="piece_joints[]" accept="application/pdf, image/jpeg, image/png" multiple>
                                        <small class="form-text text-muted">Add multiple files by selecting them or use the button below to add more fields.</small>
                                    </div>
                                    <button type="button" class="btn btn-secondary mb-2" id="addPieceJoint">Add Another Piece Joint</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-dashboard-layout>

<link rel="stylesheet" href="{{ asset('assets/css/RebuildMidDivContainet.css') }}">

<script>
    document.getElementById('addCompitence').addEventListener('click', function() {
        let container = document.createElement('div');
        container.classList.add('form-group');
        let input = document.createElement('input');
        input.type = 'text';
        input.classList.add('form-control', 'mt-2');
        input.name = 'justification_compitences[]';
        container.appendChild(input);
        this.insertAdjacentElement('beforebegin', container);
    });

    document.getElementById('addPieceJoint').addEventListener('click', function() {
        let container = document.createElement('div');
        container.classList.add('form-group');
        
        let lienInput = document.createElement('input');
        lienInput.type = 'file';
        lienInput.classList.add('form-control-file', 'mt-2');
        lienInput.name = 'piece_joints[]';
        lienInput.accept = 'application/pdf, image/jpeg, image/png';
        
        container.appendChild(lienInput);
        this.insertAdjacentElement('beforebegin', container);
    });
</script>
<style>
    /* Custom CSS for the .infoads container */

    .infoads h2 {
        color: #007bff;
        margin-bottom: 10px;
    }

    .infoads .form-group {
        margin-bottom: 30px; /* Increase spacing between form groups */
    }

    .infoads .form-label {
        
        font-weight: bold;
        font-size: 16px; /* Set font size to ensure consistency */
    }

    .infoads .form-control {
        display: block;
      
        border: 1px solid #ced4da;
        border-radius: 5px; /* Add border radius to input fields */
        padding: 10px; /* Increase padding */
        transition: border-color 0.3s; /* Smooth transition for border color */
    }

    .infoads textarea.form-control {
        resize: vertical; /* Allow vertical resizing */
    }

    .infoads .form-control-file {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 8px;
    }

    .infoads .form-text {
        margin-top: 5px;
    }

    .infoads .btn {
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .infoads .btn-secondary {
        background-color: #6c757d;
        border: none;
        color: #fff;
    }

    .infoads .btn-primary {
        background-color: #007bff;
        border: none;
        color: #fff;
    }

    .infoads .btn-primary:hover,
    .infoads .btn-secondary:hover {
        background-color: #0056b3;
    }

    .infoads .container-fluid {
        max-width: 700px; /* Set max width to 600px */
    }

    /* Styling for input fields when clicked */
    .infoads .form-control:focus {
        border-color: #007bff; /* Blue border when input is focused */
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Blue shadow when input is focused */
    }

    .jump {
    display: flex;
    flex-direction: row; /* Display the items horizontally */
    justify-content: space-between; /* Add space between the items */
}

.jump .form-group { 
    /*just for  centry 2 input and there text */
    flex: 1; /* Allow each form group to take equal space */
    margin-right: 20px; /* Add margin between the form groups */
}

/* Adjust spacing as needed */
 
    
</style>

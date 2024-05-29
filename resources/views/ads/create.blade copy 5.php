<x-dashboard-layout>
    <x-slot name="contenu">
        <div class="info-container">
            <div class="infoads">
                <div class="container-fluid mt-5"> <!-- Change container to container-fluid and remove padding -->
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="info-container">
                                <h2 class="text-center mb-4">Create Ads</h2>
                                <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="specialite" class="form-label">Specialite</label>
                                        <input type="text" class="form-control" id="specialite" name="specialite" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tel" class="form-label">Tel</label>
                                        <input type="text" class="form-control" id="tel" name="tel" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="piece_joints" class="form-label">Piece Joints</label>
                                        <input type="file" class="form-control-file mt-2" id="piece_joints" name="piece_joints[]" accept="application/pdf, image/jpeg, image/png" multiple>
                                   </div>
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
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



/* Custom CSS for Create Ad form */

<style>

.infoads {
   
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.infoads h2 {
    color: #007bff;
    margin-bottom: 20px;
}

.infoads .form-group {
    margin-bottom: 30px; /* Increase spacing between form groups */
}

.infoads .form-label {
    font-weight: bold;
    font-size: 16px; /* Set font size to ensure consistency */
}

.infoads .form-control {
    border: 1px solid #ced4da;
    border-radius: 5px; /* Add border radius to input fields */
    padding: 10px; /* Increase padding */
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

.infoads .btn-primary {
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.infoads .btn-primary:hover {
    background-color: #0056b3;
}

.infoads .container-fluid {
    max-width: 600px; /* Set max width to 700px */
}

</style>

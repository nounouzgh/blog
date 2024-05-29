<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ad</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Create Ad</h2>
    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="specialite">Specialite</label>
            <input type="text" class="form-control" id="specialite" name="specialite" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="tel">Tel</label>
            <input type="text" class="form-control" id="tel" name="tel" required>
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
</body>
</html>

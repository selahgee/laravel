<head>
        <style>
            /* Add your custom CSS styles here */
#editPatientForm {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#editPatientForm .form-label {
    font-weight: bold;
}

#editPatientForm .form-control {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    box-sizing: border-box;
}

#editPatientForm .mb-3 {
    margin-bottom: 15px;
}

#editPatientForm .btn-primary {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
}

#editPatientForm .btn-primary:hover {
    background-color: #0056b3;
}

        </style>
    </head>
    <form id="editPatientForm" action="{{ route('admin.patient.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $patient->name }}">
        </div>
    
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $patient->email }}">
        </div>
    
        <div class="mb-3">
            <label for="passport" class="form-label">ID/Passport</label>
            <input type="text" class="form-control" id="passport" name="passport" value="{{ $patient->passport }}">
        </div>
    
        <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $patient->phone }}">
            </div>
        
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" class="form-control" id="age" name="age" value="{{ $patient->age }}">
            </div>
        
            <div class="mb-3">
                <label for="allergies" class="form-label">allergies</label>
                <input type="text" class="form-control" id="allergies" name="allergies" value="{{ $patient->allergies }}">
            </div>
            <div class="mb-3">
                    <label for="disabilities" class="form-label">Disabilities</label>
                    <input type="text" class="form-control" id="disabilities" name="disabilities"  value="{{ $patient->disabilities }}">
                </div>
                
                <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
   
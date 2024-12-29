<!-- resources/views/selectForm.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Box with Submit Button</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Fetch Indec OI</h2>

        <!-- Form to select an option and submit -->
        <form action="{{ route('get_oi_data') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="options" class="form-label">Index Code:</label>
                    <input type="text" name="index_code" class="form-control" required>
                    {{-- <select class="form-control" id="options" name="index_name">
                        <option value="">Select an option</option>
                        <option value="nifty">Nifty</option>
                        <option value="bank_nifty">Bank Nifty</option>
                    </select> --}}
                </div>
                <div class="col-md-3">
                    <label for="options" class="form-label">Index No:</label>
                    <input type="text" name="index_no" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="options" class="form-label">Expiry:</label>
                    <input type="date" name="expiry" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="options" class="form-label">Strike:</label>
                    <input type="text" name="strike" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- Display selected option after form submission -->
        @if(session('selected_option'))
            <div class="mt-3 alert alert-info">
                You selected: <strong>{{ session('selected_option') }}</strong>
            </div>
        @endif
    </div>

    <!-- Include Bootstrap JS (Optional for certain components like modals, dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

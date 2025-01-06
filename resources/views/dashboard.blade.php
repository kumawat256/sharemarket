<!-- resources/views/selectForm.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <input type="text" name="index_code" id="index_code" class="form-control" required value="IDX_I">
                    {{-- <select class="form-control" id="options" name="index_name">
                        <option value="">Select an option</option>
                        <option value="nifty">Nifty</option>
                        <option value="bank_nifty">Bank Nifty</option>
                    </select> --}}
                </div>
                <div class="col-md-3">
                    <label for="options" class="form-label">Index No:</label>
                    {{-- <input type="text" name="index_no" class="form-control" required> --}}
                    <select name="index_no" id="index_no" class="form-control" required>
                        <option value="">Select Index No.</option>
                        <option value="13">NIFTY</option>
                        <option value="25">BANKNIFTY</option>
                        <option value="51">SENSEX</option>
                        <option value="27">FINNIFTY</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="options" class="form-label">Expiry:</label>
                    
                    <select name="expiry" id="expiry" class="form-control" required>
                    </select>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $(document).on('change',"#index_no",function(){
                
                var index_no = $(this).val();
                var index_code = $("#index_code").val();
                $("#expiry").text("");
                if(index_no =="" || index_no.length == 0){
                    alert('Please select valid option');
                    return false;
                }
                $.ajax({
                    url: "{{route('getExpiry')}}", 
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { 
                        index_no: index_no,
                        index_code:index_code

                    },
                    beforeSend: function() {
                        // $('#clickBtn'+id).hide();
                        // $('#loader_image'+id).removeClass('d-none');
                    },
                    success: function (result) {
                        // $('#loader_image'+id).addClass('d-none');
                        if(result.status == "success"){
                            var expiry = result.data.data;
                           
                            $.each(expiry, function(index, value) {
                                $("#expiry").append(`<option value="${value}">${value}</option>`);
                            });
                        }
                    },
                    error:function(err){
                       
                    }
                });     
            }) 
        })
    </script>
</body>
</html>

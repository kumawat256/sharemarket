<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Card Upload</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Cards</a></li>
                        <li class="breadcrumb-item active">Card Upload</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Upload Card</h4>
                    <p class="card-title-desc">This card is used for your money load in all module. </p>

                    <div>
                        <form action="{{ route('storeCards') }}" method="post" enctype="multipart/form-data" class="">
                            @csrf
                            <div class="dz-message needsclick text-center">
                                <div class="mb-3">
                                    <i class="display-4 text-muted uil uil-cloud-upload"></i>
                                    <input type="file" name="card" class="form-control w-25 m-auto">
                                </div>

                                <h4>Select your CSV Formated file here to upload.</h4>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Upload Card</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Your Cards</h4>
            <a href="" class="btn btn-danger">Delete All</a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-centered table-nowrap mb-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" class="form-check-input" id="contacusercheck">
                                            <label class="form-check-label" for="contacusercheck"></label>
                                        </div>
                                    </th>
                                    <th scope="col">No</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Card No</th>
                                    <th scope="col">Month</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Cvv</th>
                                    <th scope="col">Card Holder</th>
                                    <th scope="col">Corporate_id</th>
                                    <th scope="col">Emp Id</th>
                                    <th scope="col">Pin</th>
                                    <th scope="col" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            {{-- <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($card as $row)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck1">
                                                <label class="form-check-label" for="contacusercheck1"></label>
                                            </div>
                                        </th>
                                        <td>
                                            <a href="#" class="text-body">{{ $count++ }}</a>
                                        </td>
                                        <td>{{ $row->amount }}</td>
                                        <td>{{ $row->card_no }}</td>
                                        <td>{{ $row->month }}</td>
                                        <td>{{ $row->year }}</td>
                                        <td>{{ $row->cvv }}</td>
                                        <td>{{ $row->card_holder }}</td>
                                        <td>{{ $row->corporate_id }}</td>
                                        <td>{{ $row->corporate_pass }}</td>
                                        <td>{{ $row->pin ?? '' }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </body>
    </html>
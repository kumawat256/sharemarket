<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Option Chain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .call-header {
            background-color: #28a745  !important; /* Green */
            color: white;
        }
        .put-header {
            background-color: #dc3545  !important; /* Red */
            color: white;
        }
        .blank-header {
            background-color:rgb(246, 241, 242) !important; /* Red */
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="text-center mb-4">Option Chain</h2>
            <button class="btn btn-success"><a href="{{route('dashboard_view')}}" style="color:white; text-decoration:none;">Home</a></button>
        </div>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th colspan="2" class="call-header">CALL</th>
                    <th class="blank-header"></th>
                    <th colspan="2" class="put-header">PUT</th>
                </tr>
                <tr>
                    <th>LTP</th>
                    <th>COI</th>
                    <th>STRIKE PRICE</th>
                    <th>LTP</th>
                    <th>COI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$previousCELastPrice2}}</td>
                    <td>{{$previousCEValue2}}</td>
                    <td>{{round($previousKey2)}}</td>
                    <td>{{$previousPELastPrice2}}</td>
                    <td>{{$previousPEValue2}}</td>
                </tr>
                <tr>
                    <td>{{$previousCELastPrice}}</td>
                    <td>{{$previousCEValue}}</td>
                    <td>{{round($previousKey)}}</td>
                    <td>{{$previousPELastPrice}}</td>
                    <td>{{$previousPEValue}}</td>
                </tr>
                <tr>
                    <td>{{$currentCELastPrice}}</td>
                    <td>{{$currentCEValue}}</td>
                    <td>{{round($currentKey)}}</td>
                    <td>{{$currentPELastPrice}}</td>
                    <td>{{$currentPEValue}}</td>
                </tr>
                <tr>
                    <td>{{$nextCELastPrice}}</td>
                    <td>{{$nextCEValue}}</td>
                    <td>{{round($nextKey)}}</td>
                    <td>{{$nextPELastPrice}}</td>
                    <td>{{$nextPEValue}}</td>
                </tr>
                <tr>
                    <td>{{$nextCELastPrice2}}</td>
                    <td>{{$nextCEValue2}}</td>
                    <td>{{round($nextKey2)}}</td>
                    <td>{{$nextPELastPrice2}}</td>
                    <td>{{$nextPEValue2}}</td>
                </tr>
            </tbody>
        </table>

        <h3 class="mt-4">Totals</h3>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th class="blank-header"></th>
                    <th class="call-header">CALL</th>
                    <th class="put-header">PUT</th>
                </tr>
            </thead>
            <tr>
                <td>Total OI</td>
                <td>{{$currentCEValue+$previousCEValue+$previousCEValue2+$nextCEValue+$nextCEValue}}</td>
                <td>{{$currentPEValue+$previousPEValue+$previousPEValue2+$nextPEValue+$nextPEValue}}</td>
            </tr>
            <tr>
                <td>Total ITM</td>
                <td>{{$previousCEValue+$previousCEValue2+$nextCEValue+$nextCEValue}}</td>
                <td>{{$previousPEValue+$previousPEValue2+$nextPEValue+$nextPEValue}}</td>
            </tr>
            <tr>
                <td><b>FINAL OI </b>(CALL + PUT)</td>
                <td>{{$currentCEValue+$previousCEValue+$previousCEValue2+$nextCEValue+$nextCEValue+$currentPEValue+$previousPEValue+$previousPEValue2+$nextPEValue+$nextPEValue}}</td>
            </tr>
            <tr>
                <td><b>FINAL ITM</b></td>
                <td>{{$previousCEValue+$previousCEValue2+$nextCEValue+$nextCEValue+$previousPEValue+$previousPEValue2+$nextPEValue+$nextPEValue}}</td>
            </tr>
            <tr>
                <td><b>FINAL ATM</b></td>
                <td>{{$currentPEValue+$currentCEValue}}</td>
            </tr>
        </table>

        <h3 class="mt-4">COI Imbalance</h3>
        <table class="table table-bordered text-center">
            <tr>
                <td>CALL</td>
                <td>39.51456</td>
                <td>PUT</td>
                <td>60.4854453</td>
            </tr>
            <tr>
                <td>OVERALL</td>
                <td>46.04772</td>
                <td>53.9522877</td>
            </tr>
        </table>

        <h3 class="mt-4">Difference</h3>
        <table class="table table-bordered text-center">
            <tr>
                <td>ATM</td>
                <td>20.97089</td>
            </tr>
            <tr>
                <td>Overall</td>
                <td>7.904566</td>
            </tr>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

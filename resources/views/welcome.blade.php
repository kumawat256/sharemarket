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
                    <th colspan="4" class="call-header">CALL</th>
                    <th class="blank-header"></th>
                    <th colspan="4" class="put-header">PUT</th>
                </tr>
                <tr>
                    <th>LTP</th>
                    <th>OI</th>
                    <th>COI</th>
                    <th>% CHANGE</th>
                    <th>STRIKE PRICE</th>
                    <th>% CHANGE</th>
                    <th>COI</th>
                    <th>OI</th>
                    <th>LTP</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$previousCELastPrice2}}</td>
                    <td>{{$previousCEValue2}}</td>
                    <td>{{$previousCEValue2 - $previousCEPreviousOI2}}</td>
                    <td>{{round(($previousCEValue2 - $previousCEPreviousOI2)/($previousCEPreviousOI2)*100,2)}}</td>
                    <td>{{round($previousKey2)}}</td>
                    <td>{{round(($previousPEValue2 - $previousPEPreviousOI2)/($previousPEPreviousOI2)*100,2)}}</td>
                    <td>{{$previousPEValue2 - $previousPEPreviousOI2}}</td>
                    <td>{{$previousPEValue2}}</td>
                    <td>{{$previousPELastPrice2}}</td>
                </tr>
                <tr>
                    <td>{{$previousCELastPrice}}</td>
                    <td>{{$previousCEValue}}</td>
                    <td>{{$previousCEValue - $previousCEPreviousOI}}</td>
                    <td>{{round(($previousCEValue - $previousCEPreviousOI)/($previousCEPreviousOI)*100,2)}}</td>
                    <td>{{round($previousKey)}}</td>
                    <td>{{round(($previousPEValue - $previousPEPreviousOI)/($previousPEPreviousOI)*100,2)}}</td>
                    <td>{{$previousPEValue - $previousPEPreviousOI}}</td>
                    <td>{{$previousPEValue}}</td>
                    <td>{{$previousPELastPrice}}</td>
                </tr>
                <tr>
                    <td>{{$currentCELastPrice}}</td>
                    <td>{{$currentCEValue}}</td>
                    <td>{{$currentCEValue - $currentCEPreviousOI}}</td>
                    <td>{{round(($currentCEValue - $currentCEPreviousOI)/($currentCEPreviousOI)*100,2)}}</td>
                    <td>{{round($currentKey)}}</td>
                    <td>{{round(($currentPEValue - $currentPEPreviousOI)/($currentPEPreviousOI)*100,2)}}</td>
                    <td>{{$currentPEValue - $currentPEPreviousOI}}</td>
                    <td>{{$currentPEValue}}</td>
                    <td>{{$currentPELastPrice}}</td>
                </tr>
                <tr>
                    <td>{{$nextCELastPrice}}</td>
                    <td>{{$nextCEValue}}</td>
                    <td>{{$nextCEValue - $nextCEPreviousOI}}</td>
                    <td>{{round(($nextCEValue - $nextCEPreviousOI)/($nextCEPreviousOI)*100,2)}}</td>
                    <td>{{round($nextKey)}}</td>
                    <td>{{round(($nextPEValue - $nextPEPreviousOI)/($nextPEPreviousOI)*100,2)}}</td>
                    <td>{{$nextPEValue - $nextPEPreviousOI}}</td>
                    <td>{{$nextPEValue}}</td>
                    <td>{{$nextPELastPrice}}</td>
                </tr>
                <tr>
                     <td>{{$nextCELastPrice2}}</td>
                    <td>{{$nextCEValue2}}</td>
                    <td>{{$nextCEValue2 - $nextCEPreviousOI2}}</td>
                    <td>{{round(($nextCEValue2 - $nextCEPreviousOI2)/($nextCEPreviousOI2)*100,2)}}</td>
                    <td>{{round($nextKey2)}}</td>
                    <td>{{round(($nextPEValue2 - $nextPEPreviousOI2)/($nextPEPreviousOI2)*100,2)}}</td>
                    <td>{{$nextPEValue2 - $nextPEPreviousOI2}}</td>
                    <td>{{$nextPEValue2}}</td>
                    <td>{{$nextPELastPrice2}}</td>
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

        <h3 class="mt-4">COI IMBalance</h3>
        <table class="table table-bordered text-center">
            <tr>
                <td>CALL ATM</td>
                <td>{{round((($currentCEValue - $currentCEPreviousOI)*100)/(($currentCEValue - $currentCEPreviousOI)+($currentPEValue - $currentPEPreviousOI)),2)}}</td>
                <td>PUT ATM</td>
                <td>{{round((($currentPEValue - $currentPEPreviousOI)*100)/(($currentCEValue - $currentCEPreviousOI)+($currentPEValue - $currentPEPreviousOI)),2)}}</td>
            </tr>
            <tr>
                
                <td>CALL ITM</td>
                <td>{{round(((($nextCEValue2 - $nextCEPreviousOI2)+($nextCEValue - $nextCEPreviousOI)+($previousCEValue - $previousCEPreviousOI)+($previousCEValue2 - $previousCEPreviousOI2)) * 100) / (($nextCEValue2 - $nextCEPreviousOI2)+($nextCEValue - $nextCEPreviousOI)+($previousCEValue - $previousCEPreviousOI)+($previousCEValue2 - $previousCEPreviousOI2) + (($nextPEValue2 - $nextPEPreviousOI2)+($nextPEValue - $nextPEPreviousOI) + ($previousPEValue - $previousPEPreviousOI)+($previousPEValue2 - $previousPEPreviousOI2))),2)}}</td>
                <td>PUT ITM</td>
                <td>{{round(((($nextPEValue2 - $nextPEPreviousOI2)+($nextPEValue - $nextPEPreviousOI)+($previousPEValue - $previousPEPreviousOI)+($previousPEValue2 - $previousPEPreviousOI2)) * 100) / (($nextCEValue2 - $nextCEPreviousOI2)+($nextCEValue - $nextCEPreviousOI)+($previousCEValue - $previousCEPreviousOI)+($previousCEValue2 - $previousCEPreviousOI2) + (($nextPEValue2 - $nextPEPreviousOI2)+($nextPEValue - $nextPEPreviousOI) + ($previousPEValue - $previousPEPreviousOI)+($previousPEValue2 - $previousPEPreviousOI2))),2)}}</td>
            </tr>
        </table>

        <h3 class="mt-4">Difference</h3>
        <table class="table table-bordered text-center">
            <tr>
                <td>ATM</td>
                <td>{{round((($currentCEValue - $currentCEPreviousOI)*100)/(($currentCEValue - $currentCEPreviousOI)+($currentPEValue - $currentPEPreviousOI)),2) - round((($currentPEValue - $currentPEPreviousOI)*100)/(($currentCEValue - $currentCEPreviousOI)+($currentPEValue - $currentPEPreviousOI)),2)}}</td>
            </tr>
            <tr>
                <td>ITM</td>
                <td>{{abs(abs(round(((($nextCEValue2 - $nextCEPreviousOI2)+($nextCEValue - $nextCEPreviousOI)+($previousCEValue - $previousCEPreviousOI)+($previousCEValue2 - $previousCEPreviousOI2)) * 100) / (($nextCEValue2 - $nextCEPreviousOI2)+($nextCEValue - $nextCEPreviousOI)+($previousCEValue - $previousCEPreviousOI)+($previousCEValue2 - $previousCEPreviousOI2) + (($nextPEValue2 - $nextPEPreviousOI2)+($nextPEValue - $nextPEPreviousOI) + ($previousPEValue - $previousPEPreviousOI)+($previousPEValue2 - $previousPEPreviousOI2))),2)) - abs(round(((($nextPEValue2 - $nextPEPreviousOI2)+($nextPEValue - $nextPEPreviousOI)+($previousPEValue - $previousPEPreviousOI)+($previousPEValue2 - $previousPEPreviousOI2)) * 100) / (($nextCEValue2 - $nextCEPreviousOI2)+($nextCEValue - $nextCEPreviousOI)+($previousCEValue - $previousCEPreviousOI)+($previousCEValue2 - $previousCEPreviousOI2) + (($nextPEValue2 - $nextPEPreviousOI2)+($nextPEValue - $nextPEPreviousOI) + ($previousPEValue - $previousPEPreviousOI)+($previousPEValue2 - $previousPEPreviousOI2))),2)))}}</td>
            </tr>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

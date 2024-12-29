<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RealtimeController extends Controller
{
    public function index()
    {
        return view('realtime'); // Return the 'realtime' view
    }

    public function dashboard()
    {
        return view('dashboard'); // Return the 'realtime' view
    }

    public function getOIData(Request $request)
    {
        $indexCode = $request->index_code;
        $indexNo = $request->index_no;
        $expiry = $request->expiry;
        $strike = $request->strike;

        $clientID = config("services.dhan_client_id");
        $accessToken = config("services.dhan_access_token");
    
        $url = "https://api.dhan.co/v2/optionchain";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                    "UnderlyingScrip": ' . $indexNo . ',
                                    "UnderlyingSeg": "' . $indexCode . '",
                                    "Expiry": "' . $expiry . '"
                                    }',
            CURLOPT_HTTPHEADER => array(
                "access-token: $accessToken",
                "client-id: $clientID",
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response,true); 
        // echo "<pre>"; print_r($data); die;
        $formattedStrikePrice = number_format((float)$strike, 6, '.', '');

        $oc = $data['data']['oc'];
        $keys = array_keys($oc);
        $index = array_search($formattedStrikePrice, $keys);

        if ($index !== false) {
            // Current index
            $currentKey = $keys[$index];
            $currentCEValue = $oc[$currentKey]['ce']['oi'];
            $currentPEValue = $oc[$currentKey]['pe']['oi'];
            $totalAtm = $currentCEValue+$currentPEValue;
            echo "Current Strike Price CE Value ".$currentCEValue;
            echo "<br>";
            echo "Current Strike Price PE Value ".$currentPEValue;
            echo "<br>";
            // Previous index
            $previousKey = $keys[$index - 1] ?? null;
            $previousCEValue = $previousKey ? $oc[$previousKey]['ce']['oi'] : null;
            $previousPEValue = $previousKey ? $oc[$previousKey]['pe']['oi'] : null;
        
            // Previous 2 index
            $previousKey2 = $keys[$index - 2] ?? null;
            $previousCEValue2 = $previousKey2 ? $oc[$previousKey2]['ce']['oi'] : null;
            $previousPEValue2 = $previousKey2 ? $oc[$previousKey2]['pe']['oi'] : null;
        
            // Next index
            $nextKey = $keys[$index + 1] ?? null;
            $nextCEValue = $nextKey ? $oc[$nextKey]['ce']['oi'] : null;
            $nextPEValue = $nextKey ? $oc[$nextKey]['pe']['oi'] : null;
        
            // Next 2 index
            $nextKey2 = $keys[$index + 2] ?? null;
            $nextCEValue2 = $nextKey2 ? $oc[$nextKey2]['ce']['oi'] : null;
            $nextPEValue2 = $nextKey2 ? $oc[$nextKey2]['pe']['oi'] : null;
        
            // Output the results

            $withOutATMCE = $previousCEValue+$previousCEValue2+$nextCEValue+$nextCEValue2;
            $withOutATMPE = $previousPEValue+$previousPEValue2+$nextPEValue+$nextPEValue2;

            $totalCEValue = $currentCEValue+$previousCEValue+$previousCEValue2+$nextCEValue+$nextCEValue2;
            $totalPEValue = $currentPEValue+$previousPEValue+$previousPEValue2+$nextPEValue+$nextPEValue2;
            
            echo "Without ATM CE Value ".$withOutATMCE;
            echo "<br>";
            echo "Without ATM PE Value ".$withOutATMPE;
            echo "<br>";
            echo " Total Without ATM Value ".$withOutATMPE + $withOutATMCE ;
            echo "<br>";
            echo "CE value ".$totalCEValue;
            echo "<br>";
            echo "PE value ".$totalPEValue;
            echo "<br>";
            echo "Total ATM ".$totalAtm;
            echo "<br>";
            echo "<b>Total Overall Value " . $totalCEValue + $totalPEValue. "</b>"; 
            echo "<br>";
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>COI IMBALACE </b>";
            echo "<br>";

            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CALL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PUT";
            echo "<br>";
            echo "ATM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".round(($currentCEValue*100)/$totalAtm,2) ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".round(($currentPEValue*100)/$totalAtm,2); 
            echo "<br>";
            echo "OVERALL ".round(($withOutATMCE*100)/($withOutATMPE + $withOutATMCE),2). "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".round(($withOutATMPE*100)/($withOutATMPE + $withOutATMCE),2);

            
          

           
        } else {
            echo "No match found for $formattedStrikePrice.\n";
        }
    }

}

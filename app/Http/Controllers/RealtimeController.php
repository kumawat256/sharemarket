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
        // echo "<pre>";print_r($oc);die;
        $keys = array_keys($oc);
        $index = array_search($formattedStrikePrice, $keys);
        
        if ($index !== false) {
            // Current index
            $currentKey = $keys[$index];
            $currentCEValue = $oc[$currentKey]['ce']['oi'];
            $currentCELastPrice = $oc[$currentKey]['ce']['last_price'];
            $currentCEPreviousOI = $oc[$currentKey]['ce']['previous_oi'];

            $currentPEValue = $oc[$currentKey]['pe']['oi'];
            $currentPELastPrice = $oc[$currentKey]['pe']['last_price'];
            $currentPEPreviousOI = $oc[$currentKey]['pe']['previous_oi'];

            
            //previous index
            $previousKey = $keys[$index - 1] ?? null;
            $previousCEValue = $previousKey ? $oc[$previousKey]['ce']['oi'] : null;
            $previousCELastPrice = $previousKey ? $oc[$previousKey]['ce']['last_price'] : null;
            $previousCEPreviousOI = $previousKey ?  $oc[$previousKey]['ce']['previous_oi'] : null;

            $previousPEValue = $previousKey ? $oc[$previousKey]['pe']['oi'] : null;
            $previousPELastPrice = $previousKey ? $oc[$previousKey]['pe']['last_price'] : null;
            $previousPEPreviousOI = $previousKey ? $oc[$previousKey]['pe']['previous_oi'] : null;
            
            // Previous 2 index
            $previousKey2 = $keys[$index - 2] ?? null;
            $previousCEValue2 = $previousKey2 ? $oc[$previousKey2]['ce']['oi'] : null;
            $previousCELastPrice2 = $previousKey2 ? $oc[$previousKey2]['ce']['last_price'] : null;
            $previousCEPreviousOI2 = $previousKey2 ? $oc[$previousKey2]['ce']['previous_oi'] : null;

            $previousPEValue2 = $previousKey2 ? $oc[$previousKey2]['pe']['oi'] : null;
            $previousPELastPrice2 = $previousKey2 ? $oc[$previousKey2]['pe']['last_price'] : null;
            $previousPEPreviousOI2 = $previousKey2 ? $oc[$previousKey2]['pe']['previous_oi'] : null;
            
            // Next index
            $nextKey = $keys[$index + 1] ?? null;
            $nextCEValue = $nextKey ? $oc[$nextKey]['ce']['oi'] : null;
            $nextCELastPrice = $nextKey ? $oc[$nextKey]['ce']['last_price'] : null;
            $nextCEPreviousOI = $nextKey ? $oc[$nextKey]['ce']['previous_oi'] : null;

            $nextPEValue = $nextKey ? $oc[$nextKey]['pe']['oi'] : null;
            $nextPELastPrice = $nextKey ? $oc[$nextKey]['pe']['last_price'] : null;
            $nextPEPreviousOI = $nextKey ? $oc[$nextKey]['pe']['previous_oi'] : null;
            
            
            // Next 2 index
            $nextKey2 = $keys[$index + 2] ?? null;
            $nextCEValue2 = $nextKey2 ? $oc[$nextKey2]['ce']['oi'] : null;
            $nextCELastPrice2 = $nextKey2 ? $oc[$nextKey2]['ce']['last_price'] : null;
            $nextCEPreviousOI2 = $nextKey2 ? $oc[$nextKey2]['ce']['previous_oi'] : null;

            $nextPEValue2 = $nextKey2 ? $oc[$nextKey2]['pe']['oi'] : null;
            $nextPELastPrice2 = $nextKey2 ? $oc[$nextKey2]['pe']['last_price'] : null;
            $nextPEPreviousOI2 = $nextKey2 ? $oc[$nextKey2]['pe']['previous_oi'] : null;
        

            // $withOutATMCE = $previousCEValue+$previousCEValue2+$nextCEValue+$nextCEValue2;
            // $withOutATMPE = $previousPEValue+$previousPEValue2+$nextPEValue+$nextPEValue2;

            // $totalCEValue = $currentCEValue+$previousCEValue+$previousCEValue2+$nextCEValue+$nextCEValue2;
            // $totalPEValue = $currentPEValue+$previousPEValue+$previousPEValue2+$nextPEValue+$nextPEValue2;
            
            return view('welcome',compact('currentKey','previousKey','previousKey2','nextKey','nextKey2','currentCEValue','currentCELastPrice','currentPEValue','currentPELastPrice','previousCEValue','previousCELastPrice','previousPEValue','previousPELastPrice','previousCEValue2','previousCELastPrice2','previousPEValue2','previousPELastPrice2','nextCEValue','nextCELastPrice','nextPEValue','nextPELastPrice','nextCEValue2','nextCELastPrice2','nextPEValue2','nextPELastPrice2','currentCEPreviousOI','currentPEPreviousOI','previousCEPreviousOI','previousPEPreviousOI','previousCEPreviousOI2','previousPEPreviousOI2','nextPEPreviousOI','nextCEPreviousOI','nextPEPreviousOI2','nextCEPreviousOI2'));
              
        } else {
            echo "No match found for $formattedStrikePrice.\n";
        }
    }

    public function getExpiry(Request $request){

        $indexCode = $request->index_code;
        $indexNo = $request->index_no;

        $clientID = config("services.dhan_client_id");
        $accessToken = config("services.dhan_access_token");
    
        $url = "https://api.dhan.co/v2/optionchain/expirylist";

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
                                    "UnderlyingSeg": "' . $indexCode . '"
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
        return response()->json(["status"=>'success',"data"=>$data]);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DovizController extends Controller
{
    public function getExchangeRate()
    {
        $response = Http::get('https://www.tcmb.gov.tr/kurlar/today.xml');

        if ($response->successful()) {
            $xmlData = simplexml_load_string($response->body());

            //dd($xmlData);
            $usdToTry = $xmlData->Currency[0]->BanknoteBuying;
            $eurToTry = $xmlData->Currency[3]->BanknoteBuying;
//dd( $eurToTry);
            return view('exchange_rate', compact('usdToTry', 'eurToTry'));
        } else {
            // İstek başarısız olduğunda yapılacak işlemler
            return view('error');
        }
    }
}

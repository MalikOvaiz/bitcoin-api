<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CryptoCoinDeskController extends Controller
{
  //


  public function index(Request $request)
  {


    // There can be more use cases for validation. i.e End date should be greater than start date
    // Added validation just for an idea 
    $validator = \Validator::make($request->all(), [
      'start' => 'required',
      'end'  => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

    $start = $request->all()['start'];
    $end = $request->all()['end'];
    $client = new \GuzzleHttp\Client();
    $url = "https://api.coindesk.com/v1/bpi/historical/close.json?start=" . $start . "&end=" . $end;
    $req = $client->get($url);
    $response = json_decode($req->getBody(), true);

    return response()->json([
      'bpi' => $response['bpi']
    ], $req->getStatusCode());
  }
}

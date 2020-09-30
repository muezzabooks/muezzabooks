<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SiCepatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      try {
        $response = Http::withHeaders([
          'authority' => 'www.sicepat.com',
          'accept' => 'application/json, text/javascript, */*; q=0.01',
          'x-requested-with' => 'XMLHttpRequest',
          'content-type' => 'application/x-www-form-urlencoded; charset=UTF-8',
        ])
        ->asForm()
        ->post('https://cors-anywhere.herokuapp.com/https://www.sicepat.com/deliveryFee/fare',[
          'origin_code' => 'BDO',
          'destination_code' => $id,
          'weight' => 1
        ]);

        $result = $response['html'];

        return $result;

      } catch (\Throwable $th) {
        return response()->json('Failed to fetch data');
      }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

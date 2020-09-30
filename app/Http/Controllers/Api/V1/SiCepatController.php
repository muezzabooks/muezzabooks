<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

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
      // try {

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
        
        
        // $result = str_replace(/(?:^<div[^>]*>)|(?:<\/div>$)/g, '',$response['html']);
        // $result = strip_tags($response['html'],['table','thead','tr','th','td','tbody']);
        // foreach ($response['html']->find('<tr>') as $row) {
        //   $service = $row->find('td',0)->innertext;
        //   $deskripsi = $row->find('td',1)->innertext;
        //   $tarif = $row->find('td',2)->innertext;
        //   $estimasi = $row->find('td',3)->innertext;
  
        //   $result = [
        //     'service' => $service,
        //     'deskripsi' => $deskripsi,
        //     'tarif' => $tarif,
        //     'estimasi' => $estimasi,
        //   ];
        // }
        $html = $response['html'];
        $crawler = new Crawler($html);

        $result = $crawler->filter('table')->filter('tr')->each(function ($tr, $i){
          return $tr->filter('td')->each(function ($td, $i) {
            return trim($td->text());
          });
        });

        return response()->json($result);

      // } catch (\Throwable $th) {
      //   return response()->json([
      //     'message'=>'Failed to fetch data',
      //     'error' => $th  
      //   ]);
      // }
        
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

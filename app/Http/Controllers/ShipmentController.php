<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index(){
    // $datos = file_get_contents(public_path('/destinations.json'));
    // $data = json_decode($datos, true);

    // $data = array_filter($data);

    // // $data = collect($data)->where("title","LIKE","%{$request->texto}%")->all();

    // $data = collect($data)->all();
    
    return view('showdestination');
    // , compact('data'));
    }
//     public function store(Request $request)
// {
//     return view('showdestination');
// }

public function loadData(Request $request)
    {
                  
            $cari = "a";
            $datos = file_get_contents(public_path('/destinations.json'));
            $data = json_decode($datos, true);
        
            $data = array_filter($data);
        $data = collect($data)->all();
            // dd($data);
        
            // $data = DB::table('users')->select('id', 'email')->where('email', 'LIKE', '%$cari%')->get();
            return response()->json($data);
        
    }
}

<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Destination;
 
class AutoCompleteController extends Controller
{
 
    public function index()
    {
        return view('autocomplete');
    }
 
    public function search(Request $request)
    {
          $search = $request->get('term');
      
          $result = Destination::where('label', 'LIKE', '%'. $search. '%')->get();
          $data = array();
        foreach ($result as $hsl)
            {
                $data[] = $hsl->Destination;
            }
        echo json_encode($data);
            
    } 
}
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Destination;

class DestinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('destinations')->delete();
        $json = File::get(public_path('/destinations.json'));
        $data = json_decode($json);

        foreach ($data as $obj){
            Destination::create(array(
                'label' => $obj->label,
                'code' => $obj->code,
            ));
        }
    }
}

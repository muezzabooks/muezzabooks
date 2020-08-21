<?php

use Illuminate\Database\Seeder;
use App\Origin;

class OriginTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('origins')->delete();
        $json = File::get(public_path('/origins.json'));
        $dataa = json_decode($json);

        foreach ($dataa as $obj){
            Origin::create(array(
                'label' => $obj->label,
                'code' => $obj->code,
            ));
        }
    }
}

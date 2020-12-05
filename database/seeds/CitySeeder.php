<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [ 
            "Arrah",
            "Aurangabad",
            "Bagaha",
            "Begusarai",
            "Bettiah",
            "Bhagalpur",
            "Bihar Sharif",
            "Buxar",
            "Chhapra",
            "Danapur",
            "Darbhanga",
            "Dehri",
            "Gaya",
            "Hajipur",
            "Jamalpur",
            "Jehanabad",
            "Katihar",
            "Kishanganj",
            "Motihari",
            "Munger",
            "Muzaffarpur",
            "Nawada",
            "Patna",
            "Purnia",
            "Saharsa",
            "Sasaram",
            "Sitamarhi",
            "Siwan"
        ];
    
    
        foreach ($cities as $value) {
            DB::table('cities')->insert([
                'name' => $value,
                'alias' => $value,
                'state_id' => 9,
                'country_id' => 9,
                'active' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'), 
            ]);  
        }
    }
}

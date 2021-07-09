<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services=[
            'Wi-fi', 
            'Swimming pool', 
            'A/C', 
            'SPA', 
            'Kitchen', 
            'Washing machine', 
            'Strongbox',
            'Bicycle',
            'Private parking',
            'TV',
            'Breakfast',
            'Garden',
            'No-smoking',

        
        
        ];

        foreach ($services as $service) {
            //1 istanza
            $new_service = new Service();

            //2 pop db
            $new_service->name = $service;

            //3 save
            $new_service->save();
        }
    }
}

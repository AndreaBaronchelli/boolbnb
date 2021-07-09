<?php

use Illuminate\Database\Seeder;
use App\Sponsor;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                'name'=> 'Basic',
                'duration' => 24,
                'price' => 2,99,
            ],
            [
                'name'=> 'Premium',
                'duration' => 72,
                'price' => 5,99,
            ],
            [
                'name'=> 'Gold',
                'duration' => 144,
                'price' => 9,99,
            ]

            
            
        ];
        foreach ($sponsors as $sponsor) {
            //1 istanza 
            $new_sponsor = new Sponsor();

            //2 pop db
            $new_sponsor->name=$sponsor['name'];
            $new_sponsor->duration=$sponsor['duration'];
            $new_sponsor->price=$sponsor['price'];

            //3 save
            $new_sponsor->save();
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Apartment;
use Faker\Generator as Faker;


class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        //
        // UTILIZZA 'SEEDER BY DATA ENTRY' o 'SEEDER BY FAKER'
        // UTILIZZANE UNO E COMMENTA L'ALTRO
        //
        
        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////     SEEDER BY DATA ENTRY    ////////////////////////////////////
        $apartments = [
            [
                'title' => 'B&B in oasi di tranquillità con giardino e patio',
                'rooms' => 3,
                'beds' => 2,
                'bathrooms' => 1,
                'square_meters' => 90,
                'address' => 'Ponte San Pietro, Lombardia, Italia',
                'visibility' => false,
                'latitude' => 45.69737,
                'longitude' => 9.55699,
                'price' => 25,99,
                          
            ]
        ];

        foreach ($apartments as $apartment) {
            // 1 istanza
            $new_apartament = new Apartment();

            //2 popolazione
            $new_apartament->title = $apartment['title'];
            $new_apartament->slug = Str::slug($apartment['title'], '-');
            $new_apartament->rooms = $apartment['rooms'];
            $new_apartament->beds = $apartment['beds'];
            $new_apartament->bathrooms = $apartment['bathrooms'];
            $new_apartament->square_meters = $apartment['square_meters'];
            $new_apartament->address = $apartment['address'];
            $new_apartament->visibility = $apartment['visibility'];
            $new_apartament->latitude = $apartment['latitude'];
            $new_apartament->longitude = $apartment['longitude'];
            $new_apartament->image = 'https://picsum.photos/400/600';
            $new_apartament->price = $apartment['price'];
        
            //3 save
            $new_apartament->save();
        }
            ////////////////////////////////////////////////////////////////////////





        /////////////////////////////////////////////////////////////////////////
        ////////////////////////////    SEEDER BY FAKER     ////////////////////
    
        // $types = ['B&B', 'Appartamento', 'Casa Vacanze', 'Casa', 'Alloggio', 'Dimora', 'Residenza'];
    
        
        // for ($i=0; $i < 10; $i++) {  // scegli quanti appartamenti faker generare
        //     // 1 istanza
        //     $new_apartament = new Apartment();
    
        //     //2 popolazione
        //     $new_apartament->title = $types[rand(0, count($types)-1)] . ' "' . $faker->sentence($nbWords = 3) . '"';
        //     $new_apartament->slug = Str::slug($new_apartament['title'], '-');
        //     $new_apartament->rooms = $faker->numberBetween($min = 1, $max = 6);
        //     $new_apartament->beds = $faker->numberBetween($min = 1, $max = 4);
        //     $new_apartament->bathrooms = $faker->numberBetween($min = 1, $max = 2);
        //     $new_apartament->square_meters = $faker->numberBetween($min = 30, $max = 150);
        //     $new_apartament->address = $faker->streetSuffix . ' ' . $faker->firstNameMale . ' ' . $faker->lastName . ', ' . $faker->numberBetween($min = 1, $max = 180);
        //     $new_apartament->visibility = True;
        //     $new_apartament->latitude = $faker->latitude($min = 45.688887, $max = 45.689836);
        //     $new_apartament->longitude = $faker->longitude($min = 8.7602703, $max = 8.7427393);
        //     $new_apartament->image = 'https://picsum.photos/400/600';
        //     $new_apartament->price = $faker->randomFloat($nbMaxDecimals = 1, $min = 15, $max = 120);
        
        //     //3 save
        //     $new_apartament->save();
        // }
        
        }
    }
    
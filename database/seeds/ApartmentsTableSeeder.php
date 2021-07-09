<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Apartment;


class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}

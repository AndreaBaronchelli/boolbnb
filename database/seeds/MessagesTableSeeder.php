<?php

use Illuminate\Database\Seeder;
use App\Message;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 2; $i++) { 
            //1 istanza
            $new_message = new Message();
            //2 pop
            $new_message-> apartment_id = 2;
            $new_message-> name = $faker->firstName($gender = null);
            $new_message-> email = $faker->email();
            $new_message-> phone_number = $faker->phoneNumber();
            $new_message-> num_guests = $faker->randomDigit();
            $new_message-> message = $faker->realText($maxNbChars = 400);

            //3 save
            $new_message->save();
        }
    }
}

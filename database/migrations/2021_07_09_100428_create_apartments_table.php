<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->string('title', 100);
            $table->string('slug');
            $table->tinyInteger('rooms')->unsigned();
            $table->tinyInteger('beds')->unsigned()->nullable();
            $table->tinyInteger('bathrooms')->unsigned()->nullable();
            $table->smallInteger('square_meters')->unsigned();
            $table->string('address');
            $table->float('latitude', 8, 6);
            $table->float('longitude', 9, 6);
            $table->string('image')->nullable();
            $table->decimal('price', 6,2);
            $table->boolean('visibility');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}

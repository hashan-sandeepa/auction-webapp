<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
        });

        // Insert categories
        DB::table('category')->insert([
            array('name' => 'Book'),
            array('name' => 'Computer'),
            array('name' => 'Mobile Phone'),
            array('name' => 'Electronic'),
            array('name' => 'T-Shirt'),
            array('name' => 'Jewelry'),
            array('name' => 'Home & Garden'),
            array('name' => 'Musical Instrument'),
            array('name' => 'Sport'),
                array('name' => 'Watch'),
            array('name' => 'Shoe'),
            array('name' => 'Headset'),
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_slider', function (Blueprint $table) {
            $table->increments('id')
                            ;
                            $table->string('name' ,190)
                            ;
                            $table->boolean('status')
                            ;
                            $table->string('image' ,190)
                ->nullable()            ;
                            $table->string('publish')
                            ;
                            $table->string('tag' ,190)
                            ;
    
            $table->softDeletes();
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
        Schema::dropIfExists('_slider');
    }
}

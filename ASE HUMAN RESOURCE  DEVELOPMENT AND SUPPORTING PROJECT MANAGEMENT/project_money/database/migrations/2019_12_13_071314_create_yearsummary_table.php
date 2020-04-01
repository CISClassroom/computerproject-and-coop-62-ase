<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearsummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yearsummary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('year');
            $table->integer('total_budget');   
            $table->integer('remaining_budget');  
            $table->integer('num_people');  
            $table->integer('project_total');  
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
        Schema::dropIfExists('yearsummary');
    }
}

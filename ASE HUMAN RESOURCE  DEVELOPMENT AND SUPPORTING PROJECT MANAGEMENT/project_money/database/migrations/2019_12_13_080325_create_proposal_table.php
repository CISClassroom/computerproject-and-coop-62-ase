<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal', function (Blueprint $table) {
            $table->bigIncrements('id_proposal');
            $table->integer('user_id')->nullable();
            $table->dateTime('date');
            $table->string('project_name');
            $table->string('follower_name');
            $table->date('Start_date');
            $table->date('end_date');
            $table->string('note')->nullable();
            $table->integer('type')->nullable();
            $table->string('objective');
            $table->string('vehicle')->nullable();
            $table->string('registration_fee')->nullable();
            $table->string('Attachments')->nullable();
            $table->integer('Allowances_fee');
            $table->string('Allowances_detail');
            $table->integer('Accommodation_fee');
            $table->string('Accommodation_deail')->nullable();
            $table->integer('Travel_expenses');
            $table->string('Travel_deail')->nullable();
            $table->integer('Other_expenses');
            $table->string('Other_deail')->nullable();
            $table->integer('Num_people')->nullable();
            $table->string('Place');
            $table->integer('Activity_code')->nullable();
            $table->integer('Activity')->nullable();
            $table->string('Status')->nullable();
            $table->integer('Project_cost');
            $table->integer('Own_cost')->nullable();
            $table->string('Bosses_opinion')->nullable();
            $table->string('Bosses_aproval_result')->nullable();
            $table->string('dean_opinion')->nullable();
            $table->string('dean_aproval_result')->nullable();
            $table->string('Staff_ aproval_result')->nullable();
            $table->dateTime('Apoval_date')->nullable();
            $table->string('file')->nullable();
            $table->string('file_Allowances')->nullable();
            $file_Accommodation= $req->file('file_Accommodation');
            $file_Travel= $req->file('file_Travel');
            $file_Other= $req->file('file_Other');
            
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
        Schema::dropIfExists('proposal');
    }
}

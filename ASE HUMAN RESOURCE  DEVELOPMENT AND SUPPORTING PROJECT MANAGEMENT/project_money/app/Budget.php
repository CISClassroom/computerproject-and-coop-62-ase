<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Budget extends Model
{
    //
    protected $table ='budget';
    
    public static function addbudget($data){
        return DB::table('budget')
        ->insert($data);

    }

}

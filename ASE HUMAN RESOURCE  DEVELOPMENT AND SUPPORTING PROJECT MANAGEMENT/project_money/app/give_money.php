<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class give_money extends Model
{
    //
    protected $table ='give_money';
    
    public static function getgive($data){
        return DB::table('give_money')
        ->insert($data);

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class userspend extends Model
{
    //
    protected $table ='user_spend';
    
    public static function adduserspend($data){
        return DB::table('user_spend')
        ->insert($data);
    }
}

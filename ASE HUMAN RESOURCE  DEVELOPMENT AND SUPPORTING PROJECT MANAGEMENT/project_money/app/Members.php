<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Members extends Model
{
    protected $table ='proposal';
    
    public static function postform($data){
         DB::table('proposal')
      
         ->insert($data);
         return DB::getPdo()->lastInsertId();;
    }


}

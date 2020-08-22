<?php

namespace App;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    public function ImagenCript($id)
    {
//        dd($id, 'modelo');
        $hashids = new Hashids();
        return $hashids->encode($id, 0,1,2,3,4,5,6,5,4,3,2,1,0 ,$id);
    }
}

<?php

namespace App;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    public function ImagenCript()
    {
        $hashids = new Hashids();
        return $hashids->encode($this->id, 0,1,2,3,4,5,6,5,4,3,2,1,0 ,$this->id);
    }
}

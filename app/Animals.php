<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animals extends Model
{
    
        protected $casts = [
            'longitude' => 'double',
            'latitude' => 'double',
          
        ];
    
}

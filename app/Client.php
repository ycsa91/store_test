<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {
    protected $guarded = [];

    public function getBirthDateAttribute ($date) {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }

    public function getCreatedAtAttribute ($date) {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $this->parseDate($value);
    } 

    public function parseDate($date=null)
    {
        if(isset($date))
        {
            return \Carbon\Carbon::createFromFormat('d/m/Y',$date)->format('Y-m-d H:i:s');
        }
        return null;
    }
}

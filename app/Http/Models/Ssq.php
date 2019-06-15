<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Ssq extends Model
{
    protected $guarded = [];

    public function getNumberNameAttribute()
    {
        return str_split($this->number, 2);
    }

    public function getNoNameAttribute()
    {
        return 'No. ' . $this->no;
    }

}

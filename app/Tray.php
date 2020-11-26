<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tray extends Model
{
    public function OrderedByUser()
    {
        return $this->belongsTo(User::class, 'id', 'idClient');
    }
}

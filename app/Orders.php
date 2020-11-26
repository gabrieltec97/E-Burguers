<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public function OrderByUser()
    {
        return $this->belongsTo(User::class, 'id', 'idClient');
    }
}

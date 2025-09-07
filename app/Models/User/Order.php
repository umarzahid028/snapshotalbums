<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded =[ ];

public function user()
{
   return $this->belongsTo('App\Models\User')->withDefault();
}

public function product()
{
   return $this->belongsTo('App\Models\Admin\Product')->withDefault();
}
}




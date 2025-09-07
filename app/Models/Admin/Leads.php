<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    // use HasFactory;

    
    public function forsale()
{
    return $this->belongsTo('App\Models\Admin\Forsale', 'property_id')->withDefault();
}

public function forlease()
{
    return $this->belongsTo('App\Models\Admin\ForLease', 'property_id')->withDefault();
}

}



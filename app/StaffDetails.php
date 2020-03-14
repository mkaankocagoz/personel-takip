<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffDetails extends Model
{
    protected $fillable=['day', 'checkin', 'checkout'];
}

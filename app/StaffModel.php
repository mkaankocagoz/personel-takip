<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    protected $fillable = ['first_name', 'last_name', 'staff_number', 'department'];
}

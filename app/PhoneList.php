<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneList extends Model
{
    protected $fillable = ['title', 'phone_number', 'find_counts', 'added_by', 'updated_by', 'created_at', 'updated_at'];
}

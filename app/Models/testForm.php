<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testForm extends Model
{
    protected $fillable = [
        'name', 
        'email', 
        'phone',
    ];
}

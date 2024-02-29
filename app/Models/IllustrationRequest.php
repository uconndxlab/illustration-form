<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IllustrationRequest extends Model
{
    protected $fillable = [
        //should be names of table columns
        'journal_cover_request', 
        'description', 
        'has_deadline', 
        'date_deadline',
        'journal_name', 
        'name', 
        'email', 
        'phone', 
        'kfs_account',
        'reference_path'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IllustrationRequest extends Model
{
    protected $fillable = [
        //should be names of table columns
        'is_journal_cover_request', 
        'journal_name',
        'description', 
        'has_deadline', 
        'date_deadline', 
        'name', 
        'email', 
        'phone', 
        'kfs_account',
        'has_references',
        'reference_path'
    ];
}

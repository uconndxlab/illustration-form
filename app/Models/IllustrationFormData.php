<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IllustrationFormData extends Model
{
    protected $fillable = [
        'journal_cover', 
        'description', 
        'deadline', 
        'date', 
        'article_draft_ref', 
        'photos_ref[]', 
        'add_ill_ref[]', 
        'init_ill_ref', 
        'journal_name', 
        'user_name', 
        'email', 
        'phone', 
        'kfs_account'
    ];
    protected $casts = [
        'deadline' => 'boolean',
        'date' => 'date',
        'email' => 'email'
    ];
}

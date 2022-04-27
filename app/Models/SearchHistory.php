<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;

    protected $table = 'search_history';

    protected $fillable = [
        'username',
        'email',
        'avatar_url',
        'profile_url',
        'total_repos'
    ];

}

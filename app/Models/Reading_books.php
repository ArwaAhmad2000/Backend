<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading_books extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_number',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'bib_number',
        'name',
        'category',
        'jersey_size',
        'phone_number',
        'email',
    ];
}


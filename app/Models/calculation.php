<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_number',
        'operator',
        'second_number',
        'result'
    ];
}
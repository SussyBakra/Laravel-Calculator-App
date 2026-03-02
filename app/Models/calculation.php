<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_number',
        'operator',
        'second_number',
        'result'
    ];
}

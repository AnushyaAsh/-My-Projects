<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tableview extends Model
{
    use HasFactory;

    protected $table = 'addurl'; 

    protected $fillable= [
        'original_url',
        'shorterned_url'
    ];
}

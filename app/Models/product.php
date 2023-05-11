<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;


    protected $table = 'table_products';

    protected $fillable = [
            'title',
            'description',
            'price'
    ];



}

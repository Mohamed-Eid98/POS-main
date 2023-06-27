<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorProductSize extends Model
{
    use HasFactory;
    protected $table = 'product_color_sizes';
    protected $guarded=[];
}

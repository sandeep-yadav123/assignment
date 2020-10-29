<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selected extends Model
{
    use HasFactory;
    protected $table = 'selected';
    public $timestamps = true;
    protected $fillable = ['selected', 'created_at']; 
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // protected $guarded = []; // if we want to allow mass assignment, do this

    protected $fillable = [
        // 'task',
        // 'status'
        'name',
        'completed'
    ];
}

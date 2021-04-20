<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $fillable = ['id', 'title'];

    public function employees() {
        return $this->hasMany('App\Models\Employee');
    }
    
}

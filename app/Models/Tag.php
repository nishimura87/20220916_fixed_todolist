<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    public function todos(){
        return $this->hasMany(Todo::class);
    }

    // public function getTagname(){
    //     return $this->tag_name;
    // }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    public $timestamps = false;
    protected $table ='classes';
    protected $primaryKey = 'id_class';
    protected $fillable = ['id_class','code_class'];
}

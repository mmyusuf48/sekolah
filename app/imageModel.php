<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class imageModel extends Model
{
    public $timestamps = false;
    protected $table ='images';
    protected $primaryKey = 'id_image';
    protected $fillable = ['id_image','image','status'];
}

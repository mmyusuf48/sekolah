<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class studentsModel extends Model
{
    public $timestamps = false;
    protected $table ='students';
    protected $primaryKey = 'id';
    protected $fillable = ['id','nama_siswa','id_class','id_image','no_tlp','email','alamat'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class studentsModel extends Model
{
    public $timestamps = false;
    protected $table ='students';
    protected $primaryKey = 'id';
    protected $fillable = ['id','nama_siswa','no_tlp','alamat'];
}

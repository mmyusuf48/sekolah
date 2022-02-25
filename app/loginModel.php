<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loginModel extends Model
{
  public $timestamps = false;
  protected $table ='login';
  protected $primaryKey = 'id_login';
  protected $fillable = ['id_login','user_name','password'];
}

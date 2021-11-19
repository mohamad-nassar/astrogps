<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;
    protected $table="users";
    protected $fillable=['first_name','last_name','email','phone','pbirth','dbirth','pass'];
    public $timestamps=false;
}

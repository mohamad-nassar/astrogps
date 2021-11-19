<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class astro extends Model
{
    use HasFactory;
    protected $table="astro";
    protected $fillable=['id','title','description','place','date'];
    public $timestamps=false;
}

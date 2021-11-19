<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lectures extends Model
{
    use HasFactory;
    protected $table="lectures";
    protected $fillable=['id','title','link','date'];
    public $timestamps=false;
}

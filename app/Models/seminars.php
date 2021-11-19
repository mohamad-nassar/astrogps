<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seminars extends Model
{
    use HasFactory;
    protected $table="seminars";
    protected $fillable=['id','title','description','link','date'];
    public $timestamps=false;
}

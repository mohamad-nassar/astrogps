<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    use HasFactory;
    protected $table="events";
    protected $fillable=['title','parag','file','start_date','end_date'];
    public $timestamps=false;
}

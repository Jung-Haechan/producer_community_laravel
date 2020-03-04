<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hof extends Model
{
    protected $fillable = ['title', 'description', 'composer', 'lyricist', 'performer', 'file_name'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qna extends Model
{
    protected $fillable = ['title', 'question', 'answer'];
}

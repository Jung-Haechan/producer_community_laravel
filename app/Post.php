<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'author', 'board', 'file', 'file_type'];
    private $id;

    public function scopeGetList($query, $board) {
        $query->where('board', $board)->orderBy('id', 'desc');
    }

    public function scopeGetNeighbor($query, $post, $direction) {
        $query->where('board', $post['board'])->where('id', $direction, $post['id'])->limit(1);
    }

    public function scopeGetMyList($query) {
        $query->where('author', Auth::user()->name)->latest();
    }

    public function scopeCountMyList($query, $board) {
        $query->where('author', Auth::user()->name)->where('board', $board)->count();
    }
}

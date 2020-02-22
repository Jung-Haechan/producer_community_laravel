<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class FilesController extends Controller
{
    public function show($board, $file_name) {
        return Storage::get($file_name);
    }
}

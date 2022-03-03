<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function wallpaper(){
        $wallpapers = Photo::latest()->paginate(20);
        return view('wallpaper', compact('wallpapers'));
    }
}
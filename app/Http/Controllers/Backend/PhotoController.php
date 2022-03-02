<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.photo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|min:3|max:120',
            'description'=>'required|min:3|max:200',
            'image'=>'required|mimes:jpeg,jpr,png',
        ]);
        $image = $request->file('image');
        $filaname = $image->hasName();
        $size = $request->image->getSize();

        $formate = $request->image->getClientOrginalExtension();

        $path = 'uploads/'. filaname;
        $path1 = 'uploads/1280z1024' .filaname;
        $path2 = 'uploads/316x255' .filaname;
        $path3 = 'uploads/118x95' .filaname;

        'Image'::make($image->getRealPath())
        ->resize(800,600)->save($path);
        'Image'::make($image->getRealPath())
        ->resize(1280,1024)->save($path1);
        'Image'::make($image->getRealPath())
        ->resize(316,255)->save($path2);
        'Image'::make($image->getRealPath())
        ->resize(118,95)->save($path3);

        $photo = new photo;
        $photo->title = $request->title;
        $photo->description = $request->description;
        $photo->file = $filaname;
        $photo->format = $format;
        $photo ->size= $size;
        $photo->save();
        return redirect()->back()->with('message', "Wallpaper uploaded successfully!");


    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
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
        $photos = Photo::latest()->paginate(20);
        return view('baackend.photo.index',compact('photos'));
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
        $filename = $image->hasName();
        $size = $request->image->getSize();

        $formate = $request->image->getClientOrginalExtension();

        $path = 'uploads/'. filename;
        $path1 = 'uploads/1280z1024' .filename;
        $path2 = 'uploads/316x255' .filename;
        $path3 = 'uploads/118x95' .filename;

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
        $photo->file = $filename;
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
        
        $photo = Photo:: find($id);
        return view ('backend.photo.edit',compact('photo'));

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
        //validation
        $this->validate($request,[
            'title'=>'required|min:3|max:120',
            'description'=>'required|min:3|max:200',
            'image'=>'required|mimes:jpeg,jpr,png',

        ]);
        //details of the photo form db
        $photo = Photo::find($id);
        $fileName= $photo->file;
        $fomat = $photo->format;
        $size = $photo->size;
       //if user is uploaded new photo
        if($request->hasFile('image')){
            $image = $request->file('image');
            $newfilename = $image->hasName();
            $size = $request->image->getSize();
    
            $formate = $request->image->getClientOrginalExtension();
    
            $path = 'uploads/'. newfilename;
            $path1 = 'uploads/1280z1024' .newfilename;
            $path2 = 'uploads/316x255' .newfilename;
            $path3 = 'uploads/118x95' .newfilename;
             //uploads and resize new update image
            'Image'::make($image->getRealPath())
            ->resize(800,600)->save($path);
            'Image'::make($image->getRealPath())
            ->resize(1280,1024)->save($path1);
            'Image'::make($image->getRealPath())
            ->resize(316,255)->save($path2);
            'Image'::make($image->getRealPath())
            ->resize(118,95)->save($path3);
            //delete the previous image
            unlink(public_path('/uploads/' .$photo->file));
            unlink(public_path('/uploads/1280x1024' .$photo->file));
            unlink(public_path('/uploads/316x255' .$photo->file));
            unlink(public_path('/uploads/118x95' .$photo->file));

            $photo->title = $request->get('title');
            $photo->description = $request->get('description');
            $photo->format = $fomat;
            $photo->size = $size;
            //save new file in db
            $photo->file = $newfilename;
            $photo->save();
            return redirect()->back()->with('message', "Photo updated successfully!");
    

        }else{
         //if user is not uploaded new photo just want ti change title and description 
        $photo->title = $request->get('title');
        $photo->description = $request->get('description');
        $photo->format = $fomat;
        $photo->size = $size;
        $photo->file = $fileName;
        $photo->save();
        return redirect()->back()->with('message', "Photo updated successfully!");

    }}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find('$id');
        $fileName = $photo->file;
        $photo->delete();
        unlink(public_path('/uploads/' .$photo->file));
        unlink(public_path('/uploads/1280x1024' .$photo->file));
        unlink(public_path('/uploads/316x255' .$photo->file));
        unlink(public_path('/uploads/118x95' .$photo->file));
        return redirect()->back()->with('message', "Photo deleted successfully!");


    }
}
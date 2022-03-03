<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ringtone;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RingtoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $ringtones = Ringtone::paginate(10);
        return view ('backend.ringtone.index',compact('ringtones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ringtone.create');
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
            'title'=>'required|min:3|max:100',
            'description'=>'required|min:3|max:500',
            'file'=>'required|mimes:mpga,wav|max:2000',
            'category'=>'required',

        ]);
        $fileName= $request->file->hasName();
        $fomat = $request->file->getOriginalExtension();
        $size = $request->file->getSize();
        $request->file->move(public_path('audio'),$fileName);

        $ringtone = new Ringtone;
        $ringtone->title = $request->get('title');
        $ringtone->slug = Str::slug($request->get('title'));
        $ringtone->description = $request->get('description');
        $ringtone->category_id = $request->get('category');
        $ringtone->format = $fomat;
        $ringtone->size = $size;
        $ringtone->file = $fileName;
        $ringtone->save();
        return redirect()->back()->with('message', "Ringtone created successfully!");

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
        $ringtone = Ringtone:: find($id);
        return view ('backend.ringtone.edit',compact('ringtone'));

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
        $this->validate($request,[
            'title'=>'required|min:3|max:100',
            'description'=>'required|min:3|max:500',
            'category'=>'required',

        ]);
        
        $ringtone = Ringtone::find($id);
        $fileName= $request->file;
        $fomat = $request->format;
        $size = $request->size;
        $download = $request->download;

        if($request->hasFile('file')){
        $fileName= $request->file->hasName();
        $fomat = $request->file->getOriginalExtension();
        $size = $request->file->getSize();
        $request->file->move(public_path('audio'),$fileName);
        unlink(public_path('/audio/' .$ringtone->file));
        $download = 0;

        }
        
        $ringtone->title = $request->get('title');
        $ringtone->slug = Str::slug($request->get('title'));
        $ringtone->description = $request->get('description');
        $ringtone->category_id = $request->get('category');
        $ringtone->format = $fomat;
        $ringtone->size = $size;
        $ringtone->file = $fileName;
        $ringtone->download = $download;
        $ringtone->save();
        return redirect()->back()->with('message', "Ringtone updated successfully!");

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ringtone = Ringtone::find('$id');
        $fileName = $ringtone->file;
        $ringtone->delete();
        unlink(public_path('/audio/' .$ringtone->file));

        return redirect()->back()->with('message', "Ringtone deleted successfully!");


    }
}
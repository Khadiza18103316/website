@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All ringtions</div>
                <span class="float-right">
                    <a href="{{route('ringtones.create')}}">
                        <button class="btn btn-primary">Create Ringtone</button>
                    </a>
                </span>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">File</th>
                            <th scope="col">category</th>
                            <th scope="col">Download</th>
                            <th scope="col">Size</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>

                          </tr>
                        </thead>
                        <tbody>
                            @if(count($ringtone)>0)
                            @foreach($ringtones as $key => $ringtone)
                          <tr>
                              <th scope="row">{{$key+1}}</th>
                              <td scope="row">{{$ringtone->title}}</td>
                              <td scope="row">{{$ringtone->description}}</td>
                              <td scope="row">
                                  <audio controls onplay="pauseOthers(this);">
                                      <source src="/audio/{{$ringtone->file}}" type="audio/ogg">
                                        Your browser does not support this element
                                  </audio>

                              </td>
                              <td scope="row">{{$ringtone->category->name}}</td>
                              <td scope="row">{{$ringtone->download}}</td>
                              <td scope="row">{{$ringtone->size}}bytes</td>
                              <td>
                                  <a href="{{route('ringtones.edit',[$ringtone->id])}}">
                                    <button class="btn btn-info">Edit</button>
                              </td>
                              <td>
                                  <form action="{{route('ringtones.destory',[$ringtone->id])}}" method="post" onSubmit="return confirm('Do you want to delete?')">@csrf {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                
                                </form>
                              </td>
                            </tr>
                              @endforeach
                              @else
                              <td>No ringtones to display</td>
                              @endif
                        </tbody>
                      </table>
                </div>
            </div>
            {{$ringtones->link()}}
        </div>
    </div>
</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(Session::has('message'))
            <div class="alert alert-danger">{{Session::get('message')}}</div> 
            @endif
            <div class="card">
                <div class="card-header">All Photos</div>
                <span class="float-right">
                    <a href="{{route('photos.create')}}">
                        <button class="btn btn-primary">Create Photo</button>
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
                            <th scope="col">Format</th>
                            <th scope="col">Size</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if(count($photo)>0)
                            @foreach($photos as $key => $photo)
                          <tr>
                              <th scope="row">{{$key+1}}</th>
                              <td scope="row">{{$photo->title}}</td>
                              <td scope="row">{{$photo->description}}</td>
                              <td scope="row">{{$photo->file}}</td>
                              <td>
                                  <img src="/uploads/{{$photo->file}}" width="100">

                              </td>
                              <td scope="row">{{round($photo->size)*0.001,2}}kb</td>
                              <td>
                                  <a href="{{route('photos.edit',[$photo->id])}}">
                                    <button class="btn btn-info">Edit</button>
                              </td>
                              <td>
                                  <form action="{{route('photos.destory',[$photo->id])}}" method="post" onSubmit="return confirm('Do you want to delete?')">@csrf {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                
                                </form>
                              </td>
                            </tr>
                              @endforeach
                              @else
                              <td>No photos to display</td>
                              @endif
                        </tbody>
                      </table>
                </div>
            </div>
            {{$photos->link()}}
        </div>
    </div>
</div>

@endsection

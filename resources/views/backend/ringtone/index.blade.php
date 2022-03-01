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
                            <th scope="col">Download</th>
                            <th scope="col">Size</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              @foreach($ringtones as $key => $ringtone)
                              <th scope="row">{{$key+1}}</th>
                              <td scope="row">{{$ringtone->title}}</td>
                              <td scope="row">{{$ringtone->description}}</td>
                              <td>
                                  <audio controls>
                                      <source src="/audio/{{$ringtone->file}}" type="audio/ogg">
                                        Your browser does not support this element
                                  </audio>

                              </td>
                              <td scope="row">{{$ringtone->download}}</td>
                              <td scope="row">{{$ringtone->size}}</td>
                              @endforeach
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
            {{$ringtones->link()}}
        </div>
    </div>
</div>
@endsection

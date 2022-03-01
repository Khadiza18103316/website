@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Ringtone</div>

                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>File</label>
                        <input type="file" name="file" class="form-control" accept="audio/*">
                    </div>
                    <div class="form-group">
                        <label>Choose category</label>
                        <select class="form-control" name="category">
                            @foreach(App\Models\Category::all() as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <div class="from-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                    
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

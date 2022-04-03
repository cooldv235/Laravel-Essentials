@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit About</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('update/homeabout/'.$homeabout->id) }}" method="POST" >
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">About Title</label>
                    <input type="text" name="title" value="{{$homeabout->title}}" class="form-control" id="exampleFormControlInput1" placeholder="About Title">
                </div>
                @error('title')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
                
                
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">About Short Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="short_dis" rows="3">{{$homeabout->short_dis}}</textarea>
                </div>
                @error('short_dis')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">About Long Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="long_dis" rows="3">{{$homeabout->long_dis}}</textarea>
                </div>
                @error('long_dis')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror

                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
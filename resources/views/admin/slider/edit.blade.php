@extends('admin.admin_master')

    @section('admin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            </div> -->

            <div class="container">
                <div class="row">
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Edit Slider</div>

                            <div class="card-body">
                                <form action="{{ url('slider/update/'.$slider_data->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="old_image" value="{{ $slider_data->image }}" />
                                    <div class="form-group">
                                        <label for="title">Update Slider Title</label><br><br>
                                        <input type="text" name="title" class="form-control" id="title" value="{{ $slider_data->title }}">

                                        @error('title')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div><br>

                                    <div class="form-group">
                                        <label for="description">Update Slider Description</label><br><br>
                                        <input type="text" name="description" class="form-control" id="description" value="{{ $slider_data->description }}">

                                        @error('description')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div><br>

                                    <div class="form-group">
                                        <label for="image">Select New Slider Image</label><br><br>
                                        <input type="file" name="image" class="form-control" id="image" value="{{ $slider_data->image }}">

                                        @error('image')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div><br>

                                    <div class="form-group">
                                        <img src="{{ asset($slider_data->image) }}" alt="Slider Image" style="width:200px; height:100px">
                                    </div><br>

                                    <button type="submit" class="btn btn-success">Update Slider</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>

        </div>
    </div>
@endsection('admin')
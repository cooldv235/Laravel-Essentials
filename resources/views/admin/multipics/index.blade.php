@extends('admin.admin_master')

    @section('admin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            </div> -->

            <!-- ALL ACTIVE Pictures LIST -->
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-group">
                            @foreach($images as $image)
                                <div class="col-md-4 mt-5">
                                    <div class="card">
                                        <img src="{{ asset($image->image) }}" alt="Brand Image" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"> Add Pictures</div>

                            <div class="card-body">
                                <form action="{{ route('store.images') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="brand">Pictures Image</label>
                                        <input type="file" name="image[]" multiple="" class="form-control" id="image">

                                        @error('image[]')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div><br>
                                    <button type="submit" class="btn btn-success">Add Pictures</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>

        </div>
    </div>
    @endsection
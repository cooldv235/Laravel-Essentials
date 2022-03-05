<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brands
            </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            </div> -->

            <div class="container">
                <div class="row">
                <div class="col-md-8">
                        <div class="card">
                            <div class="card-header"> Edit Brand</div>

                            <div class="card-body">
                                <form action="{{ url('brand/update/'.$brand_data->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="old_image" value="{{ $brand_data->brand_image }}" />
                                    <div class="form-group">
                                        <label for="brand">Update Brand Name</label><br><br>
                                        <input type="text" name="brand_name" class="form-control" id="brand" value="{{ $brand_data->brand_name }}">

                                        @error('brand_name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div><br>

                                    <div class="form-group">
                                        <label for="brand_image">Select New Brand Image</label><br><br>
                                        <input type="file" name="brand_image" class="form-control" id="brand_image" value="{{ $brand_data->brand_image }}">

                                        @error('brand_image')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div><br>

                                    <div class="form-group">
                                        <img src="{{ asset($brand_data->brand_image) }}" alt="{{ $brand_data->brand_name . ' Logo' }}" style="width:200px; height:100px">
                                    </div><br>

                                    <button type="submit" class="btn btn-success">Update Brand</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
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

            <!-- ALL ACTIVE Brands LIST -->
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            
                            <!-- SUCCESS MESSAGE IF brand IS CREATED SUCCESSFULLY. -->
                            @if(session('pdelete'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('pdelete') }}</strong>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <!--  SUCCESS MESSAGE IF BRAND IS ADDED SUCCESFULLY. -->
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if(session('restore'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('restore') }}</strong>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
 
                            <!-- SUCCESS MESSAGE IF THE brand IS DELETED -->
                            @if(session('deleted'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleted') }}</strong>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <!-- SUCCESS MESSAGE IF brand IS UPDATED SUCCESSFULLY. -->
                            @if(session('updated'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('updated') }}</strong>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <div class="card-header"> All Brands</div>

                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th scope="col">SL No.</th>
                                        <th scope="col">Brand Name</th>
                                        <th scope="col">Brand Logo</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Updated At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- @php($count = 1) -->

                                    @foreach($brands as $brand)
                                    <tr>
                                        <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td><img src="{{ asset($brand->brand_image) }}" style="height:40px; width:70px" alt="{{ $brand->brand_name . ' Logo' }}"></td>
                                        <td>Blank</td>
                                        <td>
                                            @if($brand->created_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($brand->updated_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($brand->updated_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info"><i class="bi bi-pencil-square"></i></a>
                                            <a href="{{ url('brand/delete/'.$brand->id) }}" onclick="return confirm('Are you sure ?')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $brands->links() }}  <!-- PAGINATION LINKS USING LARAVEL -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"> Add Brand</div>

                            <div class="card-body">
                                <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="brand">Brand Name</label>
                                        <input type="text" name="brand_name" class="form-control" id="brand">

                                        @error('brand_name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div><br>

                                    <div class="form-group">
                                        <label for="brand">Brand Image</label>
                                        <input type="file" name="brand_image" class="form-control" id="brand_image">

                                        @error('brand_image')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div><br>
                                    <button type="submit" class="btn btn-success">Add Brand</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>

        </div>
    </div>
</x-app-layout>
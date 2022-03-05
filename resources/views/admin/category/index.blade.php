<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Categories
            </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            </div> -->

            <!-- ALL ACTIVE CATEGORIES LIST -->
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            
                            <!-- SUCCESS MESSAGE IF CATEGORY IS CREATED SUCCESSFULLY. -->
                            @if(session('pdelete'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('pdelete') }}</strong>

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
 
                            <!-- SUCCESS MESSAGE IF THE CATEGORY IS DELETED -->
                            @if(session('deleted'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleted') }}</strong>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <!-- SUCCESS MESSAGE IF CATEGORY IS UPDATED SUCCESSFULLY. -->
                            @if(session('updated'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('updated') }}</strong>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <div class="card-header"> All Categories</div>

                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th scope="col">SL No.</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Updated At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- @php($count = 1) -->

                                    @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user->name }}</td>
                                        <td>
                                            @if($category->created_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($category->updated_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($category->updated_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info"><i class="bi bi-pencil-square"></i></a>
                                            <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links() }}  <!-- PAGINATION LINKS USING LARAVEL -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"> Add Category</div>

                            <div class="card-body">
                                <form action="{{ route('store.category') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="category">Category Name</label>
                                        <input type="text" name="category_name" class="form-control" id="category">

                                        @error('category_name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div><br>

                                    <button type="submit" class="btn btn-success">Add Category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            
            <!-- ALL TRASH CATEGORIES LIST -->
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">

                            <div class="card-header">All Trash Categories</div>

                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th scope="col">SL No.</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- @php($count = 1) -->

                                    @foreach($trashCategories as $category)
                                    <tr>
                                        <th scope="row">{{ $trashCategories->firstItem() + $loop->index }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user->name }}</td>
                                        <td>
                                            @if($category->created_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-success">Restore</a>
                                            <a href="{{ url('pdelete/category/'.$category->id) }}" onclick="return confirm('Are you sure ?')" class="btn btn-danger">Delete Permanently</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $trashCategories->links() }}  <!-- PAGINATION LINKS USING LARAVEL -->
                        </div>
                    </div>

                    <div class="col-md-4">
                        
                    </div>
                </div>
            </div>
            <!-- END TRASH CATEGORIES -->

        </div>
    </div>
</x-app-layout>
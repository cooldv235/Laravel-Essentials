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

            <div class="container">
                <div class="row">
                <div class="col-md-8">
                        <div class="card">
                            <div class="card-header"> Edit Category</div>

                            <div class="card-body">
                                <form action="{{ url('category/update/'.$category->id)}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="category">Update Category Name</label><br><br>
                                        <input type="text" name="category_name" class="form-control" id="category" value="{{ $category->category_name }}">

                                        @error('category_name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div><br>

                                    <button type="submit" class="btn btn-success">Update Category</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
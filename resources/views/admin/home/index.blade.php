@extends('admin.admin_master')

    @section('admin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            </div> -->

            <!-- ALL ACTIVE Sliders LIST -->
            <div class="container">
                <div class="row">
                    <h4>Home About</h4>
                    <div style="margin-left: 85%;">
                        <a href="{{ route('add.about') }}"><button class="btn btn-info">Add About</button></a><br><br>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            
                            <!-- SUCCESS MESSAGE IF slider IS CREATED SUCCESSFULLY. -->
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
 
                            <!-- SUCCESS MESSAGE IF THE slider IS DELETED -->
                            @if(session('deleted'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleted') }}</strong>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <!-- SUCCESS MESSAGE IF slider IS UPDATED SUCCESSFULLY. -->
                            @if(session('updated'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('updated') }}</strong>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <div class="card-header"> All Sliders</div>

                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">SL</th>
                                        <th scope="col" width="10%">About Title</th>
                                        <th scope="col" width="15%">Short Description</th>
                                        <th scope="col" width="25%">Long Description</th>
                                        <th scope="col" width="10%">Created At</th>
                                        <th scope="col" width="10%">Updated At</th>
                                        <th scope="col" width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($count = 1)

                                    @foreach($homeabouts as $homeabout)
                                    <tr>
                                        <th scope="row">{{ $count++ }}</th>
                                        <td>{{ $homeabout->title }}</td>
                                        <td>{{ $homeabout->short_dis }}</td>
                                        <td>{{ $homeabout->long_dis }}</td>
                                        <td>
                                            @if($homeabout->created_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($homeabout->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($homeabout->updated_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($homeabout->updated_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('about/edit/'.$homeabout->id) }}" class="btn btn-info"><i class="bi bi-pencil-square"></i></a>
                                            <a href="{{ url('about/delete/'.$homeabout->id) }}" onclick="return confirm('Are you sure ?')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>

                   
                </div>
            </div><br>

        </div>
    </div>
    @endsection
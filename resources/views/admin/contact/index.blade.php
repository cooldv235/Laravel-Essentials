@extends('admin.admin_master')

    @section('admin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            </div> -->

            <!-- ALL ACTIVE Sliders LIST -->
            <div class="container">
                <div class="row">
                    <div style="margin-left: 85%;">
                        <a href="{{ route('add.contact') }}"><button class="btn btn-info">Add Contact</button></a><br><br>
                    </div>
                    <h4>Contact Page</h4><br><br>

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
 
                            <!-- SUCCESS MESSAGE IF THE slider IS DELETED -->
                            @if(session('deleted'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleted') }}</strong>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <div class="card-header">All Contact messages</div>

                            @if(count($contacts) > 0)
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">SL</th>
                                        <th scope="col" width="15%">Contact Address</th>
                                        <th scope="col" width="15%">Contact Email</th>
                                        <th scope="col" width="15%">Contact Phone</th>
                                        <th scope="col" width="10%">Received At</th>
                                        <th scope="col" width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($count = 1)

                                    @foreach($contacts as $contact)
                                    <tr>
                                        <th scope="row">{{ $count++ }}</th>
                                        <td>{{ $contact->address }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>
                                            @if($contact->created_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($contact->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/contact/delete/'.$contact->id) }}" onclick="return confirm('Are you sure ?')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <p class="text-center" style="padding: 10px;">No Data Available</p>
                            @endif
                            
                        </div>
                    </div>

                   
                </div>
            </div><br>

        </div>
    </div>
    @endsection
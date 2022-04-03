@extends('admin.admin_master')

    @section('admin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            </div> -->

            <!-- ALL ACTIVE Sliders LIST -->
            <div class="container">
                <div class="row">
                    <h4>Contact Messages</h4><br><br>

                    <div class="col-md-12">
                        <div class="card">
                            
                            <!-- SUCCESS MESSAGE IF THE slider IS DELETED -->
                            @if(session('deleted'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleted') }}</strong>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            
                            <div class="card-header">All message messages</div>

                            @if(count($messages) > 0)
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">SL</th>
                                        <th scope="col" width="10%">Sender Name</th>
                                        <th scope="col" width="10%">Sender Email</th>
                                        <th scope="col" width="10%">Subject</th>
                                        <th scope="col" width="15%">Message</th>
                                        <th scope="col" width="10%">Received At</th>
                                        <th scope="col" width="8%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($count = 1)

                                    @foreach($messages as $message)
                                    <tr>
                                        <th scope="row">{{ $count++ }}</th>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->subject }}</td>
                                        <td>{{ $message->message }}</td>
                                        <td>
                                            @if($message->created_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($message->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/message/delete/'.$message->id) }}" onclick="return confirm('Are you sure ?')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Schedule List</div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif


                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">schedules List</div>
                            <div class="card-body">
                                <table id="admin_Schedule_data" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Created User Name</th>
                                            <th>To User Name</th>
                                            <th>date</th>
                                            <th>StartTime</th>
                                            <th>EndTime</th>
                                            <th>Table</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($schedules as $key => $value)
                                    <tr>
                                        <td>{{ $value->created_user->name }}</td>
                                        <td>{{ $value->user->name }}</td>
                                        <td>{{ $value->date }}</td>
                                        <td>{{ $value->startTime }}</td>
                                        <td>{{ $value->endTime }}</td>
                                        <td>{{ $value->table_no }}</td>
                                        <td>{{ $value->status }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ url('adminApproved',$value->id) }}">Approved</a>   
                                            <a class="btn btn-danger" href="{{ url('adminRejected',$value->id) }}">Rejected</a>  
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Created User Name</th>
                                            <th>To User Name</th>
                                            <th>date</th>
                                            <th>StartTime</th>
                                            <th>EndTime</th>
                                            <th>Table</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
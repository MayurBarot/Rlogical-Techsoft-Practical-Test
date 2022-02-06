@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Schedule List</div>
                <div class="pull-right">
                <a class="btn btn-success" style="margin: 10px;" href="{{ route('schedules.create') }}"> Create New Schedule</a>

                <a class="btn btn-success" style="margin: 10px;" href="{{ url('schedules_meeting') }}"> View Meeting Schedule</a>

            </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif


                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Schedules List</div>
                            <div class="card-body">
                                <table id="Schedule_data" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
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
                                            <td>{{ $value->user->name }}</td>
                                            <td>{{ $value->date }}</td>
                                            <td>{{ $value->startTime }}</td>
                                            <td>{{ $value->endTime }}</td>
                                            <td>{{ $value->table_no }}</td>
                                            <td>{{ $value->status }}</td>
                                            <td>
                                                 <form action="{{ route('schedules.destroy',$value->id) }}" method="POST">
                                                    <!-- <a class="btn btn-primary" href="{{ route('schedules.edit',$value->id) }}">Edit</a>  -->  
                                                    @csrf
                                                    @method('DELETE')      
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>User Name</th>
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
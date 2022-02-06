@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Schedules</div>
                <div class="pull-right">
                <a class="btn btn-primary" style="margin: 10px;" href="{{ route('schedules.index') }}"> Back</a>
            </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                   @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">{{ isset($schedules) ? 'Edit A schedule' : 'Create New Schedule' }} </div>
                            <div class="card-body">
                                @if(isset($schedules) && !empty($schedules))
                                    <form id="master-module" action="{{ route('schedules.update',$schedules->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('put')
                                @else
                                    <form method="POST" action="{{ route('schedules.store') }}" enctype="multipart/form-data">
                                @endif
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">User Name</label>
                                        <div class="col-md-6">
                                            <select  class="form-control @error('to_user_id') is-invalid @enderror" name="to_user_id" id="to_user_id">
                                              @foreach($users as $key=>$user)
                                                  <option value='{{$user->id}}'>{{$user->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">Date</label>

                                        <div class="col-md-6">
                                            <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', isset($schedules->date) ? $schedules->date : '') }}"  autocomplete="email" min="{{ date('Y-m-d') }}">

                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">StartTime</label>

                                        <div class="col-md-6">
                                            <input id="startTime" type="time" class="form-control @error('startTime') is-invalid @enderror" name="startTime" value="{{ old('StartTime', isset($schedules->StartTime) ? $schedules->StartTime : '') }}"  autocomplete="email">

                                            @error('startTime')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">EndTime</label>

                                        <div class="col-md-6">
                                            <input id="endTimedatepicker" type="time" class="form-control @error('endTime') is-invalid @enderror" name="endTime" value="{{ old('endTime', isset($schedules->endTime) ? $schedules->endTime : '') }}"  autocomplete="email">

                                            @error('endTime')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">Table</label>
                                        <div class="col-md-6">
                                            <select  class="form-control @error('table_no') is-invalid @enderror" name="table_no" id="table_no">
                                                  <option value='Table1'>Table1</option>
                                                  <option value='Table2'>Table2</option>
                                                  <option value='Table3'>Table3</option>
                                                  <option value='Table4'>Table4</option>
                                                  <option value='Table5'>Table5</option>
                                                  <option value='Table6'>Table6</option>
                                                  <option value='Table7'>Table7</option>
                                                  <option value='Table8'>Table8</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                               Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
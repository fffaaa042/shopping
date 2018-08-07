@extends('layouts.admin')

@section('content')
    <h1>Edit User</h1>

    <div class="row">
    <div class="col-sm-3">
        <img src="{{$user->photo ? $user->photo->file : "/images/no-photo.png"}}" alt="" class="img-responsive img-rounded">
    </div>

    <div class="col-sm-9">

    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true ]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name: ') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email: ') !!}
        {!! Form::text('email', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id', 'Role: ') !!}
        {!! Form::select('role_id', $roles , null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('photo_id', 'File: ') !!}
        {!! Form::file('photo_id',null , ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_active', 'Status: ') !!}
        {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'), null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password: ') !!}
        {!! Form::password('password', ['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-6']) !!}
    </div>
    {!! Form::close() !!}


       <!--DELETE Form-->
        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}

          <div class="form-group">
          {!! Form::submit('DELETE', ['class'=>'btn btn-danger col-sm-6']) !!}
          </div>
        {!! Form::close() !!}



     </div> <!-- End col-sm-9 -->
    </div> <!--End Row-->

    <div class="row">
     @include('includes.errors')
    </div>




@stop
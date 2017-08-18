@extends('layouts.admin_layout')

@section('css')

@endsection

@section('content')
    @include('includes.tinyeditor')
    <h2 class="page-header">Contact</h2>

    <div class="col-lg-12">
        <form method="post" action="{{url('update_menu')}}">
            {{ csrf_field() }}
            {!! Form::hidden('id', $home->id) !!}

            <div class="form-group">
                {!! Form::label('name', 'Main Title:') !!}
                {!! Form::text('name', $home->name, ['class'=>'form-control', 'required' => 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Save Changes', ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        </form>
<br><br>
        @if(count($errors))
            <div class="form-group">
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <form method="post" action="{{url('update_info')}}">
            {{ csrf_field() }}
            {!! Form::hidden('id', $info->id) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $info->name, ['class'=>'form-control', 'required' => 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('address', 'Address:') !!}
                {!! Form::text('address', $info->address, ['class'=>'form-control', 'required' => 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('city', 'City:') !!}
                {!! Form::text('city', $info->city, [ 'required' => 'required']) !!}
                {!! Form::label('state', 'State:') !!}
                {!! Form::text('state', $info->state, ['required' => 'required']) !!}
                {!! Form::label('zipcode', 'Zipcode:') !!}
                {!! Form::text('zipcode', $info->zipcode, ['required' => 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Save Changes', ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        </form>

    </div>
    <div class="col-lg-12">
        @include('flash::message')
        @if(count($errors))
            <div class="form-group">
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
    <div class="col-lg-10 bottom-padding">

    </div>

@endsection
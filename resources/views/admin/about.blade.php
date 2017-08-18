@extends('layouts.admin_layout')

@section('css')

@endsection

@section('content')
    @include('includes.tinyeditor')
    <h2 class="page-header">About</h2>

    <div class="col-lg-12">
        {{-- {!! Form::open(['method'=>'Post', 'action'=>'HomeController@updateHome']) !!}--}}
        <form method="post" action="{{url('update_menu')}}">
            {{ csrf_field() }}
            {!! Form::hidden('id', $home->id) !!}

            <div class="form-group">
                {!! Form::label('name', 'Main Title:') !!}
                {!! Form::text('name', $home->name, ['class'=>'form-control', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Description:') !!}
                {!! Form::textarea('description', $home->description, ['class'=>'form-control', 'required' => 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Save Changes', ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        </form>
        {{-- {!! Form::close() !!}--}}

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
        @foreach($home->attributes as $item)
            {{--{!! Form::model($home,['method'=>'Patch', 'action'=>['HomeController@updateHomeAttr', $home->id]]) !!}--}}

            <form method="post" action="{{url('update_attribute')}}">
                {{ csrf_field() }}
                {!! Form::hidden('id', $item->id) !!}
                <div class="form-group">

                    {!! Form::label('title', 'Body Title:') !!}
                    {!! Form::text('title', $item->title, ['class'=>'form-control', 'required' => 'required']) !!}

                </div>
                <div class="form-group">

                    {!! Form::label('details', 'Description:') !!}
                    {!! Form::textarea('details', $item->details, ['class'=>'form-control', 'required' => 'required']) !!}

                </div>

                <div class="form-group">
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-primary pull-right']) !!}
                </div>
                <br>
            </form>
            <br>
            {{--{!! Form::close() !!}--}}
        @endforeach
    </div>

@endsection
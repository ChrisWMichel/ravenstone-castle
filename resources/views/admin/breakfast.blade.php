@extends('layouts.admin_layout')

@section('css')

@endsection

@section('content')
    @include('includes.tinyeditor')
    <h2 class="page-header">Bed & Breakfast</h2>

    @include('flash::message')
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#header" aria-controls="header" role="tab" data-toggle="tab">Header</a></li>
        <li role="presentation"><a href="#rooms" aria-controls="rooms" role="tab" data-toggle="tab">Rooms</a></li>
        <li role="presentation"><a href="#extras" aria-controls="extras" role="tab" data-toggle="tab">Extras</a></li>

    </ul>
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
    <div class="col-lg-10">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="header">

                <form method="post" action="{{url('update_menu')}}">
                    {{ csrf_field() }}
                    {!! Form::hidden('id', $header->id) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Main Title:') !!}
                        {!! Form::text('name', $header->name, ['class'=>'form-control', 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description:') !!}
                        {!! Form::textarea('description', $header->description, ['class'=>'form-control', 'required' => 'required', 'rows' => 12]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Save Changes', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </form>

            </div>
            <div role="tabpanel" class="tab-pane" id="rooms">
                <p><a href="#" class="show-deleteBtn">Show delete button</a> </p>
                @foreach($rooms as $room)
                    <form method="post" action="{{url('update_room')}}">
                        {{ csrf_field() }}
                        {!! Form::hidden('id', $room->id) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Main Title:') !!}
                            {!! Form::text('name', $room->name, ['class'=>'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description:') !!}
                            {!! Form::textarea('description', $room->description, ['class'=>'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Price:') !!}
                            {!! Form::text('price', $room->price, ['required' => 'required']) !!}

                            <a href="{{route('delete_room', $room->id)}}" class="btn btn-danger pull-right deleteBtn">Delete</a>

                            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary pull-right bottom-padding']) !!}
                            &nbsp;
                        </div>
                    </form>
                    <br>
                @endforeach
                <h3><a href="#" id="new-room"> Create New Room</a></h3>
                    <div class="create-room">
                        {{--<form method="post" action="{{url('create_room')}}" novalidate>--}}
                        {!! Form::open(['method'=>'Post', 'action'=>'RoomController@createRoom', 'novalidate']) !!}
                            {{ csrf_field() }}

                            <div class="form-group">
                                {!! Form::label('name', 'Main Title:') !!}
                                {!! Form::text('name', null, ['class'=>'form-control', 'required' => 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description:') !!}
                                {!! Form::textarea('description', null, ['class'=>'form-control', 'required' => 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('price', 'Price:') !!}
                                {!! Form::text('price', null, ['required' => 'required']) !!}

                                {!! Form::submit('Create Room', ['class' => 'btn btn-primary pull-right bottom-padding']) !!}
                            </div>
                        {{--</form>--}}
                        <br>
                    </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="extras">
                <p><a href="#" class="show-deleteBtn">Show delete button</a> </p>
                @foreach($extras as $extra)
                    <form method="post" action="{{url('update_extras')}}">
                        {{ csrf_field() }}
                        {!! Form::hidden('id', $extra->id) !!}

                        <div class="form-group">
                            {!! Form::label('title', 'Main Title:') !!}
                            {!! Form::text('title', $extra->title, ['class'=>'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('details', 'Details:') !!}
                            {!! Form::textarea('details', $extra->details, ['class'=>'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Price:') !!}
                            {!! Form::text('price', $extra->price, ['required' => 'required']) !!}
                            <a href="{{route('delete_extra', $extra->id)}}" class="btn btn-danger pull-right deleteBtn">Delete</a>
                            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary pull-right']) !!}
                        </div>
                    </form>
                    <br>
                @endforeach
                    <h3><a href="#" id="new-extra"> Add a new Extra</a></h3>
                    <div class="create-extra">
                        {!! Form::open(['method'=>'Post', 'action'=>'RoomExtraController@addExtras', 'novalidate']) !!}
                        {{ csrf_field() }}

                        <div class="form-group">
                            {!! Form::label('title', 'Main Title:') !!}
                            {!! Form::text('title', null, ['class'=>'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('details', 'Details:') !!}
                            {!! Form::textarea('details', null, ['class'=>'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Price:') !!}
                            {!! Form::text('price', null, ['required' => 'required']) !!}

                            {!! Form::submit('Create Room', ['class' => 'btn btn-primary pull-right bottom-padding']) !!}
                        </div>
                        <br>
                    </div>
            </div>

        </div>
    </div>


@endsection

@section('scripts')
    <script>
        $('.create-room').hide();
        $('.create-extra').hide();
        $('.deleteBtn').hide();

        $('#new-room').click(function (e) {
            $('.create-room').toggle('show');
            e.preventDefault();
        });
        $('#new-extra').click(function (e) {
            $('.create-extra').toggle('show');
            e.preventDefault();
        });
        $('.show-deleteBtn').click(function (e) {
          $('.deleteBtn').toggle('show');

            ($(".show-deleteBtn").text() === "Show delete button") ? $(".show-deleteBtn").text("Hide delete button") : $(".show-deleteBtn").text("Show delete button");
            e.preventDefault();
        })
    </script>
@endsection
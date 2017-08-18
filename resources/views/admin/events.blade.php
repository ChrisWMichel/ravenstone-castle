@extends('layouts.admin_layout')

@section('css')

@endsection

@section('content')
    @include('includes.tinyeditor')
    <h2 class="page-header">Events</h2>
    <a href="#" class="show-deleteBtn">Show delete button</a>

    <div class="row">
        <div class="col-lg-8">
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

        </div>
        <div class="col-lg-4">
            <h3>Grey Box</h3>
            <form method="post" action="{{url('update_box')}}">
                {{ csrf_field() }}
                {!! Form::hidden('id', $grayBox->id) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    {!! Form::text('title', $grayBox->title, ['class'=>'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('body', 'Body:') !!}
                    {!! Form::textarea('body', $grayBox->body, ['class'=>'form-control', 'required' => 'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-primary pull-right']) !!}
                </div>
            </form>
        </div>
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

            <form method="post" action="{{url('update_event')}}">
                {{ csrf_field() }}
                {!! Form::hidden('id', $item->id) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Body Title:') !!}
                    {!! Form::text('title', $item->title, ['class'=>'form-control', 'required' => 'required']) !!}
                </div>
                @foreach($item->eventDates as $date)
                    <div class="form-group">
                        {!! Form::label('word_date', 'Type the date and time here:') !!}
                        {!! Form::text('word_date', $date->word_date, ['class'=>'form-control', 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('start_date', 'Start:') !!}
                        {!! Form::text('start_date', $date->start_date, ['id'=> "start$date->id", 'class' => 'datepicker', 'required' => 'required']) !!}&nbsp;
                        {!! Form::label('end_date', 'End:') !!}
                        {!! Form::text('end_date', $date->end_date, ['id'=> "end$date->id", 'class' => 'datepicker', 'required' => 'required']) !!}
                        {!! Form::hidden('id_dates', $date->id) !!}
                    </div>
                @endforeach
                <div class="form-group">

                    {!! Form::label('details', 'Description:') !!}
                    {!! Form::textarea('details', $item->details, ['class'=>'form-control', 'required' => 'required']) !!}

                </div>

                <div class="form-group">
                    <a href="{{route('delete_event', $item->id)}}" class="btn btn-danger pull-right deleteBtn">Delete</a>
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-primary pull-right']) !!}
                </div>
                <br>
            </form>
            <br>
            {{--{!! Form::close() !!}--}}
        @endforeach

            <h3><a href="#" id="new-event">Create New Event</a></h3>

            <div class="create_event">
                {!! Form::open(['method'=>'post', 'action'=>'EventDateController@createEvent', 'novalidate']) !!}
                    {{ csrf_field() }}

                    <div class="form-group">
                        {!! Form::label('title', 'Body Title:') !!}
                        {!! Form::text('title', null, ['class'=>'form-control', 'required' => 'required']) !!}
                    </div>

                        <div class="form-group">
                            {!! Form::label('word_date', 'Type the date and time here:') !!}
                            {!! Form::text('word_date', null, ['class'=>'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('start_date', 'Start:') !!}
                            {!! Form::text('start_date', null, ['id'=> 'start_date', 'class' => 'datepicker', 'required' => 'required']) !!}&nbsp;
                            {!! Form::label('end_date', 'End:') !!}
                            {!! Form::text('end_date', null, ['id'=> 'end_date', 'class' => 'datepicker', 'required' => 'required']) !!}

                        </div>

                    <div class="form-group">

                        {!! Form::label('details', 'Description:') !!}
                        {!! Form::textarea('details', null, ['class'=>'form-control', 'required' => 'required']) !!}

                    </div>

                    <div class="form-group">
                        {!! Form::submit('Save Changes', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                    <br>
                {!! Form::close() !!}
            </div>
    </div>

@endsection

@section('scripts')
    <script>

            $('input').click(function(){
                if($(this).hasClass('datepicker')){
                    let id = $(this).attr('id');
                    $('#' + id).datepicker().focus();
                }
            });


        $('.create_event').hide();
        $('.deleteBtn').hide();

        $('#new-event').click(function (e) {
            $('.create_event').toggle('show');
            e.preventDefault();
        });

        $('.show-deleteBtn').click(function () {
            $('.deleteBtn').toggle('show');

            ($(".show-deleteBtn").text() === "Show delete button") ? $(".show-deleteBtn").text("Hide delete button") : $(".show-deleteBtn").text("Show delete button");
        });
    </script>
@endsection
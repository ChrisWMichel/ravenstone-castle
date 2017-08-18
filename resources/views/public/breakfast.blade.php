
<h1>{{$page->name}}</h1>

{!! $page->description !!}

<hr>

<div class="col-lg-8">

    @foreach($rooms as $room)

        <h3 class="bold_font no_bottom_padding">{{$room->name}}</h3>
       {!! $room->description !!}


        <p>{{$room->price}}</p>
        <br>

    @endforeach
</div>

<div class="col-sm-4 graybkg">
   @foreach($extras as $extra)
       <h4 class="bold_font no_bottom_padding">{{$extra->title}}</h4>
       {!! $extra->details !!}
       <p>${{$extra->price}}</p>
   @endforeach
</div>
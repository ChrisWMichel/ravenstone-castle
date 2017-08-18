
<h1>{{$page->name}}</h1>

<p>{!! $page->description  !!}

<hr>

<div class="col-lg-8">

    @foreach($attributes as $attribute)

        <h3 class="bold_font">{{$attribute->title}}</h3>

        {!! $attribute->details !!}

    @endforeach
</div>

<div class="col-sm-4 graybkg">
    @if($page->id_name == 'home')

        <h3>Event Calander</h3>

        @foreach($event_details as $detail)

            <h4 class="bold_font no_bottom_padding">{{$detail->title}}</h4>
        @foreach($detail->eventDates as $date)
            <p>{{$date->word_date}}</p>
        @endforeach
            <br>
        @endforeach
    @endif

    @if(!empty($gray_box))

        <h4>{{$gray_box->title}}</h4>
        <p>{!! $gray_box->body !!}</p>

    @endif
</div>
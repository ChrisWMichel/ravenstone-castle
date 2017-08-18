
<h1>{{$page->name}}</h1>

<p>{{$page->description}}</p>

<hr>

<div class="col-lg-8">

    @foreach($event_details as $detail)

        <h4>{{$detail->title}}</h4>
        @foreach($detail->eventDates as $date)
            <p>{{$date->word_date}}</p>
        @endforeach


        {!! $detail->details !!}
        <br>

    @endforeach
</div>

<div class="col-sm-4 graybkg">
    @if(!empty($gray_box))

        <h4>{{$gray_box->title}}</h4>
        {!! $gray_box->body !!}

    @endif
</div>
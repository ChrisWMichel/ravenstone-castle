<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\EventDate;
use Illuminate\Http\Request;

class EventDateController extends Controller
{
    public function updateEvent(Request $request){
        $this->validate($request, [
          'title' => 'required',
          'details' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'word_date' => 'required',
        ]);

        $home = Attribute::find($request->id);

        $home->update([
          'title' => $request->title,
          'details' => $request->details
        ]);

        $event = EventDate::find($request->id_dates);
        $event->update([
          'start_date' => $request->start_date,
          'end_date' => $request->end_date,
          'word_date' => $request->word_date,
        ]);

        flash('Update was successfull!')->success();

        return redirect()->back();
    }

    public function createEvent(Request $request){
        $this->validate($request, [
          'title' => 'required',
          'details' => 'required',
          'start_date' => 'required',
          'end_date' => 'required',
          'word_date' => 'required',
        ]);

        $home = Attribute::create([
          'menu_id' => 5,
          'title' => $request->title,
          'details' => $request->details
        ]);

        EventDate::create([
          'attribute_id' => $home->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'word_date' => $request->word_date
        ]);

        flash('Event was successfully created.')->success();

        return redirect()->back();
    }

    public function destroy($id){
        $event = Attribute::find($id);

        EventDate::where('attribute_id', $event->id )->delete();

        $event->delete();

        flash('Event was successfully deleted.')->success();

        return redirect()->back();
    }
}

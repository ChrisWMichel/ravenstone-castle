<?php

namespace App\Http\Controllers;

use App\RoomExtra;
use Illuminate\Http\Request;

class RoomExtraController extends Controller
{
    public function updateExtras(Request $request){
        $this->validate($request, [
          'title' => 'required',
          'details' => 'required',
            'price' => 'required'
        ]);

        $extra = RoomExtra::find($request->id);

        $extra->update([
          'title' => $request->title,
          'details' => $request->details,
            'price' => $request->price
        ]);
        flash('Update was successfull!')->success();

        return redirect()->back();
    }

    public function addExtras(Request $request){
        $this->validate($request, [
          'title' => 'required',
          'details' => 'required',
          'price' => 'required'
        ]);

        RoomExtra::create($request->all());

        flash('Created extras was successfull!')->success();

        return redirect()->back();
    }

    public function destroy($id){
        RoomExtra::find($id)->delete();

        flash('Deleted extra successfully!')->success();

        return redirect()->back();
    }
}

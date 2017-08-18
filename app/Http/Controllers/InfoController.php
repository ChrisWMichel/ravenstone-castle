<?php

namespace App\Http\Controllers;

use App\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function updateInfo(Request $request){
        $this->validate($request, [
          'name' => 'required',
          'address' => 'required',
          'city' => 'required',
          'state' => 'required',
          'zipcode' => 'required',
        ]);

        $info = Info::find($request->id);

        $info->update([
          'name' => $request->name,
          'address' => $request->address,
          'city' => $request->city,
          'state' => $request->state,
          'zipcode' => $request->zipcode,
        ]);

        flash('Update was successfull!')->success();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function updateAttribute(Request $request){
        $this->validate($request, [
          'title' => 'required',
          'details' => 'required'
        ]);

        $home = Attribute::find($request->id);

        $home->update([
          'title' => $request->title,
          'details' => $request->details
        ]);
        flash('Update was successfull!')->success();

        return redirect()->back();
    }
}

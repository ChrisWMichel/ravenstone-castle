<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function updateMenu(Request $request){

        $this->validate($request, [
          'name' => 'required',
          'description' => 'required'
        ]);

        $home = Menu::find($request->id);

        $home->update([
          'name' => $request->name,
          'description' => $request->description
        ]);
        flash('Update was successfull!')->success();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\GrayBox;
use App\Info;
use App\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if($id == 'events'){
            $home = Menu::where('id_name', $id)->with('attributes')->first();
            $grayBox = GrayBox::where('menu_id', '=', $home->id)->first();

            return view('admin.'. $id, compact('home', 'grayBox'));
        }
        if($id == 'contact'){
            $home = Menu::where('id_name', $id)->with('attributes')->first();
            $info = Info::all()->first();

            return view('admin.'. $id, compact('home', 'info'));
        }


        $home = Menu::where('id_name', $id)->with('attributes')->first();
        $grayBox = GrayBox::where('menu_id', $home->id)->first();

        return view('admin.'. $id, compact('home', 'grayBox'));
    }

    public function updateBox(Request $request){
        $box = GrayBox::find($request->id);

        $box->update([
          'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->back();
    }

}

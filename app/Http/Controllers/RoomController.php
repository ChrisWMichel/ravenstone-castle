<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Room;
use App\RoomExtra;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(){

        $header = Menu::where('id_name', 'breakfast')->first();
        $rooms = Room::all();
        $extras = RoomExtra::all();

        return view('admin.breakfast', compact('header', 'rooms', 'extras'));
    }

    public function updateRoom(Request $request){
        $this->validate($request, [
          'name' => 'required',
          'description' => 'required',
          'price' => 'required'
        ]);

        $room = Room::find($request->id);

        $room->update([
          'name' => $request->name,
          'description' => $request->description,
          'price' => $request->price
        ]);

        flash('Update was successfull!')->success();

        return redirect()->back();
    }

    public function createRoom(Room $room, Request $request){
        $this->validate($request, [
          'name' => 'required',
          'description' => 'required',
          'price' => 'required'
        ]);

        $room->create([
          'name' => $request->name,
          'description' => $request->description,
          'price' => $request->price
        ]);

        $rooms = Room::all();

        return redirect()->back()->with(compact('rooms'));
    }

    public function destroy($id){
        Room::find($id)->delete();
        flash('Room was deleted successfully!')->success();
        return redirect()->back();
    }
}

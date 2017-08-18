<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\GrayBox;
use App\HeaderPhoto;
use App\Info;
use App\Mail\ContactPage;
use App\Menu;
use App\Phone;
use App\Room;
use App\RoomExtra;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller {

    public function index() {

        $phone = Phone::select('phone')->first();
        $photos = HeaderPhoto::all();

        return view('layouts.public_layout', compact('phone', 'photos'));
    }

    public function getPages(Request $request) {


        switch ($request->id) {
            case 'breakfast':
                $page = Menu::where('id_name', '=', 'breakfast')->first();
                $rooms = Room::all();
                $extras = RoomExtra::all();

                return view(
                  'public.breakfast',
                  compact('page', 'rooms', 'extras')
                );
                break;
            case 'events':
                $page = Menu::where('id_name', '=', 'events')->first();
                $event_details = Attribute::where('menu_id', '=', $page->id)->get();
                $gray_box = GrayBox::where('menu_id', '=', $page->id)->first();

                return view(
                  'public.events',
                  compact('page', 'gray_box', 'event_details')
                );

                break;
            case 'contact':
                $page = Menu::where('id_name', '=', $request->id)->first();
                $attributes = Attribute::where('menu_id', '=', $page->id)->get(
                );
                $info = Info::all()->first();
                $phones = Phone::all();

                return view(
                  'public.contact',
                  compact('page', 'attributes', 'info', 'phones')
                );
                break;
            case 'home':
                $page = Menu::where('id_name', '=', $request->id)->first();
                $attributes = Attribute::where('menu_id', '=', $page->id)->get(
                );
                $event = Menu::where('id_name', '=', 'events')->first();
                $event_details = Attribute::where('menu_id', '=', $event->id)
                  ->get();

                return view(
                  'public.index',
                  compact('page', 'attributes', 'event_details')
                );
                break;
            default:
                $page = Menu::where('id_name', '=', $request->id)->first();
                $attributes = Attribute::where('menu_id', '=', $page->id)->get(
                );
                $gray_box = GrayBox::where('menu_id', '=', $page->id)->first();

                return view(
                  'public.index',
                  compact('page', 'attributes', 'gray_box')
                );
        }

    }

    public function contact(Request $request) {

        $rules = [
          'firstname' => 'required|min:2',
          'email' => 'required|email',
          'subject' => 'required',
          'message' => 'required|min:8'
        ];

        $validator = $this->validate($request, $rules);

        if (!empty($validator)) {
            return response()->json(['errors' => $validator->errors()->all()]);

        }
        else {
            $contact = [
              'firstname' => $request->input('firstname'),
              'email' => $request->input('email'),
              'subject' => $request->input('subject'),
              'message' => $request->input('message'),
              'date' => Carbon::now()->toFormattedDateString()
            ];

            Mail::send(new ContactPage($contact));

            return response()->json(['firstname' => $request->firstname]);

        }


    }
}
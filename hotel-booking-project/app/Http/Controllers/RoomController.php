<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();

        return view('roomCRUD.rooms_index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roomCRUD.add_room');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'room_type' => 'string|max:255|required',
            'photo' => 'required|image',
            'room_number' => 'integer|required',
            'oppervlakte' => 'required|numeric',
            'people_it_comports' => 'required|integer',
            'price' => 'required|numeric'
        ]);

        unset($data['photo']);

        $room = new Room($data);
        $room->has_minibar = $request->has('has_minibar');
        $room->has_bath = $request->has('has_bath');

        if ($request->has('photo')) {
            $image = $request->file('photo');
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('public', $imageName);

            if (!$path) {
                return back()->withErrors(['file' => 'There was some error while saving the photo file']);
            }
        }

        $room->photo_path = str_replace('public', 'storage', $path);

        if (!$room->save()) {
            return back()->withErrors(['database' => 'There was some error while saving in the database']);
        }

        return redirect()->to(route('rooms.show', ['room' => $room->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        $bookings = Booking::where('room_id', $room->id)
            ->where(function ($query) {
                $query->whereDate('arrival_date', '>=', Carbon::now()->toDateString())
                    ->orWhere(function ($query) {
                        $query->whereDate('departure', '>=', Carbon::now()->toDateString());
                    });
            })
            ->get();

        return view('roomCRUD.room_details', compact('room', 'bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('roomCRUD.room_update', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'room_type' => 'string|max:255',
            'photo' => 'image',
            'room_number' => 'integer',
            'oppervlakte' => 'numeric',
            'people_it_comports' => 'integer',
            'price' => 'numeric'
        ]);

        $data['has_minibar'] = $request->has('has_minibar');
        $data['has_bath'] = $request->has('has_bath');
        unset($data['photo']);

        if ($request->has('photo')) {
            $image = $request->file('photo');
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('public', $imageName);

            if (!$path) {
                return back()->withErrors(['file' => 'There was some error while saving the photo file']);
            }

            if (!Storage::delete(str_replace('storage', 'public', $room->photo_path))) {
                return back()->withErrors(['file' => 'There was some error while deleting the photo file']);
            }

            $data['photo_path'] = str_replace('public', 'storage', $path);
        }

        $update = Room::whereId($room->id)->update($data);

        if (!$update) {
            return back()->withErrors(['database' => 'There was some error while saving in the database']);
        }

        return redirect()->to(route('rooms.show', ['room' => $room->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        if (!$room->delete()) {
            return back()->withErrors(['database' => 'There was some error while deleting from the database']);
        }
        return redirect()->to(route('rooms.index'))->with('ROOM_DELETED', true);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientEmail = $request->session()->get('client_email');
        if (!$clientEmail) $clientEmail = '';
        $bookingModels = Booking::where('email', $clientEmail)->get();

        return view('bookingCRUD.booking_index', ['bookings' => $bookingModels]);
    }

    public function setClientEmail(Request $request)
    {
        $request->validate(['email' => 'email']);
        $request->session()->put('client_email', $request->email);

        return redirect()->to(route('bookings.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Room $room)
    {
        return view('bookingCRUD.booking_create', ['room_id' => $room->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Room $room, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'credit_card_number' => 'required|string|max:255',
            'arrival_date' => 'required|date|after:now',
            'departure' => 'required|date|after:arrival_date',
            'email' => 'required|email'
        ]);

        $data['room_id'] = $room->id;

        if ($this->isBookingClashing($data)) {
            return back()->withErrors('booking clashing with another client booking');
        }

        $booking = Booking::create($data);

        if (!$booking) {
            return back()->withErrors('there as a error while booking the room');
        }

        $request->session()->put('client_email', $data['email']);

        return redirect()->to(route('bookings.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room, Booking $booking)
    {
        return view('bookingCRUD.booking_edit', ['booking' => $booking, 'room_id' => $room->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room, Booking $booking)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'credit_card_number' => 'required|string|max:255',
            'arrival_date' => 'required|date|after:now',
            'departure' => 'required|date|after:arrival_date',
        ]);

        $data['room_id'] = $room->id;
        if ($this->isBookingClashing($data, $booking)) {
            return back()->withErrors('booking clashing with another client booking');
        }

        $update = Booking::whereId($booking->id)->update($data);

        if (!$update) {
            return back()->withErrors('there as a error while updating the booking');
        }

        return redirect()->to(route('bookings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room, Booking $booking)
    {
        if (!$booking->delete()) {
            return back()->withErrors('there as a error while deleting the booking');
        }

        return back()->with('BOOKING_DELETED', true);
    }

    private function isBookingClashing(array $data, Booking $booking =  null): bool
    {
        $clashingBookings = Booking::where('room_id', $data['room_id'])
            ->where(function ($query) use ($data) {
                $query->whereDate('arrival_date', '<=', $data['arrival_date'])
                    ->whereDate('departure', '>=', $data['arrival_date']);
            })
            ->orWhere(function ($query) use ($data) {
                $query->whereDate('arrival_date', '<=', $data['departure'])
                    ->whereDate('departure', '>=', $data['departure']);
            })
            ->get();

        if ($clashingBookings) {
            foreach ($clashingBookings as $clashingBooking) {
                if (!$booking || $clashingBooking->id !== $booking->id)
                    return true;
            }
        }

        return false;
    }
}

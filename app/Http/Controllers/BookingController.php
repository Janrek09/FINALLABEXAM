<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingCreated;
use Illuminate\Http\Request;
use Carbon\Carbon;
// ✅ Add this line
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingController extends Controller
{
    // ✅ Add this trait to enable authorize() method
    use AuthorizesRequests;

    public function index()
    {
        $bookings = auth()->user()->bookings()->orderBy('booking_date', 'desc')->get();
        $totalBookings = $bookings->count();
        $upcomingBookings = $bookings->where('booking_date', '>=', now())->count();
        $pastBookings = $bookings->where('booking_date', '<', now())->count();

        return view('bookings.index', compact('bookings', 'totalBookings', 'upcomingBookings', 'pastBookings'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'required',
            'description' => 'nullable|string',
        ]);

        $bookingDateTime = $request->booking_date . ' ' . $request->booking_time . ':00';

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'booking_date' => $bookingDateTime,
        ]);

        $request->user()->notify(new BookingCreated($booking));

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $request->validate([
            'title' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'description' => 'nullable|string',
        ]);

        $bookingDateTime = $request->booking_date . ' ' . $request->booking_time . ':00';

        $booking->update([
            'title' => $request->title,
            'description' => $request->description,
            'booking_date' => $bookingDateTime,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully!');
    }
}
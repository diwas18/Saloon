<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Branch;
use App\Models\Expert;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'branch', 'expert'])->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $users = User::all();
        $branches = Branch::all();
        $experts = Expert::all();
        $timeSlots = $this->generateTimeSlots('09:00', '18:00', 30); // 30-minute slots

        return view('bookings.create', compact('users', 'branches', 'experts', 'timeSlots'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
            'expert_id' => 'nullable|exists:experts,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
        ]);

        // Check if the slot is already booked
        $alreadyBooked = Booking::where('branch_id', $request->branch_id)
            ->where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->exists();

        if ($alreadyBooked) {
            return back()->withErrors(['booking_time' => 'This time slot is already booked.']);
        }

        // Create booking
        Booking::create([
            'user_id' => $request->user_id,
            'branch_id' => $request->branch_id,
            'expert_id' => $request->expert_id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'status' => 'pending',
        ]);

        return redirect()->route('welcome')->with('success', 'Booking created successfully.');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $users = User::all();
        $branches = Branch::all();
        $experts = Expert::all();
        $timeSlots = $this->generateTimeSlots('09:00', '18:00', 30);

        return view('bookings.edit', compact('booking', 'users', 'branches', 'experts', 'timeSlots'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Validate input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
            'expert_id' => 'nullable|exists:experts,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
        ]);

        // Check if the slot is already booked (excluding current booking)
        $alreadyBooked = Booking::where('branch_id', $request->branch_id)
            ->where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->where('id', '!=', $id)
            ->exists();

        if ($alreadyBooked) {
            return back()->withErrors(['booking_time' => 'This time slot is already booked.']);
        }

        // Update booking
        $booking->update([
            'user_id' => $request->user_id,
            'branch_id' => $request->branch_id,
            'expert_id' => $request->expert_id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'status' => $request->status,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }

    /**
     * Generate time slots between a given time range.
     */
    private function generateTimeSlots($start, $end, $interval)
    {
        $slots = [];
        $startTime = Carbon::parse($start);
        $endTime = Carbon::parse($end);

        while ($startTime < $endTime) {
            $slots[] = $startTime->format('H:i');
            $startTime->addMinutes($interval);
        }

        return $slots;
    }
}

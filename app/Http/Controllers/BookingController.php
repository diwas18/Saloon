<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Branch;
use App\Models\Service;
use App\Models\Expert;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['branch', 'expert'])->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $branches = Branch::all();
        $services = Service::all();
        $experts = Expert::all();
        $timeSlots = $this->generateTimeSlots('09:00', '18:00', 30); // 30-minute slots

        return view('bookings.create', compact('branches','services', 'experts', 'timeSlots'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateBooking($request);

        // Check if the time slot is already booked
        if ($this->isTimeSlotBooked($request->branch_id, $request->booking_date, $request->booking_time)) {
            return back()->withErrors(['booking_time' => 'This time slot is already booked.'])->withInput();
        }

        // Create the booking
        Booking::create($validatedData + ['status' => 'pending']);

        return redirect()->route('welcome')->with('success', 'Booking created successfully.');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $branches = Branch::all();
        $services = Service::all();
        $experts = Expert::all();
        $timeSlots = $this->generateTimeSlots('09:00', '18:00', 30);

        return view('bookings.edit', compact('booking', 'branches', 'services','experts', 'timeSlots'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $validatedData = $this->validateBooking($request, $id);

        // Check if the time slot is already booked (excluding the current booking)
        if ($this->isTimeSlotBooked($request->branch_id, $request->booking_date, $request->booking_time, $id)) {
            return back()->withErrors(['booking_time' => 'This time slot is already booked.'])->withInput();
        }

        // Update booking
        $booking->update($validatedData);

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

    /**
     * Validate booking input.
     */
    private function validateBooking(Request $request, $excludeId = null)
    {
        return $request->validate([
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'contact_number' => ['required', 'regex:/^(98|97)\d{8}$/'],
            'service_id' => ['required', 'exists:services,id'],
            'branch_id' => ['required', 'exists:branches,id'],
            'expert_id' => ['nullable', 'exists:experts,id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'booking_time' => ['required'],
        ], [
            'name.regex' => 'Name should contain only alphabets and spaces.',
            'email.email' => 'Please enter a valid email address.',
            'contact_number.regex' => 'Contact number must start with 98 or 97 and have exactly 10 digits.',
        ]);
    }

    /**
     * Check if the time slot is already booked.
     */
    private function isTimeSlotBooked($branchId, $date, $time, $excludeId = null)
    {
        return Booking::where('branch_id', $branchId)
            ->where('booking_date', $date)
            ->where('booking_time', $time)
            ->when($excludeId, fn($query) => $query->where('id', '!=', $excludeId))
            ->exists();
    }
}

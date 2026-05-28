<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Payment;
use App\Models\ActivityLog;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    public function create()
    {
        return view('parent.register-child');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'               => 'required|string|min:2|max:100|regex:/^[a-zA-Z\s]+$/',
            'age'                => 'required|integer|min:1|max:12',
            'gender'             => 'required|in:male,female',
            'photo'              => 'required|file|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'has_disability'     => 'required|in:0,1',
            'disability_details' => 'nullable|string|max:300',
            'has_allergy'        => 'required|in:0,1',
            'allergy_details'    => 'nullable|string|max:300',
            'checkin_time'       => 'required|date_format:H:i',
            'checkout_time'      => 'required|date_format:H:i|after:checkin_time',
        ], [
            'name.regex'          => 'Child name can only contain letters and spaces.',
            'checkout_time.after' => 'Check-out time must be after check-in time.',
        ]);

        $parent = Auth::guard('parent')->user();

        // Handle file upload securely
        $uploader = new FileUploadService();
        $photoPath = $uploader->validateAndStore($request->file('photo'), 'children');

        if (!$photoPath) {
            return back()->withErrors(['photo' => 'Invalid file type. Only images allowed.']);
        }

        $child = Child::create([
            'parent_id'          => $parent->id,
            'name'               => strip_tags(trim($request->name)),
            'age'                => (int) $request->age,
            'gender'             => $request->gender,
            'photo'              => $photoPath,
            'has_disability'     => (bool) $request->has_disability,
            'disability_details' => $request->has_disability ? strip_tags(trim($request->disability_details)) : null,
            'has_allergy'        => (bool) $request->has_allergy,
            'allergy_details'    => $request->has_allergy ? strip_tags(trim($request->allergy_details)) : null,
            'checkin_time'       => $request->checkin_time,
            'checkout_time'      => $request->checkout_time,
            'checkin_date'       => now()->toDateString(),
            'status'             => 'checked_in',
        ]);

        ActivityLog::create([
            'loggable_type' => 'Child',
            'loggable_id'   => $child->id,
            'action'        => 'child_registered',
            'description'   => "Child {$child->name} registered by {$parent->name}",
            'performed_by'  => $parent->name,
        ]);

        return redirect('/parent/payment/' . $child->id)
            ->with('success', 'Child registered successfully! Please complete payment.');
    }

    public function checkout(Request $request, $id)
    {
        $parent = Auth::guard('parent')->user();
        $child  = Child::where('id', $id)->where('parent_id', $parent->id)->firstOrFail();

        $paymentCompleted = Payment::where('child_id', $child->id)
            ->where('status', 'completed')
            ->exists();

        if (!$paymentCompleted) {
            return back()->with('error', 'Payment required before checking out ' . $child->name . '.');
        }

        $child->status        = 'checked_out';
        $child->checkout_time = now()->format('H:i:s');
        $child->checkout_date = now()->toDateString();
        $child->save();

        ActivityLog::create([
            'loggable_type' => 'Child',
            'loggable_id'   => $child->id,
            'action'        => 'parent_checkout',
            'description'   => "Child {$child->name} checked out by parent {$parent->name}",
            'performed_by'  => $parent->name,
        ]);

        return back()->with('success', $child->name . ' has been checked out successfully.');
    }
}
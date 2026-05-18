<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\ActivityLog;
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
            'name'               => 'required|min:2|max:100',
            'gender'             => 'required|in:male,female',
            'age'                => 'required|integer|min:1|max:12',
            'photo'              => 'required|image|mimes:jpg,jpeg,png|max:20480',
            'has_disability'     => 'required|in:0,1',
            'disability_details' => 'nullable|required_if:has_disability,1',
            'has_allergy'        => 'required|in:0,1',
            'allergy_details'    => 'nullable|required_if:has_allergy,1',
            'checkin_time'       => 'required',
            'checkout_time'      => 'required',
        ]);

        $parent    = Auth::guard('parent')->user();
        $photoPath = $request->file('photo')->store('children', 'public');
        $today     = now()->toDateString();

        $child = new Child();
        $child->parent_id          = $parent->id;
        $child->name               = $request->name;
        $child->gender             = $request->gender;
        $child->age                = $request->age;
        $child->photo              = $photoPath;
        $child->has_disability     = $request->has_disability;
        $child->disability_details = $request->disability_details;
        $child->has_allergy        = $request->has_allergy;
        $child->allergy_details    = $request->allergy_details;
        $child->checkin_time       = $request->checkin_time;
        $child->checkout_time      = $request->checkout_time;
        $child->checkin_date       = $today;
        $child->checkout_date      = null;
        $child->status             = 'checked_in';
        $child->save();

        ActivityLog::create([
            'loggable_type' => 'Child',
            'loggable_id'   => $child->id,
            'action'        => 'child_registered',
            'description'   => "Child {$child->name} registered and checked in by {$parent->name} on {$today}",
            'performed_by'  => $parent->name,
        ]);

        return redirect('/parent/payment/' . $child->id);
    }

    public function checkout($id)
    {
        $parent   = Auth::guard('parent')->user();
        $child    = Child::where('id', $id)
                        ->where('parent_id', $parent->id)
                        ->firstOrFail();
        $today    = now()->toDateString();
        $time     = now()->format('H:i:s');

        $child->status        = 'checked_out';
        $child->checkout_time = $time;
        $child->checkout_date = $today;
        $child->save();

        ActivityLog::create([
            'loggable_type' => 'Child',
            'loggable_id'   => $child->id,
            'action'        => 'checked_out',
            'description'   => "Child {$child->name} checked out by parent at {$time} on {$today}",
            'performed_by'  => $parent->name,
        ]);

        return redirect('/parent/dashboard')->with('success', "{$child->name} has been checked out successfully.");
    }
}
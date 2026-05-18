<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Payment;
use App\Models\ParentGuardian;
use App\Models\ActivityLog;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $totalParents   = ParentGuardian::count();
        $totalChildren  = Child::count();
        $totalPayments  = Payment::where('status', 'completed')->sum('amount');
        $checkedIn      = Child::whereDate('checkin_date', today())->count();
        $currentlyIn    = Child::where('status', 'checked_in')
                            ->whereDate('checkin_date', today())
                            ->count();
        $checkedOut     = Child::where('status', 'checked_out')
                            ->whereDate('checkout_date', today())
                            ->count();
        $recentParents  = ParentGuardian::latest()->take(5)->get();
        $recentPayments = Payment::with(['parent', 'child'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalParents', 'totalChildren',
            'totalPayments', 'checkedIn',
            'currentlyIn', 'checkedOut',
            'recentParents', 'recentPayments'
        ));
    }

    public function parents()
    {
        $parents = ParentGuardian::withCount('children')->latest()->get();
        return view('admin.parents', compact('parents'));
    }

    public function viewParent($id)
    {
        $parent = ParentGuardian::with(['children', 'payments'])->findOrFail($id);
        return view('admin.view-parent', compact('parent'));
    }

    public function toggleBlock($id)
    {
        $parent = ParentGuardian::findOrFail($id);
        $parent->status = $parent->status === 'active' ? 'blocked' : 'active';
        $parent->save();

        ActivityLog::create([
            'loggable_type' => 'ParentGuardian',
            'loggable_id'   => $parent->id,
            'action'        => $parent->status === 'blocked' ? 'blocked' : 'unblocked',
            'description'   => "Parent {$parent->name} was {$parent->status}",
            'performed_by'  => Auth::user()->name,
        ]);

        return back()->with('success', "Parent {$parent->name} has been {$parent->status}.");
    }

    public function deleteParent($id)
    {
        $parent = ParentGuardian::findOrFail($id);
        $name   = $parent->name;
        $parent->delete();

        ActivityLog::create([
            'loggable_type' => 'ParentGuardian',
            'loggable_id'   => $id,
            'action'        => 'deleted',
            'description'   => "Parent {$name} was deleted",
            'performed_by'  => Auth::user()->name,
        ]);

        return redirect('/admin/parents')->with('success', "Parent {$name} deleted.");
    }

    public function editParent($id)
    {
        $parent = ParentGuardian::findOrFail($id);
        return view('admin.edit-parent', compact('parent'));
    }

    public function updateParent(Request $request, $id)
    {
        $parent = ParentGuardian::findOrFail($id);
        $request->validate([
            'name'      => 'required|min:2|max:100',
            'email'     => 'required|email|unique:parents,email,' . $id,
            'phone'     => 'required|unique:parents,phone,' . $id,
            'id_number' => 'required|unique:parents,id_number,' . $id,
        ]);

        $parent->update($request->only('name', 'email', 'phone', 'id_number'));

        ActivityLog::create([
            'loggable_type' => 'ParentGuardian',
            'loggable_id'   => $parent->id,
            'action'        => 'updated',
            'description'   => "Parent {$parent->name} details updated",
            'performed_by'  => Auth::user()->name,
        ]);

        return redirect('/admin/parents')->with('success', 'Parent updated successfully.');
    }

    public function children()
    {
        $children = Child::with('parent')->latest()->get();
        return view('admin.children', compact('children'));
    }

    public function checkIn($id)
    {
        $child = Child::findOrFail($id);
        $child->status       = 'checked_in';
        $child->checkin_time = now()->format('H:i:s');
        $child->checkin_date = now()->toDateString();
        $child->checkout_date = null;
        $child->save();

        ActivityLog::create([
            'loggable_type' => 'Child',
            'loggable_id'   => $child->id,
            'action'        => 'checked_in',
            'description'   => "Child {$child->name} checked in at " . now()->format('H:i'),
            'performed_by'  => Auth::user()->name,
        ]);

        return back()->with('success', "{$child->name} checked in successfully.");
    }

    public function checkOut($id)
    {
        $child = Child::findOrFail($id);
        $child->status        = 'checked_out';
        $child->checkout_time = now()->format('H:i:s');
        $child->checkout_date = now()->toDateString();
        $child->save();

        ActivityLog::create([
            'loggable_type' => 'Child',
            'loggable_id'   => $child->id,
            'action'        => 'checked_out',
            'description'   => "Child {$child->name} checked out at " . now()->format('H:i'),
            'performed_by'  => Auth::user()->name,
        ]);

        return back()->with('success', "{$child->name} checked out successfully.");
    }

    public function payments()
    {
        $payments = Payment::with(['parent', 'child'])->latest()->get();
        return view('admin.payments', compact('payments'));
    }

    public function confirmPayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status  = 'completed';
        $payment->paid_at = now();
        $payment->save();

        ActivityLog::create([
            'loggable_type' => 'Payment',
            'loggable_id'   => $payment->id,
            'action'        => 'payment_confirmed',
            'description'   => "Payment of KSH {$payment->amount} confirmed",
            'performed_by'  => Auth::user()->name,
        ]);

        return back()->with('success', 'Payment confirmed successfully.');
    }

    public function settings()
    {
        $mpesaNumber = Setting::get('mpesa_number');
        $mpesaAmount = Setting::get('mpesa_amount');
        return view('admin.settings', compact('mpesaNumber', 'mpesaAmount'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'mpesa_number' => 'required|min:10|max:13',
            'mpesa_amount' => 'required|numeric|min:1',
        ]);

        Setting::set('mpesa_number', $request->mpesa_number);
        Setting::set('mpesa_amount', $request->mpesa_amount);

        ActivityLog::create([
            'loggable_type' => 'Setting',
            'loggable_id'   => 1,
            'action'        => 'settings_updated',
            'description'   => "M-Pesa settings updated",
            'performed_by'  => Auth::user()->name,
        ]);

        return back()->with('success', 'Settings updated successfully.');
    }

    public function activityLogs()
    {
        $logs = ActivityLog::latest()->paginate(20);
        return view('admin.activity-logs', compact('logs'));
    }
}
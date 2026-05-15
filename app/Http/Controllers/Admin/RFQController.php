<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Domains\RFQ\Models\RFQ;
use App\Domains\RFQ\Models\RFQStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RFQController extends Controller
{
    public function index(Request $request)
    {
        $query = RFQ::with(['status', 'assignedTo', 'items']);

        if ($request->status) {
            $query->where('status_id', $request->status);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('customer_name', 'like', "%{$request->search}%")
                  ->orWhere('company_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        $rfqs = $query->latest()->paginate(10);
        $statuses = RFQStatus::orderBy('sort_order')->get();

        return view('admin.rfqs.index', compact('rfqs', 'statuses'));
    }

    public function show(RFQ $rfq)
    {
        $rfq->load(['items.product', 'status', 'assignedTo', 'notes.user', 'activityLogs.user']);
        $statuses = RFQStatus::orderBy('sort_order')->get();
        $salesManagers = User::role('Sales Manager')->get(); // Assuming Spatie role
        
        return view('admin.rfqs.show', compact('rfq', 'statuses', 'salesManagers'));
    }

    public function updateStatus(Request $request, RFQ $rfq)
    {
        $request->validate(['status_id' => 'required|exists:rfq_statuses,id']);
        
        $oldStatus = $rfq->status->name;
        $rfq->update(['status_id' => $request->status_id]);
        $newStatus = RFQStatus::find($request->status_id)->name;

        $rfq->activityLogs()->create([
            'user_id' => Auth::id(),
            'action' => 'status_changed',
            'description' => "Changed status from {$oldStatus} to {$newStatus}"
        ]);

        return back()->with('success', 'RFQ status updated');
    }

    public function assign(Request $request, RFQ $rfq)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        
        $rfq->update(['assigned_to' => $request->user_id]);
        $user = User::find($request->user_id);

        $rfq->activityLogs()->create([
            'user_id' => Auth::id(),
            'action' => 'assigned',
            'description' => "Assigned RFQ to {$user->name}"
        ]);

        return back()->with('success', 'RFQ assigned to sales manager');
    }

    public function addNote(Request $request, RFQ $rfq)
    {
        $request->validate(['content' => 'required|string']);

        $rfq->notes()->create([
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);

        $rfq->activityLogs()->create([
            'user_id' => Auth::id(),
            'action' => 'note_added',
            'description' => "Added an internal note"
        ]);

        return back()->with('success', 'Internal note added');
    }
}

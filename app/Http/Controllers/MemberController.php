<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Contact; 
use Illuminate\Support\Facades\Log; 
use App\Mail\ResetPasswordMail; // Assuming you have this Mail class
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\MemberController;


class MemberController extends Controller
{ 

// View all members
public function viewMembers()
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $members = User::all();
    return view('backend.admin.view-members', compact('members'));
}

// View a single member's details
public function viewMember($id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $member = User::findOrFail($id);
    return view('backend.admin.view-member', compact('member'));
}

// Download a member's details as a PDF
public function downloadMember($id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $member = User::findOrFail($id);
    $pdf = Pdf::loadView('backend.admin.member-pdf', compact('member'));
    return $pdf->download("member_{$member->id}.pdf");
}

// Reset a member's password
public function resetPassword(Request $request, $id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $user = User::findOrFail($id);

    $newPassword = Str::random(10);
    $user->password = Hash::make($newPassword);
    $user->save();

    Mail::to($user->email)->send(new \App\Mail\ResetPasswordMail($user, $newPassword));

    return redirect()->back()->with('success', 'Password reset successfully. New password sent to user\'s email.');
}

// Send a message to a member
public function sendMessage(Request $request, $id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $member = User::findOrFail($id);

    $request->validate([
        'message' => 'required|string',
    ]);

    // Assuming Notification or Mail system for message sending
    // \Notification::send($member, new MemberMessageNotification($request->message));

    return redirect()->back()->with('success', 'Message sent successfully.');
}

// Update member's status (active/inactive toggle)
public function updateStatus($id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $member = User::findOrFail($id);
    $member->status = !$member->status;
    $member->save();

    return redirect()->route('admin.viewMembers')->with('success', 'User status updated successfully.');
}

// Edit member's details
public function edit($id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $member = User::findOrFail($id);
    return view('backend.admin.edit-member', compact('member'));
}

// Update member's details after editing
public function update(Request $request, $id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    $member = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'phone' => 'nullable|string|max:20',
        'status' => 'required|boolean',
    ]);

    $member->update($request->all());

    return redirect()->route('admin.viewMembers')->with('success', 'Member details updated successfully.');
}

// Delete a member
public function destroy($id)
{
    $admin = auth()->user();

    // Manual role check (only allow if role_id is 1)
    if ($admin->role_id != 1) {
        abort(403, 'Unauthorized action.');
    }

    // Find the member by ID
    $member = User::findOrFail($id);

    // Check and delete the member's image if it exists
    if ($member->profile_picture) { // Assuming 'profile_picture' is the column for storing the image filename
        $imagePath = public_path('profilepics/' . $member->profile_picture);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image file
        }
    }

    // Delete the member record from the database
    $member->delete();

    // Redirect back with success message
    return redirect()->route('admin.viewMembers')->with('success', 'Member deleted successfully.');
}



}

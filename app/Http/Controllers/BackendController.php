<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; 
use App\Mail\ResetPasswordMail; // Assuming you have this Mail class

class BackendController extends Controller
{
    public function viewMembers()
    {
        $members = User::all(); 
        Log::debug('Fetched Members:', ['members' => $members]); 
        return view('backend.admin.view-members', compact('members'));
    }

    public function viewMember($id)
    {
        $this->authorize('view', User::findOrFail($id)); 
        return view('backend.admin.view-member', compact('member'));
    }

    public function downloadMember($id)
    {
        $this->authorize('view', User::findOrFail($id)); 
        // Implement download logic (e.g., export to CSV, PDF)
    }

    public function resetPassword(Request $request, $id)
    {
        $this->authorize('update', User::findOrFail($id)); 

        $user = User::findOrFail($id);
        $newPassword = Str::random(10); // Generate a random password
        $user->password = Hash::make($newPassword); 
        $user->save();

        Mail::to($user->email)->send(new ResetPasswordMail($user, $newPassword)); 

        return redirect()->back()->with('success', 'Password reset successfully. New password sent to user\'s email.');
    }

    public function sendMessage(Request $request, $id)
    {
        $this->authorize('view', User::findOrFail($id)); 

        // Validate request data (e.g., message content)
        $request->validate([
            'message' => 'required|string',
        ]);

        // Implement logic to send the message (e.g., using a notification system)
        // ...

        return redirect()->back()->with('success', 'Message sent successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $this->authorize('update', User::findOrFail($id)); 

        $user = User::findOrFail($id);
        $user->status = $request->has('status') ? 1 : 0; // Toggle status based on request presence of 'status' field
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }
}
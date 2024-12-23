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



     // Show Admin Profile
     public function viewProfile()
     {
         $admin = auth()->user();
 
         // Manual role check (only allow if role_id is 1)
         if ($admin->role_id != 1) {
             abort(403, 'Unauthorized action.');
         }
 
         return view('backend.admin.profile.view', compact('admin'));
     }
 
     // Edit Admin Profile
     public function editProfile()
     {
         $admin = auth()->user();
 
         // Manual role check (only allow if role_id is 1)
         if ($admin->role_id != 1) {
             abort(403, 'Unauthorized action.');
         }
 
         return view('backend.admin.profile.edit', compact('admin'));
     }
 
     // Update Admin Profile
     public function updateProfile(Request $request)
     {
         $admin = auth()->user();
 
         // Manual role check (only allow if role_id is 1)
         if ($admin->role_id != 1) {
             abort(403, 'Unauthorized action.');
         }
 
         // Validate the inputs for all fields
         $validatedData = $request->validate([
             'first_name' => 'required|string|max:255',
             'last_name' => 'required|string|max:255',
             'bangla_name' => 'nullable|string|max:255',
             'email' => 'required|email|unique:users,email,' . $admin->id,
             'mobile_number' => 'nullable|string|max:15',
             'date_of_birth' => 'nullable|date',
             'nid' => 'nullable|string|max:17',
             'gender' => 'nullable|in:male,female,other',
             'blood_group' => 'nullable|string|max:5',
             'education' => 'nullable|string|max:255',
             'profession' => 'nullable|string|max:255',
             'skills' => 'nullable|string|max:255',
             'country' => 'nullable|string|max:255',
             'division' => 'nullable|string|max:255',
             'district' => 'nullable|string|max:255',
             'thana' => 'nullable|string|max:255',
             'address' => 'nullable|string|max:500',
             'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
 
         // Handle profile photo upload if exists
         if ($request->hasFile('photo')) {
             // Remove the old photo if any
             if ($admin->photo && file_exists(public_path('uploads/' . $admin->photo))) {
                 unlink(public_path('uploads/' . $admin->photo));
             }
 
             // Store the new photo
             $photoPath = $request->file('photo')->store('uploads', 'public');
             $validatedData['photo'] = $photoPath;
         }
 
         // Update profile data
         $admin->update($validatedData);
 
         return redirect()->route('admin.viewProfile')->with('success', 'Profile updated successfully.');
     }
 
     // Show Change Password Form
     public function changePasswordForm()
     {
         $admin = auth()->user();
 
         // Manual role check (only allow if role_id is 1)
         if ($admin->role_id != 1) {
             abort(403, 'Unauthorized action.');
         }
 
         return view('backend.admin.profile.change-password');
     }
 
     // Change Admin Password
     public function changePassword(Request $request)
     {
         $admin = auth()->user();
 
         // Manual role check (only allow if role_id is 1)
         if ($admin->role_id != 1) {
             abort(403, 'Unauthorized action.');
         }
 
         // Validate the inputs
         $validatedData = $request->validate([
             'current_password' => 'required',
             'password' => 'required|min:8|confirmed',
         ]);
 
         // Check if the current password is correct
         if (!Hash::check($request->current_password, $admin->password)) {
             return back()->withErrors(['current_password' => 'The current password is incorrect.']);
         }
 
         // Update the password
         $admin->update(['password' => Hash::make($request->password)]);
 
         return redirect()->route('admin.changePasswordForm')->with('success', 'Password changed successfully.');
     }



}
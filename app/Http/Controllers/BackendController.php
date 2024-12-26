<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use App\Models\Contact; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; 
use App\Mail\ResetPasswordMail; // Assuming you have this Mail class
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\MemberController;


class BackendController extends Controller
{
    


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


public function updateProfile(Request $request)
{
    
    // Validate incoming request data
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        'mobile_number' => 'required|numeric',
        'nid' => 'required|string|max:17', // Changed to match your input name 'nid'
        'dob' => 'required|date', // Changed to match your input name 'dob'
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'gender' => 'required|string',
        'blood_group' => 'nullable|string|max:5',
        'education' => 'nullable|string|max:255',
        'profession' => 'nullable|string|max:255',
        'skills' => 'nullable|string|max:255',
        'country' => 'required|string|max:255',
        'division' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'thana' => 'required|string|max:255',
        'address' => 'required|string|max:255',
    ]);
   // dd($validatedData);
    // Find the logged-in user
    $admin = auth()->user();

    // Handle photo upload if there's a new one
    if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
        // Remove old photo if exists
        if ($admin->photo) {
            $oldPhotoPath = public_path('profilepics/' . $admin->photo); // Get full path to the old photo
            if (file_exists($oldPhotoPath)) {
                // Delete the old photo if it exists
                unlink($oldPhotoPath);
            }
        }

        // Store the new photo with a unique name
        $timestamp = time();
        $photoName = $request->first_name . '_' . $timestamp . '.' . $request->file('photo')->getClientOriginalExtension(); // Combine first name and timestamp

        // Store the file directly in the 'public/profilepics' directory
        $photoPath = $request->file('photo')->move(public_path('profilepics'), $photoName); // Store the file in the public folder

        // Add the photo path to validated data array (relative path for the database)
        $validatedData['photo'] = 'profilepics/' . $photoName; // store path relative to 'public'
    }

    // Update the user's profile with validated data
    $admin->update($validatedData);

    // Redirect to the profile view page with a success message
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








    
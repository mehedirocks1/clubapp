<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;  // To generate a random password
use Illuminate\Support\Facades\Mail;  // For sending the random password via email
use Illuminate\Support\Facades\Log;
use Symfony\Component\Mime\Part\TextPart;
class RegistrationController extends Controller
{
    // Show the registration form
    public function showForm()
    {
        return view('frontend.registration'); // Return the registration view
    }

    // Handle the registration form submission
    public function register(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bangla_name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|digits:11',
            'dob' => 'required|date',
            'nid' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'blood_group' => 'required|in:A+,B+,O+,AB+,A-,B-,O-,AB-',
            'education' => 'required|in:high_school,bachelor,master,phd',
            'profession' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed', // Password is nullable, as we will generate a random one
            'terms' => 'accepted',
        ]);

        // Check if the photo is uploaded successfully
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            // Use storeAs to save the file with its original name
            $photoPath = $request->file('photo')->storeAs('public/photos', $request->file('photo')->getClientOriginalName());
        } else {
            // If no photo is uploaded or invalid
            return back()->withErrors(['photo' => 'No valid photo uploaded.']);
        }

        // Generate a random password if not provided
        $randomPassword = Str::random(12);  // Generate a random 12-character password

        // Create the user with all validated data
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'bangla_name' => $request->bangla_name,
            'photo' => $photoPath,  // Store the file path
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'dob' => $request->dob,
            'nid' => $request->nid,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'education' => $request->education,
            'profession' => $request->profession,
            'password' => Hash::make($randomPassword), // Hash the random password
            'role_id' => 3,  // Default role_id set to 3 (User role)
        ]);

        // Send the password to the user via email
        $this->sendPasswordEmail($user, $randomPassword);

        // Redirect to the success page
        return redirect()->route('register.success');
    }


    private function sendPasswordEmail($user, $password)
    {
        try {
            // Email body content
            $emailBody = "Hello {$user->first_name},\n\nYour login credentials are as follows:\nEmail: {$user->email}\nPassword: {$password}\n\nThank you for registering with us.";
    
            // Send email using the Mail facade
            Mail::raw($emailBody, function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Your Login Information');
            });
    
            Log::info('Email sent successfully to ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
        }
    }
    
    

    // Show the registration success page
    public function success()
    {
        return view('frontend.registration-success');  // Return the success view
    }
}

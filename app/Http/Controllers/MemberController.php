<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    
    public function viewMembers()
    {
        // Fetch all users (or paginate them)
        $members = User::all();

        // Return the view with members data
        return view('backend.admin.view-members', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|string|max:20',
        ]);

        // Create a new user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'status' => 1, // Default active status
        ]);

        // Return to the users index route with a success message
        return redirect()->route('admin.viewMembers')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the user (member) by ID
        $member = User::findOrFail($id);

        // Return the view with the member data
        return view('backend.admin.view-member', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Fetch the user (member) by ID
        $member = User::findOrFail($id);

        // Return the edit view with member data
        return view('backend.admin.edit-member', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation for the user fields
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Ensure email is unique, ignoring the current user ID
            'mobile_number' => 'required|string|max:20',
            'status' => 'required|boolean',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user data with validated input
        $user->update($request->only(['first_name', 'last_name', 'email', 'mobile_number', 'status']));

        // Redirect back with a success message
        return redirect()->route('admin.viewMembers')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Prevent the logged-in user (admin) from deleting their own account
        if (auth()->id() == $user->id) {
            return redirect()->route('backend.admin.dashboard')->with('error', 'You cannot delete your own account.');
        }

        // Proceed with deletion if not the logged-in admin
        $user->delete();

        // Redirect back with a success message
        return redirect()->route('admin.viewMembers')->with('success', 'User deleted successfully.');
    }

    /**
     * Update the status of the specified user.
     */
    public function updateStatus($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Toggle the status between active (1) and inactive (0)
        $user->status = $user->status == 1 ? 0 : 1;

        // Save the updated status
        $user->save();

        // Redirect back with a success message
        return redirect()->route('admin.viewMembers')->with('success', 'User status updated successfully.');
    }
}

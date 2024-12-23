<?php

namespace App\Http\Controllers;

use App\Models\User;  // Use User model instead of Member
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;
class MemberController extends Controller
{
   


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([ ... ]);  // Add your validation rules here
        // $user = User::create($request->all());  // Create a new user
        // return redirect()->route('admin.users.index')->with('success', 'User created successfully.');  // Updated route and message
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // Fetch the user data by ID
    $member = User::findOrFail($id);

    // Return the view with the member data
    return view('backend.admin.view-member', compact('member'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $member = User::findOrFail($id);  // Find member by ID
        return view('backend.admin.edit-member', compact('member'));  // Return the edit view with member data
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,  // Updated table name
            'mobile_number' => 'required|string|max:20',
            'status' => 'required|boolean',
        ]);

        $user = User::findOrFail($id);  // Find user by ID
        $user->update($request->all());  // Update user data

        return redirect()->route('admin.viewMembers')->with('success', 'User updated successfully.');  // Updated route and message
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Debugging: Dump the ID
        //dd($id); 
    
        // Find the member by ID
        $user = User::findOrFail($id);
    
        // Prevent the logged-in user (admin) from deleting their own account
        if (auth()->id() == $user->id) {
            return redirect()->route('backend.admin.dashboard')->with('error', 'You cannot delete your own account.');
        }
    
        // Proceed with deletion if not the logged-in admin
        $user->delete();
    
        return redirect()->route('admin.viewMembers')->with('success', 'User deleted successfully.');
    }
    

    /**
     * Update the status of the specified user.
     */
    public function updateStatus($id)
    {
        $user = User::findOrFail($id);  // Find user by ID

        // Toggle the status between active (1) and inactive (0)
        $user->status = $user->status == 1 ? 0 : 1;

        // Save the updated status
        $user->save();

        // Redirect back to the users index with a success message
        return redirect()->route('admin.viewMembers')->with('success', 'User status updated successfully.');  // Updated route and message
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Branch;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\MemberController;

class WebsiteController extends Controller
{

    public function changeLogo(Request $request)
    {
        // If the form is submitted with a POST request (uploading the new logo)
        if ($request->isMethod('post')) {
            // Validate the uploaded file
            $request->validate([
                'logo' => 'required|image|mimes:jpg,jpeg|max:2048', // max 2MB
            ]);

            // Path to the current logo
            $currentLogoPath = public_path('assets/images/logo.jpg');

            // Check if the file exists, then delete it
            if (File::exists($currentLogoPath)) {
                File::delete($currentLogoPath);
            }

            // Store the new logo in the public folder
            $newLogo = $request->file('logo');
            $newLogoName = 'logo.jpg'; // Use a fixed name for the logo

            // Move the new logo to the correct location
            $newLogo->move(public_path('assets/images'), $newLogoName);

            // Redirect with a success message
            return redirect()->route('admin.changeLogo')->with('success', 'Logo updated successfully!');
        }

        // If it's a GET request, just show the form
        return view('backend.admin.change-logo');
    }


 // Website Content Management
 public function viewContact()
 {
     // Fetch all contacts from the database
     $contacts = Contact::all(); // Fetch all contacts

     // Pass the contacts to the view
     return view('backend.admin.view-contact', ['contacts' => $contacts]);
 }



    public function viewSlider()
    {
        // Assuming the slider images are named 1.jpg, 2.jpg, and 3.jpg
        $sliderImages = [
            '1.jpg',
            '2.jpg',
            '3.jpg'
        ];
    
        return view('backend.admin.view-slider', compact('sliderImages'));
    }
    
    public function changeSlider(Request $request)
    {
        // Validate the files
        $validated = $request->validate([
            'slider1' => 'image|mimes:jpeg,jpg|max:2048',
            'slider2' => 'image|mimes:jpeg,jpg|max:2048',
            'slider3' => 'image|mimes:jpeg,jpg|max:2048',
        ]);
    
        // Upload the images if they are present
        if ($request->hasFile('slider1')) {
            $slider1 = $request->file('slider1');
            $slider1->move(public_path('assets/images/slider'), '1.jpg');
        }
    
        if ($request->hasFile('slider2')) {
            $slider2 = $request->file('slider2');
            $slider2->move(public_path('assets/images/slider'), '2.jpg');
        }
    
        if ($request->hasFile('slider3')) {
            $slider3 = $request->file('slider3');
            $slider3->move(public_path('assets/images/slider'), '3.jpg');
        }
    
        return redirect()->route('admin.viewSlider')->with('success', 'Slider images updated successfully.');
    }


    public function branches()
    {
        // Fetch all branches from the Branch model
        $branches = Branch::all();
    
        // Pass branches data to the view
        return view('backend.admin.view-branches', ['branches' => $branches]);
    }
    
    public function createBranch()
    {
        return view('backend.admin.create-branch');
    }
    
    public function storeBranch(Request $request)
    {
        // Validation for the branch form data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'working_hours' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Create the new branch record
        $branch = new Branch();
        $branch->name = $request->name;
        $branch->description = $request->description;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->email = $request->email;
        $branch->working_hours = $request->working_hours;
    
        // Handle the image upload if present
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/images/branches'), $imageName);
            $branch->image = $imageName;
        }
    
        $branch->save();
    
        return redirect()->route('admin.branches')->with('success', 'Branch added successfully!');
    }
    
    public function editBranch($id)
    {
        $branch = Branch::find($id);
    
        if (!$branch) {
            return redirect()->route('admin.branches')->with('error', 'Branch not found.');
        }
    
        return view('backend.admin.edit-branch', ['branch' => $branch]);
    }
    
    public function updateBranch(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
    
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'working_hours' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($branch->image) {
                $oldImagePath = public_path('assets/images/branches/' . $branch->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            // Store the new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/branches'), $imageName);
            
            $validatedData['image'] = $imageName;
        }
    
        // Update the branch with validated data
        $branch->update($validatedData);
    
        return redirect()->route('admin.editBranch', $branch->id)
                         ->with('success', 'Branch updated successfully.');
    }
    
    public function destroyBranch($id)
    {
        // Find the branch by ID
        $branch = Branch::findOrFail($id);
    
        // Delete the image if it exists
        if ($branch->image) {
            $imagePath = public_path('assets/images/branches/' . $branch->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }
        }
    
        // Delete the branch
        $branch->delete();
    
        // Redirect back with a success message
        return redirect()->route('admin.branches')->with('success', 'Branch deleted successfully!');
    }
    public function viewAbout()
    {
        return view('backend.admin.view-about');
    }

    public function gallery()
    {
        return view('backend.admin.gallery');
    }
}

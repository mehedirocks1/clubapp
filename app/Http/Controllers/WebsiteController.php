<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Branch;

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
    $branches = Branch::all(); // Make sure you have the Branch model created

    // Pass branches data to the view
    return view('backend.admin.view-branches', ['branches' => $branches]);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class CoachController extends Controller
{

          /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private function getAuthenticatedUser()
    {
        return auth()->user();
    }
    public function index()
    {
        $user = $this->getAuthenticatedUser();
        
        // Load user with relationships for dashboard statistics
        $user->load([
            'createdCourses',
            'posts.comments',
            'followers',
            'followings'
        ]);
        
        return view('coach.dashboard', ['user' => $user]);
    }



    public function coachs()
    {
        // Fetch all users with the role 'coach'
        $coaches = User::where('role', 'coach')->get();
        $user = $this->getAuthenticatedUser();

        return view('admin.sections.coachs.coachs', [
            'coaches' => $coaches , 'user'=>$user ,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the coach by ID
        $coach = User::findOrFail($id);

        // Delete profile photo if it exists
        if ($coach->profile_photo) {
            // Ensure the file exists before attempting to delete
            if (Storage::exists($coach->profile_photo)) {
                Storage::delete($coach->profile_photo);
            }
        }

        // Delete couverture pic if it exists
        if ($coach->couverture_pic) {
            // Ensure the file exists before attempting to delete
            if (Storage::exists($coach->couverture_pic)) {
                Storage::delete($coach->couverture_pic);
            }
        }

        // Delete the coach record
        $coach->delete();

        // Redirect back with a success message
         return redirect()->back()->with('success', 'Coach deleted successfully.');
    }


    // Show the form for creating a new coach
    public function create()
    {
        $user = $this->getAuthenticatedUser();

        return view('admin.sections.coachs.createcoach', ['user'=>$user]);
    }

    // Store a newly created coach in storage
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'secondname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'couverture_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:8|confirmed',
            'sexe' => 'required|in:male,female',

        ]);

        // Handle file uploads
        $profilePhotoPath = $request->file('profile_photo') ? $request->file('profile_photo')->store('profile_photos') : null;
        $couverturePicPath = $request->file('couverture_pic') ? $request->file('couverture_pic')->store('couverture_pics') : null;

        // Create the new coach
        $coach = User::create([
            'name' => $request->input('name'),
            'secondname' => $request->input('secondname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'profile_photo' => $profilePhotoPath,
            'couverture_pic' => $couverturePicPath,
            'password' => Hash::make($request->input('password')),
            'role' => 'coach',
            'email_subscription'=> 0 ,
            'accepted_terms'=> true,
            'sexe' => $request->input('sexe'),

        ]);
        // Redirect to the list of coaches with a success message
        return Redirect::route('admin.coachs.index')->with('success', 'Coach created successfully.');
    }







    public function show($id)
    {
        $user = $this->getAuthenticatedUser();

        // Retrieve the coach and include related data
        $coach = User::with(['posts', 'followers', 'followings', 'createdCourses'])
                     ->findOrFail($id);

        return view('showcoach', [
            'coach' => $coach,
            'user' => $user
        ]);
    }






}

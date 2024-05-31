<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $acceptedUserCount = User::where('status', 'accepted')->count();
        $pendingUserCount = User::where('status', 'pending')->count();

        $Alaminos= User::where('campus', 'Alaminos')->where('status', 'accepted')->count();
        $Asingan = User::where('campus', 'Asingan')->where('status', 'accepted')->count();
        $Binmaley= User::where('campus', 'Binmaley')->where('status', 'accepted')->count();
        $Bayambang = User::where('campus', 'Bayambang')->where('status', 'accepted')->count();
        $StaMaria = User::where('campus', 'Sta. Maria')->where('status', 'accepted')->count();
        $Lingayen = User::where('campus', 'Lingayen')->where('status', 'accepted')->count();
        $SanCarlos = User::where('campus', 'San Carlos')->where('status', 'accepted')->count();
        $UrdanetaCity = User::where('campus', 'Urdaneta City')->where('status', 'accepted')->count();
       

        
        return view('admin.admindashboard', compact('acceptedUserCount','pendingUserCount','Alaminos','Asingan','Binmaley','Bayambang','StaMaria','Lingayen','SanCarlos','UrdanetaCity'));
    }

    public function showUsers(Request $request)
    {
        $query = User::query();
    
        // Apply filters if present
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        if ($request->has('campus') && $request->campus != '') {
            $query->where('campus', $request->campus);
        }
    
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
    
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
    
        $users = $query->orderBy('created_at', 'desc')->get();
        
        // Assuming you have a predefined list of departments
        $departments = ['Department1', 'Department2', 'Department3']; 
    
        return view('admin.users.index', compact('users'));
    }
    public function showUsersPending(Request $request)
    { $query = User::query();
        
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        if ($request->has('campus') && $request->campus != '') {
            $query->where('campus', $request->campus);
        }
    
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
    
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        $users = $query->orderBy('created_at', 'desc')->get();
        return view('admin.users.request', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);
    
    
        if ($request->hasFile('profile_image')) {
            
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
    
           
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
    
           
            $user->profile_image = $imagePath;
        } else {
          
            $user->profile_image = $request->input('current_profile_image');
        }
    
     
        $user->update($request->except('profile_image'));
    
        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function markAsAccepted(User $user)
    {
        $user->status = 'accepted';
        $user->save();
        
        return redirect()->route('admin.request')->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }
    
    public function create(Request $request)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'facultyId' => ['required', 'string', 'max:255'],
        'name' => ['required', 'string', 'max:255'],
        'jobTitle' => ['required', 'string', 'max:255'],
        'campus' => ['required', 'string', 'max:255'],
        'department' => ['required', 'string', 'max:255'],
        'profile_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    // Handle validation errors
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Store the profile image
    $image = $request->file('profile_image');
    $image_name = $image->getClientOriginalName();
    $path = $image->storeAs('profile_images', $image_name, 'public');

    // Create the new user
    $user = User::create([
        'facultyId' => $request->facultyId,
        'name' => $request->name,
        'jobTitle' => $request->jobTitle,
        'campus' => $request->campus,
        'department' => $request->department,
        'profile_image' => $path,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'status' => 'accepted',
        'label' => 'faculty'
    ]);

    // Redirect with a success message
    return redirect()->route('admin.users')->with('success', 'User created successfully');
}


    public function import(Request $request)
{
    $request->validate([
        'csv_file' => 'required|mimes:csv,txt',
    ]);

    $path = $request->file('csv_file')->getRealPath();
    $data = array_map('str_getcsv', file($path));

    if (count($data) == 0) {
        return redirect()->back()->with('error', 'CSV file is empty.');
    }

    // Handle BOM character in header
    $header = array_shift($data);
    $header[0] = preg_replace('/\x{FEFF}/u', '', $header[0]);

    if ($header === null) {
        return redirect()->back()->with('error', 'CSV header is missing.');
    }

    // Log the header and data
    \Log::info('CSV Header: ' . json_encode($header));
    \Log::info('CSV Data: ' . json_encode($data));

    $csv_data = array_map(function ($row) use ($header) {
        return array_combine($header, $row);
    }, $data);

    // Log processed CSV data
    \Log::info('Processed CSV Data: ' . json_encode($csv_data));

    foreach ($csv_data as $row) {
        $validator = Validator::make($row, [
            'facultyId' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'jobTitle' => ['required', 'string', 'max:255'],
            'campus' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'profile_image' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            // Log validation errors
            \Log::error('Validation failed for row: ' . json_encode($row) . '. Errors: ' . json_encode($validator->errors()));
            continue;
        }

        $image_path = 'profile_images/' . $row['profile_image'];

        // Log the user data being created
        \Log::info('Creating user with data: ' . json_encode($row));

        User::create([
            'facultyId' => $row['facultyId'],
            'name' => $row['name'],
            'jobTitle' => $row['jobTitle'],
            'campus' => $row['campus'],
            'department' => $row['department'],
            'profile_image' => $image_path,
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'status' => 'accepted',
            'label' => 'faculty'
        ]);
    }
    return redirect()->route('admin.users')->with('success', 'User created successfully');
    
}
public function showRegistrationForm()
{
    return view('auth.registers');
}
}

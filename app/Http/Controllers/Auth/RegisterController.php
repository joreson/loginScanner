<?php

namespace App\Http\Controllers\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request; 

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
  
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'jobTitle' => ['required', 'string', 'max:255'],
            'campus' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'profile_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], 
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => ['required'],
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if($data['type'] == 'register'){
            $image = $data['profile_image']; 
            $image_name = $image->getClientOriginalName(); 
            $path = $image->storeAs('profile_images', $image_name, 'public'); 
        
         
            return User::create([
                'facultyId' => $data['facultyId'],
                'name' => $data['name'],
                'jobTitle' => $data['jobTitle'],
                'campus' => $data['campus'],
                'department' => $data['department'],
                'profile_image' => $path, 
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'status' => 'pending',
                'label' => 'faculty'
            ]);
           $redirectTo = '/admin/users';
        }else{
        $image = $data['profile_image']; 
        $image_name = $image->getClientOriginalName(); 
        $path = $image->storeAs('profile_images', $image_name, 'public'); 
    
     
        return User::create([
            'facultyId' => $data['facultyId'],
            'name' => $data['name'],
            'jobTitle' => $data['jobTitle'],
            'campus' => $data['campus'],
            'department' => $data['department'],
            'profile_image' => $path, 
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'accepted',
            'label' => 'faculty'
        ]);

        $redirectTo = 'home';
    }
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

    return redirect()->back()->with('success', 'Users imported successfully.');
}


    
}

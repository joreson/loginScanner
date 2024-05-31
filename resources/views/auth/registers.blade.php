@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">{{ __('Register') }} </div> -->
                <div class="card-header">Add Faculty</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('registers') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="facultyId" class="col-md-4 col-form-label text-md-right">{{ __('Faculty ID') }}</label>

                            <div class="col-md-6">
                                <input id="facultyId" type="text" class="form-control @error('facultyId') is-invalid @enderror" name="facultyId" value="{{ old('facultyId') }}" required autocomplete="facultyId" autofocus>

                                @error('facultyId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jobTitle" class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>

                            <div class="col-md-6">
                                <select id="jobTitle" class="form-control @error('jobTitle') is-invalid @enderror" name="jobTitle" required>
                                    <option value="" selected disabled>Select Job Title</option>
                                    <option value="Professor">Professor</option>
                                    <option value="Dean">Dean</option>
                                    <option value="Department Chair">Department Chair</option>
                                    <option value="Program Director">Program Director</option>
                                    <option value="Librarian">Librarian</option>
                                    <option value="Academic Advisor">Academic Advisor</option>
                                    <option value="Technical Staff">Technical Staff</option>
                                    <option value="Guidance Councilor">Guidance Councilor</option>
                                    <option value="Other">Other</option>
                                </select>

                                @error('jobTitle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="campus" class="col-md-4 col-form-label text-md-right">{{ __('Campus') }}</label>

                            <div class="col-md-6">
                                <select id="campus" type="text" class="form-control @error('campus') is-invalid @enderror" name="campus">
                                    <option value="" ><-Select-Campus-></option>
                                    <option value="Alaminos">Alaminos</option>
                                    <option value="Asingan">Asingan</option>
                                    <option value="Binmaley">Binmaley</option>
                                    <option value="Bayambang">Bayambang</option>
                                    <option value="Sta. Maria">Sta. Maria</option>                                  
                                    <option value="Lingayen">Lingayen</option>
                                    <option value="San Carlos">San Carlos</option>
                                    <option value="Urdaneta City">Urdaneta City</option>
                                </select >

                            
                                <!-- <input id="campus" type="text" class="form-control @error('campus') is-invalid @enderror" name="campus" value="{{ old('campus') }}" required autocomplete="campus" autofocus> -->

                                @error('campus')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                <select id="department" class="form-control @error('department') is-invalid @enderror" name="department" required>
                                    <option value="" selected disabled>Select Department</option>
                                    <option value="Information Technology">Information Technology</option>
                                    <option value="Civil Engineering">Civil Engineering</option>
                                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                                    <option value="Electrical Engineering">Electrical Engineering</option>
                                    <option value="Other">Other</option>
                                </select>

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>

                            <div class="col-md-6" >
                            <input type="file" id="profile_image" name="profile_image" accept="image/*">

                                @error('profile_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                            <div class="col-md-6">
                                <input id="password"  type="password" class="form-control @error('password') is-invalid @enderror"  hidden value='12345678'  name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> -->

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" hidden value='12345678' name="password_confirmation"  required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" >
                                   Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <br><br>
                <div class="row justify-content-center">
       
   
     <div class="col-md-8">
            <div class="card">
                <div class="card-header">Import Faculty via CSV</div>
 
                <div class="card-body">
                    <form method="POST" action="{{ route('import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="csv_file" class="col-md-4 col-form-label text-md-right">{{ __('CSV File') }}</label>
 
                            <div class="col-md-6">
                                <input type="file" id="csv_file" class="form-control @error('csv_file') is-invalid @enderror" name="csv_file" required accept=".csv">
 
                                @error('csv_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
 
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Import
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

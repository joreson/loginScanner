@extends('layouts.app')

@section('content')
    <div class="container box p-4 border rounded" style="background-color:white" >
        <h1>Edit User</h1>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
                        <div class="form-group row">
                            <label for="facultyId" class="col-md-4 col-form-label text-md-right">{{ __('Faculty ID') }}</label>

                            <div class="col-md-6">
                                <input id="facultyId" type="text" class="form-control @error('facultyId') is-invalid @enderror" name="facultyId" value="{{ $user->facultyId }}" required autocomplete="facultyId" autofocus>

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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                                <input id="type" type="text"  name="type" value="register" required hidden autocomplete="name" autofocus>

                             


                        <div class="form-group row">
                            <label for="jobTitle" class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>

                            <div class="col-md-6">
                            <select id="jobTitle" class="form-control @error('jobTitle') is-invalid @enderror" name="jobTitle" required>
                                <option value="" disabled {{ old('jobTitle', $user->jobTitle) == '' ? 'selected' : '' }}>Select Job Title</option>
                                <option value="Professor" {{ old('jobTitle', $user->jobTitle) == 'Professor' ? 'selected' : '' }}>Professor</option>
                                <option value="Dean" {{ old('jobTitle', $user->jobTitle) == 'Dean' ? 'selected' : '' }}>Dean</option>
                                <option value="Department Chair" {{ old('jobTitle', $user->jobTitle) == 'Department Chair' ? 'selected' : '' }}>Department Chair</option>
                                <option value="Program Director" {{ old('jobTitle', $user->jobTitle) == 'Program Director' ? 'selected' : '' }}>Program Director</option>
                                <option value="Librarian" {{ old('jobTitle', $user->jobTitle) == 'Librarian' ? 'selected' : '' }}>Librarian</option>
                                <option value="Academic Advisor" {{ old('jobTitle', $user->jobTitle) == 'Academic Advisor' ? 'selected' : '' }}>Academic Advisor</option>
                                <option value="Technical Staff" {{ old('jobTitle', $user->jobTitle) == 'Technical Staff' ? 'selected' : '' }}>Technical Staff</option>
                                <option value="Guidance Councilor" {{ old('jobTitle', $user->jobTitle) == 'Guidance Councilor' ? 'selected' : '' }}>Guidance Councilor</option>
                                <option value="Other" {{ old('jobTitle', $user->jobTitle) == 'Other' ? 'selected' : '' }}>Other</option>
</select>


                                @error('jobTitle')
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
                                <option value="" disabled {{ old('department', $user->department) == '' ? 'selected' : '' }}>Select Department</option>
                                <option value="Information Technology" {{ old('department', $user->department) == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                                <option value="Civil Engineering" {{ old('department', $user->department) == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
                                <option value="Mechanical Engineering" {{ old('department', $user->department) == 'Mechanical Engineering' ? 'selected' : '' }}>Mechanical Engineering</option>
                                <option value="Electrical Engineering" {{ old('department', $user->department) == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
                                <option value="Other" {{ old('department', $user->department) == 'Other' ? 'selected' : '' }}>Other</option>
</select>


                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="campus" class="col-md-4 col-form-label text-md-right">{{ __('Campus') }}</label>

                            <div class="col-md-6">
                            <select id="campus" class="form-control @error('campus') is-invalid @enderror" name="campus" required>
                                <option value="" disabled {{ old('campus', $user->campus) == '' ? 'selected' : '' }}>Select Campus</option>
                                <option value="Alaminos" {{ old('campus', $user->campus) == 'Alaminos' ? 'selected' : '' }}>Alaminos</option>
                                <option value="Asingan" {{ old('campus', $user->campus) == 'Asingan' ? 'selected' : '' }}>Asingan</option>
                                <option value="Binmaley" {{ old('campus', $user->campus) == 'Binmaley' ? 'selected' : '' }}>Binmaley</option>
                                <option value="Bayambang" {{ old('campus', $user->campus) == 'Bayambang' ? 'selected' : '' }}>Bayambang</option>
                                <option value="Sta. Maria" {{ old('campus', $user->campus) == 'Sta. Maria' ? 'selected' : '' }}>Sta. Maria</option>
                                <option value="Lingayen" {{ old('campus', $user->campus) == 'Lingayen' ? 'selected' : '' }}>Lingayen</option>
                                <option value="San Carlos" {{ old('campus', $user->campus) == 'San Carlos' ? 'selected' : '' }}>San Carlos</option>
                                <option value="Urdaneta City" {{ old('campus', $user->campus) == 'Urdaneta City' ? 'selected' : '' }}>Urdaneta City</option>
                            </select>


                                @error('campus')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
    <label for="profile_image" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>

    <div class="col-md-6">
        <!-- Display current profile image if it exists -->
        @if($user->profile_image)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 150px;">
            </div>
            <!-- Hidden input to keep the current image value -->
            <input type="hidden" name="current_profile_image" value="{{ $user->profile_image }}">
        @endif

        <!-- File input for new profile image -->
        <input type="file" id="profile_image" name="profile_image" accept="image/*" class="form-control-file @error('profile_image') is-invalid @enderror">
        
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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $user->facultyId }}" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end"><button type="submit" class="btn btn-success">Update</button></div>
            
        </form>
    </div>
@endsection

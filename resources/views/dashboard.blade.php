@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Dashboard</div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">

                                
                              
                                <p class="text-lg font-semibold mb-1">Name: {{ $user->name }}</p>
                                <p class="text-sm mb-1"> Job Title: {{ $user->jobTitle }}</p>
                                <p class="text-sm mb-1">Campus: {{ $user->campus }}</p>
                                <p class="text-sm mb-1">Department: {{ $user->department }}</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="{{ Storage::url($user->profile_image) }}" alt="Profile Image" class="w-50 h-auto rounded-circle mx-auto object-cover shadow-lg">
                            </div>
                        </div>
                        <br>
                        <h5 class="mb-3 text-center">{{ __('Get your QR Codes') }}</h5>
                        @if($user->status != "pending")
                        <div class="text-center mb-4"> 
                            <a href="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(400)->generate(Auth::user()->name)) !!}" download="{{ Auth::user()->name }}">
                                <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(400)->generate(Auth::user()->name)) !!}" class="img-fluid">
                            </a>
                        </div>
                        @else 
                        <div class="text-center mb-4"> 
                            <h5>Pending</h5>
                            <p>Wait to accept by administrator to get the Qr Code</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center text-light">Request Account</h1>
        <a href="{{ route('admin.admindashboard') }}" class="btn btn-primary">Back to Dashboard</a><br><br>
        
      
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <!-- Filters -->
    <form id="filter-form" method="GET" action="{{ route('admin.request') }}">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="name" class="form-control" placeholder="Search by name" value="{{ request('name') }}">
            </div>
            <div class="col-md-3 ">
                <select name="campus" class="form-control">
                    
                    <option value="">All Campus</option>
                    <option value="Alaminos">Alaminos</option>
                    <option value="Asingan">Asingan</option>
                    <option value="Binmaley">Binmaley</option>
                    <option value="Bayambang">Bayambang</option>
                    <option value="Sta. Maria">Sta. Maria</option>                                  
                    <option value="Lingayen">Lingayen</option>
                    <option value="San Carlos">San Carlos</option>
                    <option value="Urdaneta City">Urdaneta City</option>
                   
                </select>
            </div>
            
            <div class="col-md-3">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    <br>

    <table class="table" id="users-table" style="background-color:white">
    <thead style="background-color: #1a36db">
            <tr style="color:white">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Campus</th>
                    <th>Department</th>
                    <th>Job Title</th>
                    <th>Profile Picture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($users as $user)
                        @if($user->status == "pending")
                            <tr>
                                <td>{{ $user->facultyId }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->campus }}</td>
                                <td>{{ $user->department }}</td>
                                <td>{{ $user->jobTitle }}</td>
                                <td>
                                    <img src="{{ Storage::url($user->profile_image) }}" alt="Profile Image" width="70" class="w-32 h-32 rounded-full mx-auto object-cover shadow-lg">
                                </td>
                                <td>
                                <form action="{{ route('admin.markAsAccepted', ['user' => $user->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success m-2">Accept</button>
                                </form>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger m-2">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
        @endforeach
            </tbody>
        </table>
    </div>
    <br><br><br><br>

@endsection

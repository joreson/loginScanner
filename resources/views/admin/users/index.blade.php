@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center text-light">Users</h1>
    

    <div class="row mb-5">
            <div class="col-md-6"></div>
            <div class="col-md-6 d-flex justify-content-end">
            <a href="{{ route('admin.admindashboard') }}" class="btn btn-secondary m-2">Back to Dashboard</a>
             <a href="{{ route('registers') }}" class="btn btn-success m-2">Add</a><br><br>
            </div>
        </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <br>

    <!-- Filters -->
    <form id="filter-form" method="GET" action="{{ route('admin.users') }}">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="name" class="form-control" placeholder="Search by name" value="{{ request('name') }}">
            </div>
            <div class="col-md-3">
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
                <th>Created At</th>
                <th>Profile Picture</th>
                <th>Qr Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @if($user->status != "pending")
                <tr>
                    <td>{{ $user->facultyId }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->campus }}</td>
                    <td>{{ $user->department }}</td>
                    <td>{{ $user->jobTitle }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <img src="{{ Storage::url($user->profile_image) }}" alt="Profile Image" width="70" class="w-32 h-32 rounded-full mx-auto object-cover shadow-lg">
                    </td>
                    <td>
                        <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(70)->generate($user->name)) !!}" alt="QR Code" class="qr-code" data-toggle="modal" data-target="#qrCodeModal" data-qr-code="{!! base64_encode(QrCode::format('png')->size(200)->generate($user->name)) !!}" data-user-name="{{ $user->name }}">
                    </td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning m-2 text-light">Edit</a>
                        <br>
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger m-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>

<!-- Modal HTML -->
<div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrCodeModalLabel">QR Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h5 id="userName"></h5>
                <img id="qrCodeModalImage" width="500" src="" alt="QR Code" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.qr-code').on('click', function() {
            var qrCodeSrc = 'data:image/png;base64,' + $(this).data('qr-code');
            var userName = $(this).data('user-name');
            $('#qrCodeModalImage').attr('src', qrCodeSrc);
            $('#userName').text(userName);
        });

        // jQuery to initialize DataTable
        $('#users-table').DataTable();
    });
</script>

@endsection

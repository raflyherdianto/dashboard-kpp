@extends('layouts.app')

@section('title', 'Add Users')

@section('content')
<div class="d-flex justify-content-between py-3 mb-4">
    <h4 class="fw-bold "><span class="text-muted fw-light">Users /</span> Create User</h4>
</div>
<div class="card p-3">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Create new user</h5>
        <small class="text-muted float-end">User data</small>
    </div>
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">NRP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nrp') is-invalid @enderror" id="basic-default-name"
                        name="nrp" placeholder="NRP" value="{{ old('nrp') }}" />
                    @error('nrp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="basic-default-name"
                        name="name" placeholder="Name" value="{{ old('name') }}" />
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="basic-default-company" name="email" placeholder="Email Address"
                        value="{{ old('email') }}" />
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-phone">Role</label>
                <div class="col-sm-10">
                    <select id="defaultSelect" class="form-select" name="role">
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-phone">Position</label>
                <div class="col-sm-10">
                    <select id="defaultSelect" class="form-select" name="position_id">
                        <option value="">Select Position</option>
                        @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-phone">Department</label>
                <div class="col-sm-10">
                    <select id="defaultSelect" class="form-select" name="department_id">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-phone">Site</label>
                <div class="col-sm-10">
                    <select id="defaultSelect" class="form-select" name="site_id">
                        <option value="">Select Site</option>
                        @foreach ($sites as $site)
                        <option value="{{ $site->id }}">{{ $site->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="password">Password</label>
                <div class="col-sm-10 form-password-toggle">
                    <div class="input-group input-group-merge">
                        <input type="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" value="asdasdasd" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="password_confirmation">Password Confirmation</label>
                <div class="col-sm-10 form-password-toggle">
                    <div class="input-group input-group-merge">
                        <input type="password" id="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" value="asdasdasd"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password_confirmation" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('image-preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection

@extends('layouts.app')

@section('title', 'Add History Pelatihan')

@section('content')
<div class="d-flex justify-content-between py-3 mb-4">
    <h4 class="fw-bold "><span class="text-muted fw-light">History Pelatihan /</span> Create History Pelatihan</h4>
</div>
<div class="card p-3">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Create new data</h5>
        <small class="text-muted float-end">data history pelatihan</small>
    </div>
    <div class="card-body">
        <form action="{{ route('history-pelatihan.store') }}" method="POST" enctype="multipart/form-data">
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
                    <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter NRP" list="mekanik"
                        name="mekanik_id" />
                    <datalist id="mekanik">
                        @foreach ($mekaniks as $mekanik)
                        <option value="{{ $mekanik->nrp }}">{{ $mekanik->name }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Instruktur</label>
                <div class="col-sm-10">
                    <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Instruktur"
                        list="instruktur" name="instruktur_id" />
                    <datalist id="instruktur">
                        @foreach ($instrukturs as $instruktur)
                        <option value="{{ $instruktur->nrp }}">{{ $instruktur->name }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Distrik</label>
                <div class="col-sm-10">
                    <select id="defaultSelect" class="form-select" name="site_id">
                        @foreach ($sites as $role)
                        <option value="{{ $role->id }}" {{ old('site_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Department</label>
                <div class="col-sm-10">
                    <select id="defaultSelect" class="form-select" name="department_id">
                        @foreach ($departments as $role)
                        <option value="{{ $role->id }}" {{ old('department_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Location</label>
                <div class="col-sm-10">
                    <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Location"
                        name="location" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Pelatihan</label>
                <div class="col-sm-10">
                    <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Pelatihan"
                        list="pelatihan" name="pelatihan_id" />
                    <datalist id="pelatihan">
                        @foreach ($pelatihans as $pelatihan)
                        <option value="{{ $pelatihan->name }}">{{ $pelatihan->name }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Start Date</label>
                <div class="col-sm-10">
                    <input type="date" id="nameWithTitle" class="form-control" placeholder="Enter Pelatihan"
                        name="start_date" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">End Date</label>
                <div class="col-sm-10">
                    <input type="date" id="nameWithTitle" class="form-control" placeholder="Enter Pelatihan"
                        name="end_date" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kompetensi</label>
                <div class="col-sm-10">
                    <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Kompetensi"
                        name="sub_egi" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Status</label>
                <div class="col-sm-10">
                    <select id="defaultSelect" class="form-select" name="status">
                        <option value="Lulus">Lulus</option>
                        <option value="Tidak Lulus">Tidak Lulus</option>
                    </select>
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
</script>
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

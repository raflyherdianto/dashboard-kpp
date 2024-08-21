@extends('layouts.app')
@section('title', 'List Users')
@section('content')
<div class="d-flex justify-content-between py-3 ">
    <h4 class="fw-bold "><span class="text-muted fw-light">List Gl wali /</span> Detail</h4>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">Add Data</button>
</div>
<div class="card p-3">
    <h3>Detail Gl Wali</h3>
    <div class="row ">
        <label class="col-sm-2 col-form-label" for="basic-default-name">NRP</label>
        <div class="col-sm-10">
            <p>{{ $data->user->nrp }}</p>
        </div>
    </div>
    <div class="row ">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
        <div class="col-sm-10">
            <p>{{ $data->user->name }}</p>
        </div>
    </div>
    <div class="table-responsive text-nowrap mt-3">
        <table id="table" class="table">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Grade</th>
                    <th>Status</th>
                    <th>Section</th>
                    <th style="width: 10%">Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @php
                $no = 1
                @endphp
                @foreach ($data->mekaniks as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->user->nrp }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->grade }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->section }}</td>
                    <td>
                        <a href="{{ route('glwali.show', $data->id) }}" class="bg-label-info badge">
                            <span class="tf-icons bx bx-show"></span> Show
                        </a>
                        <a href="javascript:void(0)" onclick="confirmDelete({{ $data->id }})"
                            class="bg-label-danger badge">
                            <span class="tf-icons bx bx-trash"></span> Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('mekanik.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add new data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Name</label>
                            <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Name"
                                list="name" name="mekanik" />
                            <input type="text" name="gl_wali_id" value="{{ $data->id }}" class="d-none">
                            <datalist id="name">
                                @foreach ($mekaniks as $mekanik)
                                <option value="{{ $mekanik->nrp }}">{{ $mekanik->name }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Grade</label>
                            <input type="number" min="0" id="nameWithTitle" class="form-control"
                                placeholder="Enter Name" name="grade" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="dobWithTitle" class="form-label">Status</label>
                            <select id="defaultSelect" class="form-select" name="status">
                                <option value="MAP">MAP</option>
                                <option value="IDP">IDP</option>
                                <option value="MM">MM</option>
                            </select>
                        </div>
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Section</label>
                            <select id="defaultSelect" class="form-select" name="section">
                                <option value="CRUSHER">CRUSHER</option>
                                <option value="SSE">SSE</option>
                                <option value="MINIMEX">MINIMEX</option>
                                <option value="TRACK">TRACK</option>
                                <option value="WHEEL">WHEEL</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmDelete(id) {
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#003285',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
    var form = document.getElementById('deleteForm');
    if (form) {
    form.action = '/users/' + id;
    form.submit();
    } else {
    console.error("Form with ID 'deleteForm' not found.");
    }
    }
    });
    }
</script>
@endsection

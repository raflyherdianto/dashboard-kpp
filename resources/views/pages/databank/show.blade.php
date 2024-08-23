@extends('layouts.app')
@section('title', 'List Users')
@section('content')
<div class="d-flex justify-content-between py-3 ">
    <h4 class="fw-bold "><span class="text-muted fw-light">Detail Databank /</span> Detail</h4>
</div>
<div class="card p-3">
    <h3>Detail Databank</h3>
    <div class="row ">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
        <div class="col-sm-10">
            <p>{{ $data->name }}</p>
        </div>
    </div>
    <div class="table-responsive text-nowrap mt-3">
        <form action="{{ route('databank.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-end mb-3">
                <div class="d-flex gap-3">
                    <input type="text" value="{{ $data->id }}" name="egi_id" class="d-none">
                    <input type="file" class="form-control " id="basic-default-name" name="excel" placeholder="Name"
                        accept=".xlsx,.xls,.csv" required />
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
        </form>
        {{-- <table id="table" class="table">
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
                @foreach ($data->mekaniks as $mekanik)
                <tr>
                    <td>{{ $no++ }}</td>
        <td>{{ $mekanik->user->nrp }}</td>
        <td>{{ $mekanik->user->name }}</td>
        <td>{{ $mekanik->grade }}</td>
        <td>{{ $mekanik->status }}</td>
        <td>{{ $mekanik->section }}</td>
        <td>
            <a href="javascript:void(0)" onclick="confirmDelete({{ $mekanik->id }})" class="bg-label-danger badge">
                <span class="tf-icons bx bx-trash"></span> Delete
            </a>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table> --}}
    </div>
</div>
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

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
    form.action = '/mekanik/' + id;
    form.submit();
    } else {
    console.error("Form with ID 'deleteForm' not found.");
    }
    }
    });
    }
</script>
@endsection

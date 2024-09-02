@extends('layouts.app')
@section('title', 'List Users')
@section('content')
<div class="d-flex justify-content-between py-3 mb-4">
    <h4 class="fw-bold "><span class="text-muted fw-light">Databank /</span> List Databank</h4>
</div>
<div class="card p-3">
    {{-- <form action="{{ route('databank.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-end mb-3">
            <div class="d-flex gap-3">
                <input type="file" class="form-control " id="basic-default-name" name="excel" placeholder="Name"
                    accept=".xlsx,.xls,.csv" required />
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </div>
    </form> --}}
    <div class="table-responsive text-nowrap">
        <table id="table" class="table">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Name</th>
                    <th style="width: 10%">Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @php
                $no = 1
                @endphp
                @foreach ($datas as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->name }}</td>
                    <td>
                        <a href="{{ route('databank.show', $data->id) }}" class="bg-label-info badge">
                            <span class="tf-icons bx bx-show"></span> Show
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

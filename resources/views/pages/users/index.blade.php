@extends('layouts.app')
@section('title', 'List Users')
@section('content')
<div class="d-flex justify-content-between py-3 mb-4">
    <h4 class="fw-bold "><span class="text-muted fw-light">Users /</span> List Users</h4>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Add Users</a>
</div>
<div class="card p-3">
    <div class="table-responsive text-nowrap">
        <table id="table" class="table">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Name</th>
                    <th>Email</th>
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
                    <td>{{ $data->email }}</td>
                    <td>
                        <a href="{{ route('users.show', $data->id) }}" class="bg-label-info badge">
                            <span class="tf-icons bx bx-show"></span> Show
                        </a>
                        <a href="{{ route('users.edit', $data->id) }}" class="bg-label-warning badge">
                            <span class="tf-icons bx bx-edit"></span> Edit
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

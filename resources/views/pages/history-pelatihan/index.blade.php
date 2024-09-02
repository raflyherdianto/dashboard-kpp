@extends('layouts.app')
@section('title', 'List Users')
@section('content')
<div class="d-flex justify-content-between py-3 mb-4">
    <h4 class="fw-bold "><span class="text-muted fw-light">History Pelatihan /</span> List History Pelatihan</h4>
    <a href="{{ route('history-pelatihan.create') }}" class="btn btn-primary">Add Data</a>
</div>
<div class="card p-3">
    {{-- <form action="{{ route('history-pelatihan.import') }}" method="POST" enctype="multipart/form-data">
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
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Distrik</th>
                    <th>Department</th>
                    <th>Posisi</th>
                    <th>Lokasi</th>
                    <th>Pelatihan</th>
                    <th>Awal</th>
                    <th>Akhir</th>
                    <th>Kompetensi</th>
                    <th>Instruktur</th>
                    <th>Status</th>
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
                    <td>{{ $data->mekanik->nrp ?? '-' }}</td>
                    <td>{{ $data->mekanik->name ?? '-' }}</td>
                    <td>{{ $data->site->name ?? '-' }}</td>
                    <td>{{ $data->department->name ?? '-' }}</td>
                    <td>{{ $data->mekanik->roles[0]->name ?? '-' }}</td>
                    <td>{{ $data->location ?? '-' }}</td>
                    <td>{{ $data->pelatihan->name ?? '-' }}</td>
                    <td>{{ $data->start_date ?? '-' }}</td>
                    <td>{{ $data->end_date ?? '-' }}</td>
                    <td>{{ $data->sub_egi ?? '-' }}</td>
                    <td>{{ $data->instruktur->name ?? '-' }}</td>
                    <td>{{ $data->status ?? '-' }}</td>
                    <td>
                        <a href="{{ route('pelatihan.show', $data->id) }}" class="bg-label-warning badge">
                            <span class="tf-icons bx bx-edit"></span> Edit
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
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
    });
</script>
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
    form.action = '/pelatihan/' + id;
    form.submit();
    } else {
    console.error("Form with ID 'deleteForm' not found.");
    }
    }
    });
    }
</script>
@endsection

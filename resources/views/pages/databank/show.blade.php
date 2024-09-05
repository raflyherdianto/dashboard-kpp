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
        <form action="{{ route('score.import') }}" method="POST" enctype="multipart/form-data">
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
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 5%" class="text-center">No</th>
                    <th>Competence</th>
                    @foreach ($subEgis as $subEgi)
                    <th>{{ $subEgi->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($competences as $competence)
                <tr style="background: black;color: white">
                    <td class="text-center">{{ $competence->code }}</td>
                    <td>{{ $competence->name }}</td>
                    @foreach ($subEgis as $subEgi)
                    <td></td>
                    @endforeach
                </tr>
                @foreach ($competence->competence_sub_competences as $data)
                <tr>
                    <td class="text-center">{{ $data->code }}</td>
                    <td>{{ $data->subCompetence->name }}</td>
                    @foreach ($data->competenceScore as $score)
                    <td style="{{ $score->score == 0 ? 'background-color: black;' : '' }}">
                        {{ $score->score != 0 ? $score->score : '' }}
                    </td>
                    @endforeach
                </tr>
                @endforeach
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

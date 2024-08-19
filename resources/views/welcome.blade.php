@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            {{-- <h5 class="card-title text-primary fw-bold">Welcome back, {{ auth()->user()->name }}!
                            🎉
                            </h5> --}}
                            <p class="mb-4">
                                Dashboard - Absensi KPU | Sistem dashboard yang digunakan untuk memantau kehadiran,
                                laporan, dan penilaian karyawan secara
                                real-time dan terperinci.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="/assets/img/illustrations/attendance.jpg" height="150" alt="View Badge User" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="/assets/img/user.png" alt="chart success" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Users</span>
                            <h4 class="card-title mb-2"> Users</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="/assets/img/attendance.png" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Attendance Today</span>
                            <h4 class="card-title mb-2">Attendance</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="/assets/img/report.png" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Report Today</span>
                            <h4 class="card-title mb-2"></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="/assets/img/section.png" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Bidang</span>
                            <h4 class="card-title mb-2"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
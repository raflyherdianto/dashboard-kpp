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
                                Dashboard - {{ config('app.name') }} | Sistem dashboard yang digunakan untuk memantau
                                kehadiran,
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
                <div class="card p-3 mb-3">
                    <div id="grades-chart"></div>
                </div>
                <div class="card p-3">
                    <h3>List Mekanik</h3>
                    <div class="table-responsive text-nowrap">
                        <table id="table" class="table">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>NRP</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Grade</th>
                                    <th style="width: 10%">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @php
                                $no = 1
                                @endphp
                                @foreach ($users as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nrp }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->grade }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $data->id) }}" class="bg-label-info badge">
                                            <span class="tf-icons bx bx-show"></span> Show
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.49.1/apexcharts.min.js"
        integrity="sha512-qiVW4rNFHFQm0jHli5vkdEwP4GPSzCSp85J7JRHdgzuuaTg31tTMC8+AHdEC5cmyMFDByX639todnt6cxEc1lQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        // Data dari variabel PHP
        var grades = @json($grades);
        var amounts = @json($amounts);

        // Konfigurasi ApexCharts
        var options = {
            chart: {
                type: 'bar', // Tipe chart: column/bar
                height: 350
            },
            series: [{
                name: 'Jumlah Mekanik',
                data: amounts
            }],
            xaxis: {
                categories: grades, // Label x-axis
                title: {
                    text: 'Grades'
                }
            },
            plotOptions: {
            bar: {
            borderRadius: 10,
            dataLabels: {
            position: 'top', // top, center, bottom
            },
            }
            },
            dataLabels: {
            enabled: true,
            formatter: function (val) {
            return val;
            },
            offsetY: -20,
            style: {
            fontSize: '12px',
            colors: ["#304758"]
            }
            },
            yaxis: {
                title: {
                    text: 'Jumlah Users'
                }
            },
            stroke: {
                width: 1,
                colors: ['#000']
            },
            // dataLabels: {
            //     enabled: true
            // },
            grid: {
                yaxis: {
                    lines: {
                        show: true
                    }
                },
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#grades-chart"), options);
        chart.render();
    });
    </script>

@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')

@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="javascript:" class="text-muted text-hover-primary">الرئيسية</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">لوحة التحكم</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">الرئيسية</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <!-- Total Drivers Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">إجمالي السائقين</p>
                            <h4 class="mb-0">{{ $totalDrivers }}</h4>
                        </div>
                        <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-primary">
                            <span class="avatar-title">
                                <i class="bx bx-car font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top">
                    <div class="text-center">
                        <a href="{{ route('admin.drivers.index') }}" class="btn btn-outline-light btn-sm">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">إجمالي المستخدمين</p>
                            <h4 class="mb-0">{{ $totalUsers }}</h4>
                        </div>
                        <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-success">
                            <span class="avatar-title">
                                <i class="bx bx-user font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top">
                    <div class="text-center">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light btn-sm">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Trips Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">إجمالي الرحلات</p>
                            <h4 class="mb-0">{{ $totalTrips }}</h4>
                        </div>
                        <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-info">
                            <span class="avatar-title">
                                <i class="bx bx-map font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top">
                    <div class="text-center">
                        <a href="{{ route('admin.trips.index') }}" class="btn btn-outline-light btn-sm">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">إجمالي الإيرادات</p>
                            <h4 class="mb-0">{{ number_format($totalRevenue, 2) }} جنية</h4>
                        </div>
                        <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-warning">
                            <span class="avatar-title">
                                <i class="bx bx-money font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top">
                    <div class="text-center">
                        <a href="" class="btn btn-outline-light btn-sm">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Trips Chart -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">إحصائيات الرحلات</h4>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="text-muted">
                                <div class="mb-4">
                                    <p>إجمالي الرحلات هذا الشهر</p>
                                    <h5>{{ $tripsThisMonth }}</h5>
                                </div>
                                <div>
                                    <p>متوسط الرحلات اليومي</p>
                                    <h5>{{ $averageDailyTrips }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div id="trips-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Drivers -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">أحدث السائقين</h4>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>الاسم</th>
                                <th>رقم الهاتف</th>
                                <th>تاريخ التسجيل</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latestDrivers as $driver)
                                <tr>
                                    <td>{{ $driver->name }}</td>
                                    <td>{{ $driver->country_code . $driver->phone }}</td>
                                    <td>{{ Carbon\Carbon::parse($driver->created_at)->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Trips and Users Row -->
    <div class="row">
        <!-- Latest Trips -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">أحدث الرحلات</h4>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>رقم الرحلة</th>
                                <th>اسم السائق</th>
                                <th>اسم المستخدم</th>
                                <th>المبلغ</th>
                                <th>التاريخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latestTrips as $trip)
                                <tr>
                                    <td>{{ $trip->id }}</td>
                                    <td>{{ $trip->driver ? $trip->driver->name : 'غير متاح' }}</td>
                                    <td>{{ $trip->user ? $trip->user->name : 'غير متاح' }}</td>
                                    <td>{{ $trip->cost }} جنية</td>
                                    <td>{{ Carbon\Carbon::parse($trip->created_at)->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Users -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">أحدث المستخدمين</h4>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>رقم الهاتف</th>
                                <th>تاريخ التسجيل</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latestUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->country_code . $user->phone }}</td>
                                    <td>{{ Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>
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

@section('extra-js')
    <!-- apexcharts -->
    <script src="{{ asset('admin_assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Trips Chart
            var options = {
                chart: {
                    height: 360,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                series: [{
                    name: 'الرحلات',
                    data: @json($tripChartData)
                }],
                xaxis: {
                    categories: @json($tripChartLabels),
                },
                colors: ['#556ee6'],
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: true
                    },
                    marker: {
                        show: false
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#trips-chart"), options);
            chart.render();
        });
    </script>
@endsection

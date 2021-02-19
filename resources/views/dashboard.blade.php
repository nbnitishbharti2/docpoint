@extends('layouts.backend')
@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-primary border-primary">
                            <i class="fe fe-users"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $doc_count }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Doctors</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-success">
                            <i class="fe fe-credit-card"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $total_patient_count }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Patients</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-danger border-danger">
                            <i class="fe fe-money"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $total_appointment_count }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Appointment</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-warning border-warning">
                            <i class="fe fe-folder"></i>
                        </span>
                        <div class="dash-count">
                            <h3>$62523</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Revenue</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- box end -->

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <!-- Sales Chart -->
            <div class="card card-chart">
                <div class="card-header">
                    <h4 class="card-title">Appointments</h4>
                </div>
                <div class="card-body">
                    <div id="morrisArea"></div>
                </div>
            </div>
            <!-- /Sales Chart -->

        </div>
        <div class="col-md-12 col-lg-6">

            <!-- Invoice Chart -->
            <div class="card card-chart">
                <div class="card-header">
                    <h4 class="card-title">Status</h4>
                </div>
                <div class="card-body">
                    <div id="morrisLine"></div>
                </div>
            </div>
            <!-- /Invoice Chart -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 d-flex">
            <!-- Recent Orders -->
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h4 class="card-title">New Doctors</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Doctor Name</th>
                                    <th>Speciality</th>
                                    <th>City</th>
                                    <th>Mobile</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_doctors as $doctor)
                                    <tr>
                                        <td>{{ $doctor->name }}</td>
                                        <td>{{ $doctor->speciality->spec_name }}</td>
                                        <td>{{ $doctor->city->name }}</td>
                                        <td>{{ $doctor->mobile }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Recent Orders -->

        </div>
        <div class="col-md-6 d-flex">
            <!-- Feed Activity -->
            <div class="card  card-table flex-fill">
                <div class="card-header">
                    <h4 class="card-title">Recent Patients</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Phone</th>
                                    <th>Last Visit</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_patients as $patient)
                                    <tr>
                                        <td>{{ $patient->user->name }}</td>
                                        <td>{{ $patient->user->mobile }}</td>
                                        <td>{{ $patient->appointment_date }}</td>
                                        <td>{{ $patient->doctors->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Feed Activity -->
        </div>
    </div>
    <!-- box end -->
    <div class="row">
        <div class="col-md-12">
            <!-- Recent Orders -->
            <div class="card card-table">
                <div class="card-header">
                    <h4 class="card-title">Today's Appointment</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="today_appointments">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Patient Name</th>
                                    <th>Purpose</th>
                                    <th>Patient Type</th>
                                    <th>Apointment Type</th>
                                    <th>Date & Time</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $value)
                                    <tr>
                                        <td>{{ Str::ucfirst($value->doctors->name) }}</td>
                                        <td>{{ Str::ucfirst($value->user->name) }}</td>
                                        <td>{{ Str::ucfirst($value->reason->name) }}</td>
                                        <td>{{ Str::ucfirst($value->patient_type) }}</td>
                                        <td>{{ Str::ucfirst($value->appointment_type) }}</td>
                                        <td>{{ date("d-m-Y h:i A", strtotime($value->appointment_slot->slot_date_time)) }}</td>
                                        <td> 
                                            {{ Str::ucfirst($value->status) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Recent Orders -->
        </div>
    </div>
    <script  src="{{ asset('public/admin/assets/js/custom.js')}}"></script>
    <script>
        var datas = "{!! $doctor_patient !!}";
        data = JSON.stringify(datas);
        value = data.replace(/^"|"$/g, '');
        console.log(value);
    </script>
@endsection
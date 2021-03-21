@extends('layouts.frontend')
@section('title', 'MyDocPoint | Doctors Details')
@section('content')
<!-- doctor main detail -->  
 
<section>
    <div class="doctor-main-detail">
        <div class="container sml-container">
            <div class="row no-gutters">
                <div class="col-lg-12 pos-static pr-12">
                    <!-- doctor detail -->
                    <div class="doctor-detail">
                        <div class="doctor-img-wrap">
                            <img src="{{ asset('public/storage/frontend/img/user-card.png') }}" alt="doctor image">
                            <!-- image container -->
                            <div class="image-container">
                                <img src="{{ asset('public/storage/frontend/img/user-card.png') }}" alt="doctor image">
                                <img src="{{ asset('public/storage/frontend/img/img1.jpg') }}" alt="doctor">
                                <img src="{{ asset('public/storage/frontend/img/img2.jpg') }}" alt="doctor">
                                <img src="{{ asset('public/storage/frontend/img/img3.jpg') }}" alt="doctor">
                                <img src="{{ asset('public/storage/frontend/img/img4.jpg') }}" alt="doctor">
                                <img src="{{ asset('public/storage/frontend/img/img5.jpg') }}" alt="doctor">
                                <img src="{{ asset('public/storage/frontend/img/img6.jpg') }}" alt="doctor">
                                <img src="{{ asset('public/storage/frontend/img/img7.jpg') }}" alt="doctor">
                            </div>
                            <!-- image container end -->
                            <h4 class="img-count">8 images</h4>
                        </div>
                        <!-- doctor info -->
                        <div class="doctor-info">
                            <h2>{{ $booking->doctors->name }}</h2>
                            <h4>Internist, Primary Care Doctor</h4>
                            <h3>{{ Str::ucfirst($booking->doctors->address) }}</h3>
                            
                        </div>
                        <!-- doctor info end -->
                    </div>
                    <!-- doctor detail end -->

                    <!-- doctor services -->
                    <div class="doctor-services row">
                        <div class="col-lg-6">
                            <!-- doctor service item -->
                            <div class="doctor-service-item">
                                <i class="icofont-paperclip"></i>
                                <div class="service-txt">
                                    <h4>Accepting new patients</h4>
                                    <p>New patient appointments available</p>
                                </div>
                            </div>
                            <!-- doctor service item end -->
                        </div>

                        <div class="col-lg-6">
                            <!-- doctor service item -->
                            <div class="doctor-service-item">
                                <i class="icofont-refresh"></i>
                                <div class="service-txt">
                                    <h4>Patients often return</h4>
                                    <p>More patients return than other local providers</p>
                                </div>
                            </div>
                            <!-- doctor service item end -->
                        </div>

                        <div class="col-lg-6">
                            <!-- doctor service item -->
                            <div class="doctor-service-item">
                                <i class="icofont-history"></i>
                                <div class="service-txt">
                                    <h4>Excellent wait time</h4>
                                    <p>New patient appointments available</p>
                                </div>
                            </div>
                            <!-- doctor service item end -->
                        </div>

                        <div class="col-lg-6">
                            <!-- doctor service item -->
                            <div class="doctor-service-item">
                                <i class="icofont-hospital"></i>
                                <div class="service-txt">
                                    <h4>Saint Luke's-Roosevelt Hospita... <span data-toggle="tooltip"
                                            data-placement="top" title="Saint luke's-Rossevelt hospital center"><i
                                                class="icofont-info-circle"></i></span></h4>
                                    <p>The provider is affiliated with this hospital</p>
                                </div>
                            </div>
                            <!-- doctor service item end -->
                        </div>
                    </div>
                    <!-- doctor services end -->

                    

                 
 
                </div>
                <form action="{{route('doctor.payment.option.save',$id)}}" method="post">
                            @csrf
                <div class="col-lg-12">
                    <!-- side card -->
                    <div class="side-card">
                        <h3>Your booked appoinment details</h3>
                         <div class="row">
                             <div class="col-lg-6 col-md-6">
                                 <label><b>Resion: </b>{{ $booking->reason->name }}</label>
                             </div>
                             <div class="col-lg-6 col-md-6">
                                   <label><b>Appointment Type: </b>{{ $booking->appointment_type }}</label>
                             </div>
                             <div class="col-lg-6 col-md-6">
                                 <label><b>Appointment Date: </b>{{ $booking->appointment_date }}</label>
                             </div>
                             <div class="col-lg-6 col-md-6">
                                   <label><b>Appointment Time: </b>{{ $booking->appointment_slot->slot_time }}</label>
                             </div>
                             <div class="col-lg-6 col-md-6">
                                 <label><b>Charge: </b>{{ $charge['charge'] }}</label>
                             </div>
                             <div class="col-lg-6 col-md-6">
                                   <label><b>Payment Mode: </b>
                                    <div class="seen-check">
                            <div class="seen-check"> 
                                @if($charge['status_online']==1)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_type" id="payment_type_online" value="online" checked>
                                <label class="form-check-label" for="payment_type_online">
                                    Online 
                                </label>
                            </div> 
                            @endif
                             @if($charge['status_cash']==1)
                                <div class="form-check">
                                    <input class="form-check-input"  type="radio" name="payment_type" id="payment_type_cash" value="cash">
                                    <label class="form-check-label" for="payment_type_cash">
                                        Cash
                                    </label>
                                </div> 
                                @endif
                                
                        </div>
                        </div></label>
                             </div>
                         </div>
                        <button type="submit" class="continue-button">Continue Payment</button>
                    </div>
                    <!-- side card end -->
                </div>
            </form>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
     
</script>
<!-- doctor main detail end -->
@endsection
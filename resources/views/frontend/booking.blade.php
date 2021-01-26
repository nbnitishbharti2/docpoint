@extends('layouts.frontend')
@section('title', 'MyDocPoint | Doctors Details')
@section('content')
<!-- doctor main detail -->
<?php $doctor_id_list=array(); 
//dd($sloat->doctor->id);
 array_push($doctor_id_list, $sloat->doctor->id);
  ?>
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
                            <h2>{{ $sloat->doctor->name }}</h2>
                            <h4>Internist, Primary Care Doctor</h4>
                            <h3>{{ Str::ucfirst($sloat->doctor->address) }}</h3>
                            <ul class="pills-wrap">
                                <li class="pills"><i class="icofont-user"></i>
                                    <p>In-person visits</p>
                                </li>
                                <li class="pills"><i class="icofont-video"></i>
                                    <p>Video visits</p>
                                </li>
                            </ul>
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
                <div class="col-lg-12">
                    <!-- side card -->
                    <div class="side-card">
                        <h3>Book an appointment for free</h3>
                        {{-- <h5>What's your insurance plan?</h5>
                        <div class="insurance-plan-search">
                            <select class="search-dropdown">
                                <option value="1">I'm paying for myself</option>
                                <option value="2">Other one is paying for me</option>
                                <option value="3">choose other options</option>
                            </select>
                        </div> --}}

                        <h5>What's the reason for your visit?</h5>
                        <select>
                            <optgroup label="Popular Visit Reasons">
                                <option value="83">General Consultation</option>
                                <option selected="" value="75">Illness</option>
                                <option value="2551">New Patient Visit</option>
                                <option value="367">Pre-Travel Consultation</option>
                                <option value="123">Sports Injury</option>
                            </optgroup>
                            <optgroup label="All Visit Reasons">
                                <option value="1063">Abdominal Pain</option>
                                <option value="1032">Acid Reflux / Heartburn</option>
                                <option value="422">Ankle Problems</option>
                                <option value="2970">Annual Check Up</option>
                                <option value="494">Anxiety</option>
                                <option value="1812">Back Pain</option>
                                <option value="122">Back Problems</option>
                                <option value="1894">Bladder and Bowel Management</option>
                                <option value="2477">Blood Work</option>
                                <option value="2001">Bowel and Bladder Management</option>
                                <option value="2153">Breast Cancer High Risk Screening</option>
                                <option value="2162">Breast Cancer Screening</option>
                                <option value="390">Bronchitis</option>
                                <option value="1175">Bruise / Contusion</option>
                                <option value="194">Cardiovascular Screening Visit</option>
                                <option value="3290">Chronic Cough</option>
                                <option value="2520">Chronic Illness</option>
                                <option value="3193">Cold</option>
                                <option value="3211">Cold Sores / Herpes Labialis</option>
                                <option value="1462">Concussion</option>
                                <option value="1600">Constipation</option>
                                <option value="3194">Cough</option>
                                <option value="1624">Dehydration</option>
                                <option value="370">Diabetes Consultation</option>
                                <option value="1332">Diabetes Follow Up</option>
                                <option value="1117">Diarrhea</option>
                                <option value="468">Dizziness</option>
                                <option value="121">Elbow Problems</option>
                                <option value="1052">Fainting / Syncope</option>
                                <option value="1019">Fever</option>
                                <option value="1705">Flu</option>
                                <option value="134">Flu Shot</option>
                                <option value="106">Foot Problems</option>
                                <option value="1432">Gall Bladder Problem</option>
                                <option value="1309">General Follow Up</option>
                                <option value="499">Headache</option>
                                <option value="1072">Hemorrhoids</option>
                                <option value="125">Hip Problems</option>
                                <option value="2620">Hospital Discharge/Follow Up</option>
                                <option value="1781">Infection Follow Up</option>
                                <option value="1796">Itching</option>
                                <option value="1129">Jaundice</option>
                                <option value="1023">Joint Pain</option>
                                <option value="1801">Joint Problem </option>
                                <option value="124">Knee Problems</option>
                                <option value="4070">LGBT Care</option>
                                <option value="1177">Ligament Sprain</option>
                                <option value="3631">Lower Extremity Pain</option>
                                <option value="3632">Lower Extremity Swelling</option>
                                <option value="3213">Measles / Rubeola</option>
                                <option value="2621">Medicare Annual Wellness Visit</option>
                                <option value="1176">Muscle Strain</option>
                                <option value="192">Nail Abnormality</option>
                                <option value="1886">Nausea and Vomiting</option>
                                <option value="1888">Neck Pain</option>
                                <option value="1889">Neck Problems</option>
                                <option value="2728">Nose Bleed / Epistaxis</option>
                                <option value="1207">Nutrition Consultation</option>
                                <option value="2501">Postpartum Depression</option>
                                <option value="509">Pre-Surgery Checkup / Pre-Surgical Clearance</option>
                                <option value="78">Pre-Travel Checkup</option>
                                <option value="1331">Pre-Travel Follow Up</option>
                                <option value="504">Rash</option>
                                <option value="1020">Severe Infection</option>
                                <option value="150">Sexually Transmitted Disease (STD)</option>
                                <option value="3219">Shortness of Breath / Difficulty in Breathing</option>
                                <option value="2413">Shoulder Pain</option>
                                <option value="161">Shoulder Problem</option>
                                <option value="2366">Skin Problem </option>
                                <option value="2907">Stiffness</option>
                                <option value="1029">Stomach Pain</option>
                                <option value="3381">Stomach Ulcer</option>
                                <option value="2522">Suture Removal</option>
                                <option value="2906">Swelling</option>
                                <option value="3931">Swelling in Legs</option>
                                <option value="228">Tingling / Numbness / Weakness</option>
                                <option value="3844">Tiredness / Fatigue </option>
                                <option value="1536">Type 1 Diabetes</option>
                                <option value="3038">Type 2 Diabetes</option>
                                <option value="1550">Urology Problem </option>
                                <option value="421">Wrist Problems</option>
                                <option value="2642">Yearly Wellness Visit (For Medicare Patients)</option>
                            </optgroup>
                        </select>

                        <h5>Has the patient seen this doctor before?</h5>
                        <div class="seen-check">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="patient_type" id="yes" value="option1" checked>
                                <label class="form-check-label" for="yes">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="patient_type" id="no" value="option2">
                                <label class="form-check-label" for="no">
                                    No
                                </label>
                            </div>
                        </div>


                        <h5>Choose the type of appointment</h5>
                        <div class="seen-check">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="appointment_type" id="inperson" value="option1" checked>
                                <label class="form-check-label" for="inperson">
                                    In-person
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="appointment_type" id="videovisit" value="option2">
                                <label class="form-check-label" for="videovisit">
                                    Video visit
                                </label>
                            </div>
                        </div>

                        
                        <button class="continue-button">Continue booking</button>
                    </div>
                    <!-- side card end -->
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
     
</script>
<!-- doctor main detail end -->
@endsection
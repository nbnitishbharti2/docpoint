@extends('layouts.frontend')
@section('title', 'MyDocPoint | Doctors Details')
@section('content')
@include('layouts.message')
<!-- doctor main detail -->
@php
    $doctor_id_list=array();
    array_push($doctor_id_list, $doctors->id);
@endphp
<section>
    <div class="doctor-main-detail">
        <div class="container sml-container">
            <div class="row no-gutters">
                <div class="col-lg-8 pos-static pr-4">
                    <!-- doctor detail -->
                    <div class="doctor-detail">
                        <div class="doctor-img-wrap">
                            <img class="user-img d-desktop-for-phone" src="{{ ($doctors->pic && file_exists('public/storage/images/doctor/'.$doctors->pic)) ? asset('public/storage/images/doctor/'.$doctors->pic) : asset('public/storage/images/doctor/images.jpg') }}" alt="doctor image">
                            <!-- image container -->
                        </div>
                        <!-- doctor info -->
                        <div class="doctor-info">
                            <h2>{{ 'Dr. ' .$doctors->name }}</h2>
                            <h4>Internist, Primary Care Doctor</h4>
                            <h3>{{ Str::ucfirst($doctors->address) }}</h3>
                          
                            <ul class="pills-wrap">
                                @if($doctors->physical == "Yes")
                                    <li class="pills"><a href="javascript:void(0)" onclick="more_desktop_change_type('Physical')"><i class="icofont-user" ></i><p>In-person visits</p></a></li>
                                @endif
                                @if($doctors->video == "Yes")
                                    <li class="pills"><a href="javascript:void(0)" onclick="more_desktop_change_type('Video')"><i class="icofont-video" ></i><p>Video visits</p></a></li>
                                @endif
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
                                    <h4>Saint Luke's-Roosevelt Hospita... 
                                        <span data-toggle="tooltip" data-placement="top" title="Saint luke's-Rossevelt hospital center"><i class="icofont-info-circle"></i></span>
                                    </h4>
                                    <p>The provider is affiliated with this hospital</p>
                                </div>
                            </div>
                            <!-- doctor service item end -->
                        </div>
                    </div>
                    <!-- doctor services end -->

                    <!-- rating and reviews -->
                    <div class="rrv">
                        <!-- doctor rating -->
                        <div class="doc-rating">
                            <h5>Overall rating</h5>
                            @if(count($doctor_reviews)>0)
                                <h2>{{ number_format((float)((($waiting_total+$rate_total) / count($doctor_reviews)) /2), 2, '.', '') }}</h2>
                            @else
                                <h2>0</h2>
                            @endif
                            <!-- rating -->
                            @if(count($doctor_reviews)>0)
                                <div class="star-div disabled" data-rating="{{ number_format((float)((($waiting_total+$rate_total) / count($doctor_reviews)) /2), 2, '.', '') }}">
                            @else
                                <div class="star-div disabled" data-rating="0">
                            @endif
                            
                                <i class="star star-under icofont-star" star-data="1"><i class="star star-over icofont-star"></i></i>
                                <i class="star star-under icofont-star" star-data="2"><i class="star star-over icofont-star"></i></i>
                                <i class="star star-under icofont-star" star-data="3"><i class="star star-over icofont-star"></i></i>
                                <i class="star star-under icofont-star" star-data="4"><i class="star star-over icofont-star"></i></i>
                                <i class="star star-under icofont-star" star-data="5"><i class="star star-over icofont-star"></i></i>
                            </div>
                            <!-- rating end -->
                            <a class="reviews-counts" href="#all_reviews">{{ count($doctor_reviews) }} Reviews</a>
                        </div>
                        <!-- doctor rating end -->

                        <!-- recent reviews -->
                        <div class="recent-reviews">
                            <h5>Recent reviews</h5>
                            @foreach ($doctor_reviews as $key => $review)
                                @if ($key == 2)
                                    @php
                                        break;
                                    @endphp
                                @endif
                                <!-- review item -->
                                <div class="rrv-review-item">
                                    <div class="para-div">
                                        <p class="two-line-clamp">{{ $review->review_desc }}</p>
                                    </div>
                                    <p class="reviewer-info"><span>{{ Str::ucfirst($review->user->name) }}</span><span>{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                        {{-- <span><i class="icofont-video"></i>Video visit</span></p> --}}
                                </div>
                                <!-- review item end -->
                                
                            @endforeach
                            <a class="more-review-btn" href="#all_reviews">Read more reviews</a>
                        </div>
                        <!-- recent reviews end -->
                    </div>
                    <!-- rating and revviews end -->

                    <!-- accordian -->
                    <div class="accordion" id="doctorDetailAccord">
                        <!-- card -->
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-controls="collapseOne">
                                        {{ 'About Dr. ' .$doctors->name }}
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                data-parent="#doctorDetailAccord">
                                <div class="card-body">
                                    <p>
                                        *Please expect communication from the office before coming to appointment<br>
                                        *New Patients should arrive 15 minutes early to fill out paperwork<br>
                                        *Annual Physicals cannot be done at an illness visit<br>
                                        *For all HMO plans Dr. Bagner needs to be the Primary Doctor<br>
                                        *Patients will only be seen for Visit Reasons selected at booking<br>
                                    </p>
                                    <p>
                                        After graduating with honors from Rutgers University, Dr. Bagner received his
                                        medical degree from the University of Medicine and Dentistry of New Jersey. He
                                        completed a rotational internship at St. Barnabas Medical Center in New Jersey
                                        and then a residency in internal medicine at the Staten Island University
                                        Hospital in affiliation with the SUNY Downstate Medical School. He served as
                                        chief resident during his final year of residency.<br>
                                    </p>
                                    <p>
                                        After Graduation, Dr. Bagner worked in a private practice in New Jersey, and
                                        then was recruited to join the faculty practice at the Albert Einstein College
                                        of Medicine/Montefiore Medical Center, where he served as assistant professor of
                                        medicine. He did this until 2005, at which point he left to establish his
                                        current midtown practice.<br>
                                    </p>
                                    <p>
                                        Dr. Bagner practices all aspects of primary care/internal medicine. He has a
                                        particular interest in the evidence-based use of nutritional supplements.<br>
                                        He is also recognized for his compassionate care, addressing both the physical
                                        and psychological needs of his patients; and has been the recipient of numerous
                                        patient satisfaction awards.<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- card end -->

                        <!-- card -->
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Office location
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#doctorDetailAccord">
                                <div class="card-body">
                                    <!-- office location head -->
                                    <div class="office-loc-head">
                                        <i class="icofont-video"></i>
                                        <p>Dr. Michael Bagner, MD also offers online video visits for patients</p>
                                    </div>
                                    <!-- office location head end -->

                                    <!-- office location body -->
                                    <div class="office-loc-body">
                                        <div class="doctor-detail-map">
                                            <iframe
                                                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14005.312976982585!2d77.3688422515747!3d28.649888756853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1606557164317!5m2!1sen!2sin"
                                                width="450" height="300" frameborder="0" style="border:0;"
                                                allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                                            <div class="address-info">
                                                <h3>Mount Sinai Doctors</h3>
                                                <p>780 8th Avenue<br>
                                                    New York, NY 10036</p>
                                                <a href="#">Get directions</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- office location body end -->
                                </div>
                            </div>
                        </div>
                        <!-- card end -->

                        <!-- card -->
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Education and background
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                data-parent="#doctorDetailAccord">
                                <div class="card-body">
                                    <!-- inner item -->
                                    <div class="inr-item">
                                        <h4>Specialties</h4>
                                        <p>Internist</p>
                                        <p>Primary Care Doctor</p>
                                    </div>
                                    <!-- inner item end -->

                                    <!-- inner item -->
                                    <div class="inr-item">
                                        <h4>Practice names</h4>
                                        <a href="#">Mount Sinai Doctors</a>
                                    </div>
                                    <!-- inner item end -->

                                    <!-- inner item -->
                                    <div class="inr-item">
                                        <h4>Hospital affiliations</h4>
                                        <p>Saint Luke's-Roosevelt Hospital Center</p>
                                    </div>
                                    <!-- inner item end -->

                                    <!-- inner item -->
                                    <div class="inr-item">
                                        <h4>Board certifications</h4>
                                        <p>American Board of Internal Medicine</p>
                                    </div>
                                    <!-- inner item end -->

                                    <!-- inner item -->
                                    <div class="inr-item">
                                        <h4>Education and training</h4>
                                        <p>Medical School - University of Medicine and Dentistry of New Jersey, Doctor
                                            of Medicine</p>
                                        <p>Staten Island University Hospital, Residency in Internal Medicine</p>
                                    </div>
                                    <!-- inner item end -->

                                    <!-- inner item -->
                                    <div class="inr-item">
                                        <h4>Awards and publications</h4>
                                        <p>Patient Choice Award</p>
                                    </div>
                                    <!-- inner item end -->

                                    <!-- inner item -->
                                    <div class="inr-item">
                                        <h4>Languages spoken <span data-toggle="tooltip" data-placement="top"
                                                title="Languages Spoken in the provider's Office"><i
                                                    class="icofont-info-circle"></i></span></h4>
                                        <p>English</p>
                                    </div>
                                    <!-- inner item end -->

                                    <!-- inner item -->
                                    <div class="inr-item">
                                        <h4>Provider's gender</h4>
                                        <p>Male</p>
                                    </div>
                                    <!-- inner item end -->

                                    <!-- inner item -->
                                    <div class="inr-item">
                                        <h4>NPI number <span data-toggle="tooltip" data-placement="top"
                                                title="National Provider Identifiers (NPIs) are used to identify healthcare providers in a standard way throughout the United States."><i
                                                    class="icofont-info-circle"></i></span></h4>
                                        <p>1851352454</p>
                                    </div>
                                    <!-- inner item end -->
                                </div>
                            </div>
                        </div>
                        <!-- card end -->

                        <!-- card -->
                        <div class="card">
                            <div class="card-header" id="headingSix">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        Patient reviews
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                                data-parent="#doctorDetailAccord">
                                <div class="card-body">
                                    <p>All reviews have been submitted by patients after seeing the provider.</p>
                                    <ul class="review-rng">
                                        <li>
                                            <h4>Overall rating</h4>
                                            <!-- rating -->
                                                @if(count($doctor_reviews)>0)
                                                    <div class="star-div disabled" data-rating="{{ number_format((float)((($waiting_total+$rate_total) / count($doctor_reviews)) /2), 2, '.', '') }}">
                                                @else
                                                    <div class="star-div disabled" data-rating="0">
                                                @endif
                                                <i class="star star-under icofont-star" star-data="1"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="2"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="3"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="4"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="5"><i class="star star-over icofont-star"></i></i>
                                            </div>
                                            <!-- rating end -->
                                            
                                            @if(count($doctor_reviews)>0)
                                                <h3>{{ number_format((float)((($waiting_total+$rate_total) / count($doctor_reviews)) /2), 2, '.', '') }}</h3>
                                            @else
                                                <h3>0</h3>
                                            @endif
                                        </li>

                                        <li>
                                            <h4>Wait time</h4>
                                            <!-- rating -->
                                            @if(count($doctor_reviews)>0)
                                                <div class="star-div disabled" data-rating="{{ number_format((float)(($waiting_total) / count($doctor_reviews)), 2, '.', '') }}">
                                            @else
                                                <div class="star-div disabled" data-rating="1">
                                            @endif
                                            
                                                <i class="star star-under icofont-star" star-data="1"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="2"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="3"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="4"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="5"><i class="star star-over icofont-star"></i></i>
                                            </div>
                                            <!-- rating end -->
                                            @if(count($doctor_reviews)>0)
                                                <h3>{{ number_format((float)(($waiting_total) / count($doctor_reviews)), 2, '.', '') }}</h3>
                                            @else
                                                <h3>1</h3>
                                            @endif
                                        </li>

                                        {{-- <li>
                                            <h4>Bedside manner</h4>
                                            <!-- rating -->
                                            @if(count($doctor_reviews)>0)
                                                <div class="star-div disabled" data-rating="{{ number_format((float)(($rate_total) / count($doctor_reviews)), 2, '.', '') }}">
                                            @else
                                                <div class="star-div disabled" data-rating="1">
                                            @endif
                                            
                                                <i class="star star-under icofont-star" star-data="1"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="2"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="3"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="4"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="5"><i class="star star-over icofont-star"></i></i>
                                            </div>
                                            <!-- rating end -->
                                            
                                            @if(count($doctor_reviews)>0)
                                                <h3>{{ number_format((float)(($rate_total) / count($doctor_reviews)), 2, '.', '') }}</h3>
                                            @else
                                                <h3>1</h3>
                                            @endif
                                        </li> --}}
                                    </ul>

                                    <!-- note -->
                                    <div class="patient-note">
                                        <i class="icofont-shield"></i>
                                        <p>Your trust is our top concern, so providers can't pay to alter or remove
                                            reviews. We also don't publish reviews that contain any private patient
                                            health information. Learn more here <a href="#">Learn more here</a></p>
                                    </div>
                                    <!-- note end -->
                                </div>
                            </div>
                        </div>
                        <!-- card end -->

                    </div>
                    <!-- accordian end -->

                    <!-- all reviews -->
                    <div class="all_reviews" id="all_reviews">
                        <div class="reviews-head">
                            <h3>{{ count($doctor_reviews) }} reviews</h3>
                            <select>
                                <option>Most relevant</option>
                                <option>Highest rated</option>
                                <option>Lowest rated</option>
                                <option>Newest</option>
                                <option>Oldest</option>
                            </select>

                            <form class="review_search">
                                <input type="text" class="form-control" placeholder="search" required>
                                <button type="submit"><i class="icofont-search-1"></i></button>
                            </form>
                        </div>

                        <div class="main-review-container">
                            <!-- review item -->
                            @foreach ($doctor_reviews as $key => $review)
                                    @if ($key == 5)
                                        @php
                                            break;
                                        @endphp
                                    @endif
                                <div class="rrv-review-item">
                                    <!-- rating -->
                                    @if(count($doctor_reviews)>0)
                                        <div class="star-div disabled" data-rating="{{ number_format((float)(($review->wating_rate + $review->rate)/2), 2, '.', '') }}">
                                    @else
                                        <div class="star-div disabled" data-rating="1">
                                    @endif
                                    
                                        <i class="star star-under icofont-star" star-data="1"><i class="star star-over icofont-star"></i></i>
                                        <i class="star star-under icofont-star" star-data="2"><i class="star star-over icofont-star"></i></i>
                                        <i class="star star-under icofont-star" star-data="3"><i class="star star-over icofont-star"></i></i>
                                        <i class="star star-under icofont-star" star-data="4"><i class="star star-over icofont-star"></i></i>
                                        <i class="star star-under icofont-star" star-data="5"><i class="star star-over icofont-star"></i></i>
                                    </div>
                                    <!-- rating end -->
                                    <div class="para-div">
                                        <p class="two-line-clamp">{{ $review->review_desc }}</p>
                                    </div>
                                    <p class="reviewer-info">
                                        <span>{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                        <span>{{ $review->user->name }}</span>
                                        <span>Verified patient</span>
                                        {{-- <span><i class="icofont-video"></i>Video visit</span> --}}
                                    </p>
                                </div>
                            @endforeach
                            <!-- review item end -->
                            <div class="review-btm-options">
                                <a class="more-review-btn" href="#">Read more reviews</a>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user() && $review_status == 'Yes')
                        <form action="{{route('add.review')}}" method="post">
                            @csrf
                            <input type="hidden" name="doctor_id" value="{{$doctors->id}}">
                            <div class="all_reviews" id="all_reviews">
                                <div class="main-review-container"> 
                                    <div class="row no-gutters">
                                        <div class="col-lg-6 pos-static pr-4">
                                            <label>Wait time</label><br>
                                            <div class="star-div" id="wait_rating" data-rating="0" value="0" onchange="change_wait_rating();">
                                            <input type="hidden" name="wait_rating_count"  id="wait_rating_count">
                                                <i class="star star-under icofont-star" star-data="1"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="2"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="3"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="4"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="5"><i class="star star-over icofont-star"></i></i>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 pos-static pr-4">
                                            <label>Bedside manner</label><br>
                                            <div class="star-div " id="bedside_rating" data-rating="0" value="0">
                                                <input type="hidden" name="bedside_rating_count"  id="bedside_rating_count">
                                                <i class="star star-under icofont-star" star-data="1"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="2"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="3"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="4"><i class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="5"><i class="star star-over icofont-star"></i></i>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12 pos-static pr-4">
                                            <textarea name="review" class="form-control" rows="4" placeholder="Enter your review"></textarea> 
                                        </div>
                                    </div>
                                    
                                    <!-- review item end -->
                                    <div class="review-btm-options">
                                        <button class="more-review-btn" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                    <!-- all reviews end -->

                    <!-- find doctors -->
                    {{-- <div class="find-doctors">
                        <h4>Find doctors</h4>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="locations-tab" data-toggle="tab" href="#locations"
                                    role="tab" aria-controls="locations" aria-selected="true">Locations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="specialties-tab" data-toggle="tab" href="#specialties"
                                    role="tab" aria-controls="specialties" aria-selected="false">Specialties</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="procedures-and-treatments-tab" data-toggle="tab"
                                    href="#procedures-and-treatments" role="tab"
                                    aria-controls="procedures-and-treatments" aria-selected="false">Procedures and
                                    Treatments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="telemedicine-tab" data-toggle="tab" href="#telemedicine"
                                    role="tab" aria-controls="telemedicine" aria-selected="false">Telemedicine</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="locations" role="tabpanel"
                                aria-labelledby="locations-tab">
                                <ul>
                                    <li><a href="#">Theater District - Times Square, New York, NY Doctors</a></li>
                                    <li><a href="#">Garment District, New York, NY Doctors</a></li>
                                    <li><a href="#">Midtown Center, New York, NY Doctors</a></li>
                                    <li><a href="#">Clinton, New York, NY Doctors</a></li>
                                    <li><a href="#">Koreatown, New York, NY Doctors</a></li>
                                    <li><a href="#">Hell's Kitchen, New York, NY Doctors</a></li>
                                    <li><a href="#">Midtown, New York, NY Doctors</a></li>
                                    <li><a href="#">Tudor City, New York, NY Doctors</a></li>
                                    <li><a href="#">Midtown East, New York, NY Doctors</a></li>
                                    <li><a href="#">Midtown South Central, New York, NY Doctors</a></li>
                                    <li><a href="#">Lincoln Square, New York, NY Doctors</a></li>
                                    <li><a href="#">Sutton Place, New York, NY Doctors</a></li>
                                    <li><a href="#">Lenox Hill, New York, NY Doctors</a></li>
                                    <li><a href="#">Chelsea, NY Doctors</a></li>
                                    <li><a href="#">Flatiron District, New York, NY Doctors</a></li>
                                    <li><a href="#">More Locations</a></li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="specialties" role="tabpanel"
                                aria-labelledby="specialties-tab">
                                <ul>
                                    <li><a href="#">Allergist</a></li>
                                    <li><a href="#">Cardiologist</a></li>
                                    <li><a href="#">Dentist</a></li>
                                    <li><a href="#">Dermatologist</a></li>
                                    <li><a href="#">Ear, Nose & Throat Doctor</a></li>
                                    <li><a href="#">Gastroenterologist</a></li>
                                    <li><a href="#">OB-GYN</a></li>
                                    <li><a href="#">Ophthalmologist</a></li>
                                    <li><a href="#">Optometrist</a></li>
                                    <li><a href="#">Pediatrician</a></li>
                                    <li><a href="#">Podiatrist</a></li>
                                    <li><a href="#">Primary Care Doctor</a></li>
                                    <li><a href="#">Psychiatrist</a></li>
                                    <li><a href="#">Urologist</a></li>
                                    <li><a href="#">More Specialties</a></li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="procedures-and-treatments" role="tabpanel"
                                aria-labelledby="procedures-and-treatments-tab">
                                <ul>
                                    <li><a href="#">Illness</a></li>
                                    <li><a href="#">Abnormal ANA Testing</a></li>
                                    <li><a href="#">Active Leg Ulceration</a></li>
                                    <li><a href="#">Allergic Eye Problems</a></li>
                                    <li><a href="#">Nose Problems</a></li>
                                    <li><a href="#">Absence of Menstruation / Amenorrhea</a></li>
                                    <li><a href="#">Acute Coronary Syndrome</a></li>
                                    <li><a href="#">Alzheimer's Disease</a></li>
                                    <li><a href="#">Abdominal Cramps</a></li>
                                    <li><a href="#">Achilles Tendon Rupture</a></li>
                                    <li><a href="#">Acid Reflux / Heartburn</a></li>
                                    <li><a href="#">Active Leg Ulceration</a></li>
                                    <li><a href="#">Acute Coronary Syndrome</a></li>
                                    <li><a href="#">Acute Dysentery</a></li>
                                    <li><a href="#">Alcoholic Liver Disease</a></li>
                                    <li><a href="#">Allergic Eye Problems</a></li>
                                    <li><a href="#">Anaphylaxis / Allergy</a></li>
                                    <li><a href="#">More Procedures</a></li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="insurances" role="tabpanel" aria-labelledby="insurances-tab">
                                <ul>
                                    <li><a href="#">Aetna</a></li>
                                    <li><a href="#">UnitedHealthcare</a></li>
                                    <li><a href="#">Cigna</a></li>
                                    <li><a href="#">Anthem Blue Cross Blue Shield</a></li>
                                    <li><a href="#">UnitedHealthcare Oxford</a></li>
                                    <li><a href="#">Blue Cross Blue Shield of Illinois</a></li>
                                    <li><a href="#">Empire Blue Cross Blue Shield</a></li>
                                    <li><a href="#">EmblemHealth (formerly known as GHI)</a></li>
                                    <li><a href="#">Blue Cross Blue Shield of Texas</a></li>
                                    <li><a href="#">CareFirst Blue Cross Blue Shield</a></li>
                                    <li><a href="#">Blue Cross Blue Shield Federal Employee Program</a></li>
                                    <li><a href="#">Medicare</a></li>
                                    <li><a href="#">Horizon Blue Cross Blue Shield of New Jersey</a></li>
                                    <li><a href="#">Anthem Blue Cross</a></li>
                                    <li><a href="#">HealthFirst (NY)</a></li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="telemedicine" role="tabpanel"
                                aria-labelledby="telemedicine-tab">
                                <ul>
                                    <li><a href="#">Online Aetna Doctors</a></li>
                                    <li><a href="#">Online Anthem Blue Cross Blue Shield Doctors</a></li>
                                    <li><a href="#">Online Blue Cross Blue Shield Doctors</a></li>
                                    <li><a href="#">Online Cigna Doctors</a></li>
                                    <li><a href="#">Online Dermatologists</a></li>
                                    <li><a href="#">Online Dietitians</a></li>
                                    <li><a href="#">Online Doctors</a></li>
                                    <li><a href="#">Online Ear Nose and Throat Doctors</a></li>
                                    <li><a href="#">Online Florida Blue Cross Blue Shield Doctors</a></li>
                                    <li><a href="#">Online Kaiser Permanente Doctors</a></li>
                                    <li><a href="#">Online OB-GYNs</a></li>
                                    <li><a href="#">Online Optometrists</a></li>
                                    <li><a href="#">Online Psychiatrists</a></li>
                                    <li><a href="#">Online Therapists</a></li>
                                    <li><a href="#">Online UnitedHealthcare Doctors</a></li>
                                    <li><a href="#">Telemedicine</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                    <!-- find doctors end -->

                    <!-- bottom breadcrumb -->
                    <ul class="bottom-bread-crumb">
                        <li><a href="{{ url('/') }}">Mydocpoint</a></li>
                        <li><a href="{{ route('doctor.list') }}">Doctors</a></li>
                        <li>{{ 'Dr. ' .$doctors->name }}</li>
                    </ul>
                    <!-- bottom breadcrumb end -->
                </div>
                <div class="col-lg-4">
                    <!-- side card -->
                    <form method="post" action="{{ route('doctor.booking.save')}}">
                        @csrf
                   
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
                        <select name="resion">
                            <optgroup label="Popular Visit Reasons">
                                @foreach ( $popular_reason as $key => $val)
                                <option value="{{$val->reason_id}}">{{$val->reason->name}}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="All Visit Reasons">
                                @foreach ( $reason as $key => $val)
                                <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach 
                            </optgroup>
                        </select>

                        <h5>Has the patient seen this doctor before?</h5>
                        <div class="seen-check">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="patient_type" id="yes"  value="Existing"  checked>
                                <label class="form-check-label" for="yes">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="patient_type" id="no" value="New">
                                <label class="form-check-label" for="no">
                                    No
                                </label>
                            </div>
                        </div>


                        <h5>Choose the type of appointment</h5>
                        <div class="seen-check">
                            @if($doctors->physical == "Yes")
                            <div class="form-check">
                                <input class="form-check-input" onclick="more_desktop_change_type('Physical')" type="radio" name="appointment_type" id="inperson" value="In-Person" <?php echo ($appointment_type=='Physical')?'checked':'' ?>>
                                <label class="form-check-label" for="inperson">
                                    In-person
                                </label>
                            </div>
                            @endif
                            @if($doctors->video == "Yes")
                                <div class="form-check">
                                    <input class="form-check-input" onclick="more_desktop_change_type('Video')" type="radio" name="appointment_type" id="videovisit" value="Video" <?php echo ($appointment_type=='Video')?'checked':'' ?>>
                                    <label class="form-check-label" for="videovisit">
                                        Video visit
                                    </label>
                                </div>
                            @endif
                        </div>
                        <h5>Choose Booking Type</h5>
                        <div class="seen-check"> 
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="booking_type" id="normal_bookinh" value="In-Person" checked>
                                <label class="form-check-label" for="normal_bookinh">
                                    Normal 
                                </label>
                            </div> 
                            @if($premium==1)
                                <div class="form-check">
                                    <input class="form-check-input" onclick="check_premium()" type="radio" name="booking_type" id="premium_booking" value="Video">
                                    <label class="form-check-label" for="premium_booking">
                                        Premium
                                    </label>
                                </div> 
                                @endif
                        </div>

                        <h5>Select an available time</h5>
                        <div class="avliable-time">
                            <p>{{$doctors->address.', '.$doctors->city->name.', '.$doctors->state->name.', '.$doctors->country->name.', '.$doctors->zip}}</p>
                            <!-- date slider -->
                            <div class="owl-carousel date-slider" id="date-list">
                                 @for($i=0; $i<5; $i++)
                                    <div class="date-item"><p>{{ date("D",strtotime($date. ' +'.$i.' day')) }}</p><h5>{{ date("M d",strtotime($date. ' +'.$i.' day')) }}</h5></div>
                                @endfor
                               
                            </div>
                            <div class="slider-btns">
                                <span class="prev"><i class="icofont-rounded-left" onclick="more_desktop_date(0)"></i></span>
                                <span class="next"><i class="icofont-rounded-right" onclick="more_desktop_date(1)"></i></span>
                            </div>
                            <!-- date slider end -->
                            
                            <!-- time buttons -->
                            <ul class="time-btns d-desktop-for-tab" id="sloat-p{{ $doctors->id }}">
                                @php $sloat=\App\Models\AppointmentSlots::getSloat($doctors->id,$date,0,$sloat_id,$appointment_type); @endphp
                            </ul>
                            <!-- time buttons end -->
                            <input type="hidden" name="sloat" id="sloat-doctor-details" value="{{$sloat_id}}">
                        </div>
                        <button class="continue-button" type="submit">Continue booking</button>
                    </div>
                     </form>
                    <!-- side card end -->
                </div>
            </div>
        </div>
    </div>
</section>



<script type="text/javascript">
    var slot_url = "{{ route('get.doctor.appoinment.slot') }}";
    var change_type_slot_url = "{{ route('get.doctor.appoinment.slot.change.type') }}";
    var doctorlistid=<?php echo json_encode($doctor_id_list); ?>;
    var new_date=<?php echo date("Ymd",strtotime($date)); ?>;
    var date_slot_url = "{{ route('get.doctor.appoinment.slot.by.date') }}";
    var min_date=<?php echo date("Ymd",strtotime(date("d-m-Y"))); ?>;
    var date_list_start=<?php echo date("Ymd",strtotime($date)); ?>;
    var date_list_end=<?php echo date("Ymd",strtotime($date.'+3 days')); ?>;
    var page_type=0;
    var appoinment_type='<?php echo $appointment_type ?>';

    function change_wait_rating()
    {
        //alert('hi');
    }
</script>
@endsection
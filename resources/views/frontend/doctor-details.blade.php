@extends('layouts.frontend')
@section('title', 'MyDocPoint | Doctors Details')
@section('content')
<!-- doctor main detail -->
<section>
    <div class="doctor-main-detail">
        <div class="container sml-container">
            <div class="row no-gutters">
                <div class="col-lg-8 pos-static pr-4">
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
                            <h2>{{ $doctors->name }}</h2>
                            <h4>Internist, Primary Care Doctor</h4>
                            <h3>{{ Str::ucfirst($doctors->address) }}</h3>
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

                    <!-- rating and reviews -->
                    <div class="rrv">
                        <!-- doctor rating -->
                        <div class="doc-rating">
                            <h5>Overall rating</h5>
                            <h2>4.85</h2>
                            <!-- rating -->
                            <div class="star-div disabled" data-rating="4.85">
                                <i class="star star-under icofont-star" star-data="1"><i
                                        class="star star-over icofont-star"></i></i>
                                <i class="star star-under icofont-star" star-data="2"><i
                                        class="star star-over icofont-star"></i></i>
                                <i class="star star-under icofont-star" star-data="3"><i
                                        class="star star-over icofont-star"></i></i>
                                <i class="star star-under icofont-star" star-data="4"><i
                                        class="star star-over icofont-star"></i></i>
                                <i class="star star-under icofont-star" star-data="5"><i
                                        class="star star-over icofont-star"></i></i>
                            </div>
                            <!-- rating end -->
                            <a class="reviews-counts" href="#all_reviews">1529 Reviews</a>
                        </div>
                        <!-- doctor rating end -->

                        <!-- recent reviews -->
                        <div class="recent-reviews">
                            <h5>Recent reviews</h5>

                            <!-- review item -->
                            <div class="rrv-review-item">
                                <div class="para-div">
                                    <p class="two-line-clamp">A little confusion with the technology but no problem
                                        whatsoever once we got connected. The doctor is super personable.</p>
                                </div>
                                <p class="reviewer-info"><span>Jerome W.</span> <span>Less than 1 month ago</span>
                                    <span><i class="icofont-video"></i>Video visit</span></p>
                            </div>
                            <!-- review item end -->

                            <!-- review item -->
                            <div class="rrv-review-item">
                                <div class="para-div">
                                    <p class="two-line-clamp">Long wait, crowded office. Went for a yearly physical and
                                        saw him for a short time and he never refilled my prescription (which was the
                                        main reason for my yearly visit). His assistant was also unprofessional.</p>
                                </div>
                                <p class="reviewer-info"><span>Initials hidden</span></p>
                            </div>
                            <!-- review item end -->
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
                                        About Dr. Michael Bagner
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
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        In-network insurances
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#doctorDetailAccord">
                                <div class="card-body">
                                    <p>All providers on Zocdoc are required to accurately list in-network plans. If any
                                        coverage issues occur, our Service team will help advocate for you with the
                                        provider. <a href="#">Learn more</a></p>
                                    <div class="insur-head">
                                        <p>Check if this doctor is in-network for your insurance</p>
                                        <button>Check your insurance coverage</button>
                                    </div>
                                    <ul class="insure-cont">
                                        {{-- <li><img src="img/insure1.svg" alt="barnd logo">Aetna</li>
                                        <li><img src="img/insure2.svg" alt="barnd logo">UnitedHealthcare</li>
                                        <li><img src="img/insure3.svg" alt="barnd logo">BlueCross BlueShield</li>
                                        <li><img src="img/insure4.svg" alt="barnd logo">UnitedHealthcare Oxford</li>
                                        <li><img src="img/insure5.png" alt="barnd logo">Emblem Health</li>
                                        <li>200+ more in-network plans <a href="#">View All</a></li> --}}
                                    </ul>
                                    <div class="bottom-note">
                                        <p><span>99% of patients</span> have successfully booked with these insurances
                                        </p>
                                    </div>
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
                            <div class="card-header" id="headingfive">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                        Zocdoc awards <span data-toggle="tooltip" data-placement="bottom"
                                            data-container="#doctorDetailAccord" data-html="true" title="
                      <p>Zocdoc recognise practices for notable and outstanding performance. Awards include:</p>
  
                      <p>See you again - Patients often return to this practice.</p>
                      
                      <p>Rapid registration - This practice offers online check-in, which allows patients to submit forms online before arriving for their appointment.</p>
                      
                      <p>Speedy response - This practice confirms appointment quickly.</p>
                      
                      <p>Schedule hero - This practice keeps their schedules and insurance up to date.</p>
                      ">
                                            <i class="icofont-info-circle"></i></span>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapsefive" class="collapse" aria-labelledby="headingfive"
                                data-parent="#doctorDetailAccord">
                                <div class="card-body">
                                    <!-- doctor awards -->
                                    <ul class="doct-awards">
                                        <li>
                                            <button data-toggle="tooltip" data-placement="top"
                                                title="Complete your forms online with this practice">
                                                <!-- award icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54 61.9">
                                                    <g fill="#FFB4C8">
                                                        <path
                                                            d="M54 20.9V13h-9V0H9v13H0v7.9c0 .7 0 4.5 2.5 7.2 1.1 1.1 3 2.5 6.2 2.5H9V35c0 5.5 4.8 10 10.1 10H24v12h-9v4.9h23V57h-9V45h5.8C40.2 45 45 40.5 45 35v-4.4h.2c3.2 0 5.2-1.3 6.2-2.5 2.6-2.7 2.6-6.4 2.6-7.2zM9 25.2h-.2c-1.6 0-2.1-.6-2.3-.8-.9-1-1.1-2.7-1-3.3V18H9v7.2zM40 35c0 2.5-2.8 5-5.2 5H19.1c-2.4 0-5.1-2.5-5.1-5V5h26v30zm7.6-10.6c-.2.2-.8.8-2.3.8H45V18h3.6v3.1c0 .6-.1 2.4-1 3.3z">
                                                        </path>
                                                        <path d="M36 12.1L18 12v5h18zM18 19h12v5H18z"></path>
                                                    </g>
                                                    <clipPath>
                                                        <path
                                                            d="M85.6 118.4l-4.4 4.4-4.4-4.4-1.1 1.1 4.4 4.4-4.4 4.4 1.1 1.1 4.4-4.4 4.4 4.4 1.1-1.1-4.4-4.4 4.4-4.4z">
                                                        </path>
                                                    </clipPath>
                                                </svg>
                                                <!-- award icon end -->
                                                <span>Rapid registration</span>
                                            </button>
                                        </li>

                                        <li>
                                            <button data-toggle="tooltip" data-placement="top"
                                                title="Complete your forms online with this practice">
                                                <!-- award icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54 61.9">
                                                    <g fill="#FFB4C8">
                                                        <path
                                                            d="M54 20.9V13h-9V0H9v13H0v7.9c0 .7 0 4.5 2.5 7.2 1.1 1.1 3 2.5 6.2 2.5H9V35c0 5.5 4.8 10 10.1 10H24v12h-9v4.9h23V57h-9V45h5.8C40.2 45 45 40.5 45 35v-4.4h.2c3.2 0 5.2-1.3 6.2-2.5 2.6-2.7 2.6-6.4 2.6-7.2zM9 25.2h-.2c-1.6 0-2.1-.6-2.3-.8-.9-1-1.1-2.7-1-3.3V18H9v7.2zM40 35c0 2.5-2.8 5-5.2 5H19.1c-2.4 0-5.1-2.5-5.1-5V5h26v30zm7.6-10.6c-.2.2-.8.8-2.3.8H45V18h3.6v3.1c0 .6-.1 2.4-1 3.3z">
                                                        </path>
                                                        <path
                                                            d="M18 18.8v.2l8.6 6.7h.7l8.7-6.8v-4.6l-4.7-3.8-4.4 3.5-4.2-3.8-4.7 3.5z">
                                                        </path>
                                                    </g>
                                                    <clipPath>
                                                        <path
                                                            d="M10.6 118.4l-4.4 4.4-4.4-4.4-1.1 1.1 4.4 4.4-4.4 4.4 1.1 1.1 4.4-4.4 4.4 4.4 1.1-1.1-4.4-4.4 4.4-4.4z">
                                                        </path>
                                                    </clipPath>
                                                </svg>
                                                <!-- award icon end -->
                                                <span>See you again</span>
                                            </button>
                                        </li>

                                        <li>
                                            <button data-toggle="tooltip" data-placement="top"
                                                title="Complete your forms online with this practice">
                                                <!-- award icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54 61.9">
                                                    <g fill="#FFB4C8">
                                                        <path
                                                            d="M54 20.9V13h-9V0H9v13H0v7.9c0 .7 0 4.5 2.5 7.2 1.1 1.1 3 2.5 6.2 2.5H9V35c0 5.5 4.8 10 10.1 10H24v12h-9v4.9h23V57h-9V45h5.8C40.2 45 45 40.5 45 35v-4.4h.2c3.2 0 5.2-1.3 6.2-2.5 2.6-2.7 2.6-6.4 2.6-7.2zM9 25.2h-.2c-1.6 0-2.1-.6-2.3-.8-.9-1-1.1-2.7-1-3.3V18H9v7.2zM40 35c0 2.5-2.8 5-5.2 5H19.1c-2.4 0-5.1-2.5-5.1-5V5h26v30zm7.6-10.6c-.2.2-.8.8-2.3.8H45V18h3.6v3.1c0 .6-.1 2.4-1 3.3z">
                                                        </path>
                                                        <path d="M24 26.7h4.8l3.2-11h-3.3l1.3-6h-5l-3 11h3z"></path>
                                                    </g>
                                                    <clipPath>
                                                        <path
                                                            d="M-63.4 118.4l-4.4 4.4-4.4-4.4-1.1 1.1 4.4 4.4-4.4 4.4 1.1 1.1 4.4-4.4 4.4 4.4 1.1-1.1-4.4-4.4 4.4-4.4z">
                                                        </path>
                                                    </clipPath>
                                                </svg>
                                                <!-- award icon end -->
                                                <span>Speedy response</span>
                                            </button>
                                        </li>
                                    </ul>
                                    <!-- doctor awards end -->
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
                                            <div class="star-div disabled" data-rating="4.85">
                                                <i class="star star-under icofont-star" star-data="1"><i
                                                        class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="2"><i
                                                        class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="3"><i
                                                        class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="4"><i
                                                        class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="5"><i
                                                        class="star star-over icofont-star"></i></i>
                                            </div>
                                            <!-- rating end -->
                                            <h3>4.85</h3>
                                        </li>

                                        <li>
                                            <h4>Wait time</h4>
                                            <!-- rating -->
                                            <div class="star-div disabled" data-rating="4.37">
                                                <i class="star star-under icofont-star" star-data="1"><i
                                                        class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="2"><i
                                                        class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="3"><i
                                                        class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="4"><i
                                                        class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="5"><i
                                                        class="star star-over icofont-star"></i></i>
                                            </div>
                                            <!-- rating end -->
                                            <h3>4.37</h3>
                                        </li>

                                        <li>
                                            <h4>Bedside manner</h4>
                                            <!-- rating -->
                                            <div class="star-div disabled" data-rating="4.87">
                                                <i class="star star-under icofont-star" star-data="1"><i
                                                        class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="2"><i
                                                        class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="3"><i
                                                        class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="4"><i
                                                        class="star star-over icofont-star"></i></i>
                                                <i class="star star-under icofont-star" star-data="5"><i
                                                        class="star star-over icofont-star"></i></i>
                                            </div>
                                            <!-- rating end -->
                                            <h3>4.87</h3>
                                        </li>
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
                            <h3>1572 reviews</h3>
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
                            <div class="rrv-review-item">
                                <!-- rating -->
                                <div class="star-div disabled" data-rating="1.3">
                                    <i class="star star-under icofont-star" star-data="1"><i
                                            class="star star-over icofont-star"></i></i>
                                    <i class="star star-under icofont-star" star-data="2"><i
                                            class="star star-over icofont-star"></i></i>
                                    <i class="star star-under icofont-star" star-data="3"><i
                                            class="star star-over icofont-star"></i></i>
                                    <i class="star star-under icofont-star" star-data="4"><i
                                            class="star star-over icofont-star"></i></i>
                                    <i class="star star-under icofont-star" star-data="5"><i
                                            class="star star-over icofont-star"></i></i>
                                </div>
                                <!-- rating end -->
                                <div class="para-div">
                                    <p class="two-line-clamp">A little confusion with the technology but no problem
                                        whatsoever once we got connected. The doctor is super personable.</p>
                                </div>
                                <p class="reviewer-info">
                                    <span>Less than 1 month ago</span>
                                    <span>Jerome W.</span>
                                    <span>Verified patient</span>
                                    <span><i class="icofont-video"></i>Video visit</span>
                                </p>
                            </div>
                            <!-- review item end -->

                            <!-- review item -->
                            <div class="rrv-review-item">
                                <!-- rating -->
                                <div class="star-div disabled" data-rating="3.6">
                                    <i class="star star-under icofont-star" star-data="1"><i
                                            class="star star-over icofont-star"></i></i>
                                    <i class="star star-under icofont-star" star-data="2"><i
                                            class="star star-over icofont-star"></i></i>
                                    <i class="star star-under icofont-star" star-data="3"><i
                                            class="star star-over icofont-star"></i></i>
                                    <i class="star star-under icofont-star" star-data="4"><i
                                            class="star star-over icofont-star"></i></i>
                                    <i class="star star-under icofont-star" star-data="5"><i
                                            class="star star-over icofont-star"></i></i>
                                </div>
                                <!-- rating end -->
                                <div class="para-div">
                                    <p class="two-line-clamp">Dr Bagner's physician's assistant was incredible. Went out
                                        of his way to be extra welcoming. Really appreciated it.</p>
                                </div>
                                <p class="reviewer-info">
                                    <span>Less than 3 months ago</span>
                                    <span>Initials hidden</span>
                                </p>
                            </div>
                            <!-- review item end -->

                            <!-- review item -->
                            <div class="rrv-review-item">
                                <!-- rating -->
                                <div class="star-div disabled" data-rating="2">
                                    <i class="star star-under icofont-star" star-data="1"><i
                                            class="star star-over icofont-star"></i></i>
                                    <i class="star star-under icofont-star" star-data="2"><i
                                            class="star star-over icofont-star"></i></i>
                                    <i class="star star-under icofont-star" star-data="3"><i
                                            class="star star-over icofont-star"></i></i>
                                    <i class="star star-under icofont-star" star-data="4"><i
                                            class="star star-over icofont-star"></i></i>
                                    <i class="star star-under icofont-star" star-data="5"><i
                                            class="star star-over icofont-star"></i></i>
                                </div>
                                <!-- rating end -->
                                <div class="para-div">
                                    <p class="two-line-clamp">Dr Bagner, always takes the time to listen to come up with
                                        best approach to your situation, I never feel rushed!!</p>
                                </div>
                                <p class="reviewer-info">
                                    <span>October 21, 2020</span>
                                    <span>Initials hidden</span>
                                </p>
                            </div>
                            <!-- review item end -->
                            <div class="review-btm-options">
                                <a class="more-review-btn" href="#">Read more reviews</a>
                            </div>
                        </div>
                    </div>
                    <!-- all reviews end -->

                    <!-- frequently asked -->
                    <div class="doctor-faq">
                        <h4>Frequently asked questions</h4>

                        <div class="accordion" id="doctor_faq">

                            <div class="card">
                                <div class="card-header" id="faqHeadingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#faqCollapseOne" aria-controls="faqCollapseOne">
                                            How soon can I make an appointment with Dr. Michael Bagner?
                                        </button>
                                    </h2>
                                </div>

                                <div id="faqCollapseOne" class="collapse" aria-labelledby="faqHeadingOne"
                                    data-parent="#doctor_faq">
                                    <div class="card-body">
                                        Generally, Dr. Michael Bagner has appointments available on Zocdoc within 1
                                        week. You can see Dr. Bagner's earliest availability on Zocdoc and <a
                                            href="#">make an appointment online.</a>
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-header" id="faqHeadingtwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#faqCollapsetwo" aria-controls="faqCollapsetwo">
                                            Is Dr. Michael Bagner accepting new patients?
                                        </button>
                                    </h2>
                                </div>

                                <div id="faqCollapsetwo" class="collapse" aria-labelledby="faqHeadingtwo"
                                    data-parent="#doctor_faq">
                                    <div class="card-body">
                                        Dr. Michael Bagner generally accepts new patients on Zocdoc. <a href="#">You can
                                            see Dr. Bagner's earliest availability</a> on Zocdoc and schedule an
                                        appointment online.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="faqHeadingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#faqCollapseThree" aria-controls="faqCollapseThree">
                                            Does Dr. Michael Bagner accept my insurance?
                                        </button>
                                    </h2>
                                </div>

                                <div id="faqCollapseThree" class="collapse" aria-labelledby="faqHeadingThree"
                                    data-parent="#doctor_faq">
                                    <div class="card-body">
                                        <a href="#">Choose your insurance plan</a> to verify if Dr. Bagner is
                                        in-network.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="faqHeadingFour">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#faqCollapseFour" aria-controls="faqCollapseFour">
                                            Which hospital is Dr. Michael Bagner affiliated with?
                                        </button>
                                    </h2>
                                </div>

                                <div id="faqCollapseFour" class="collapse" aria-labelledby="faqHeadingFour"
                                    data-parent="#doctor_faq">
                                    <div class="card-body">
                                        Dr. Michael Bagner is affiliated with Saint Luke's-Roosevelt Hospital Center.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="faqHeadingFive">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#faqCollapseFive" aria-controls="faqCollapseFive">
                                            What practice does Dr. Michael Bagner work with?
                                        </button>
                                    </h2>
                                </div>

                                <div id="faqCollapseFive" class="collapse" aria-labelledby="faqHeadingFive"
                                    data-parent="#doctor_faq">
                                    <div class="card-body">
                                        <a href="#">Dr. Michael Bagner</a> works with <a href="#">Mount Sinai
                                            Doctors.</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="faqHeadingSix">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#faqCollapseSix" aria-controls="faqCollapseSix">
                                            Where is Dr. Michael Bagner's office located?
                                        </button>
                                    </h2>
                                </div>

                                <div id="faqCollapseSix" class="collapse" aria-labelledby="faqHeadingSix"
                                    data-parent="#doctor_faq">
                                    <div class="card-body">
                                        Dr. Michael Bagner has 2 office locations in New York, <a href="#">view full
                                            addresses</a> on Dr. Bagner's profile.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="faqHeadingSeven">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#faqCollapseSeven" aria-controls="faqCollapseSeven">
                                            Can I make an appointment with Dr. Michael Bagner online?
                                        </button>
                                    </h2>
                                </div>

                                <div id="faqCollapseSeven" class="collapse" aria-labelledby="faqHeadingSeven"
                                    data-parent="#doctor_faq">
                                    <div class="card-body">
                                        Yes, you can <a href="#">make an appointment online</a> with Dr. Bagner using
                                        Zocdoc. It’s simple, secure, and free.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- frequently asked end -->

                    <!-- find doctors -->
                    <div class="find-doctors">
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
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="insurances-tab" data-toggle="tab" href="#insurances" role="tab"
                                    aria-controls="insurances" aria-selected="false">Insurances</a>
                            </li> --}}
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
                    </div>
                    <!-- find doctors end -->

                    <!-- bottom breadcrumb -->
                    <ul class="bottom-bread-crumb">
                        <li><a href="{{ url('/') }}">Mydocpoint</a></li>
                        <li><a href="{{ route('doctor.list') }}">Doctors</a></li>
                        <li>Dr. Mohan Kumar DDS.</li>
                    </ul>
                    <!-- bottom breadcrumb end -->
                </div>
                <div class="col-lg-4">
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

                        <h5>Select an available time</h5>
                        <div class="avliable-time">
                            <p>Mount Sinai Doctors - West 8th Avenue 780 8th Avenue, Ste 303, New York, NY 10036</p>
                            <!-- date slider -->
                            <div class="owl-carousel date-slider">
                                <div class="date-item">
                                    <p>Thu</p>
                                    <h5>Oct 1</h5>
                                </div>
                                <div class="date-item">
                                    <p>Fri</p>
                                    <h5>Oct 2</h5>
                                </div>
                                <div class="date-item">
                                    <p>Sat</p>
                                    <h5>Oct 3</h5>
                                </div>
                                <div class="date-item">
                                    <p>Sun</p>
                                    <h5>Oct 4</h5>
                                </div>
                                <div class="date-item">
                                    <p>Mon</p>
                                    <h5>Oct 5</h5>
                                </div>
                                <div class="date-item">
                                    <p>Tue</p>
                                    <h5>Oct 6</h5>
                                </div>
                                <div class="date-item">
                                    <p>Wed</p>
                                    <h5>Oct 7</h5>
                                </div>
                            </div>
                            <div class="slider-btns">
                                <span class="prev"><i class="icofont-rounded-left"></i></span>
                                <span class="next"><i class="icofont-rounded-right"></i></span>
                            </div>
                            <!-- date slider end -->

                            <!-- time buttons -->
                            <ul class="time-btns d-desktop-for-tab">
                                <li><a href="#">09:00 AM</a></li>
                                <li><a href="#">09:00 AM</a></li>
                                <li><a href="#">09:00 AM</a></li>
                                <li><a href="#" class="empty">--</a></li>
                                <li><a href="#">11:00 AM</a></li>
                                <li><a href="#">11:00 AM</a></li>
                                <li><a href="#">11:00 AM</a></li>
                                <li><a href="#" class="empty">--</a></li>
                                <li><a href="#">12:00 AM</a></li>
                                <li><a href="#">12:00 AM</a></li>
                                <li><a href="#">12:00 AM</a></li>
                                <li><a href="#" class="empty">---</a></li>
                                <li><a href="#" class="empty">---</a></li>
                                <li><a href="#" class="empty">---</a></li>
                                <li><a href="#" class="empty">---</a></li>
                                <li><a href="#" class="empty">---</a></li>
                            </ul>
                            <!-- time buttons end -->
                        </div>
                        <button class="continue-button">Continue booking</button>
                    </div>
                    <!-- side card end -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- doctor main detail end -->
@endsection
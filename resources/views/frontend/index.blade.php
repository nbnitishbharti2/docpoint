@extends('layouts.frontend')
@section('title', 'MyDocPoint | Home')
@section('content')
    <!-- banner -->
    <section class="p-0 bg-light-grey">
        <div class="banner">
            <div class="container sml-container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- banner content -->
                        <div class="banner-cont">
                            <h2>Find your doctor in your location</h2>
                            <!-- search form -->
                            <form class="needs-validation" method="post" novalidate action="{{ url('doctor-lists') }}">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <input type="text" name="key" class="form-control" placeholder="Condition, Procedur..."
                                            required>
                                        <div class="invalid-feedback">
                                            Enter Condition or Procedure
                                        </div>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="zip" class="form-control" placeholder="Zip Code or city" required>
                                        <div class="invalid-feedback">
                                            Enter Zip code or City
                                        </div>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" min="{{ date('Y-m-d') }}" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                        <div class="invalid-feedback">
                                            Enter Zip code or City
                                        </div>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <button class="search-btn" type="submit"><i class="icofont-search-1"></i></button>
                            </form>
                            <!-- search form end -->
                        </div>
                        <!-- banner content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner end -->

    <!-- top special -->
    <section class="p-0 bg-light-grey">
        <div class="top-special">
            <div class="container sml-container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="special-heading">Top specialties on Mydocpoint:</h3>
                    </div>
                    @foreach($speciality as $key => $value)
                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- special item -->
                        <a href="#">
                            <div class="spcl-item">
                                <img src="{{ ($value->pic && file_exists('public/storage/images/specialities/'.$value->pic)) ? asset('public/storage/images/specialities/'.$value->pic) : asset('public/storage/images/specialities/speciality-icon.png') }}" alt="{{ $value->name }}">
                                <p>{{ $value->spec_name }}</p>
                            </div>
                        </a>
                        <!-- special item end -->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- top special end -->

    <!-- video visit -->
    <section>
        <div class="video_visit">
            <div class="container sml-container">
                <div class="row">
                    <div class="col-md-6">
                        <!-- visit text -->
                        <div class="visit-txt">
                            <h3>Video visit with in-inetwork local doctors <span>New</span></h3>
                            <p>Video visits can address immediate medical issues or routine healthcare needs. Doctors are
                                ready to treat a variety of issues or help you with prescriptions or referrals.</p>
                            <button class="blue-btn">Book a video visit</button>
                        </div>
                        <!-- visit text end -->
                    </div>
                    <div class="col-md-6">
                        <!-- visit image -->
                        <div class="visit-img">
                            <img class="img-fluid" src="{{ asset('public/storage/frontend/img/doctor.png') }}" alt="doctors">
                        </div>
                        <!-- visit image end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- video visit end -->

    <div class="seperator"></div>

    <!-- download doc point -->
    <section>
        <div class="dc-point">
            <div class="container sml-container">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- doc point text -->
                        <div class="dc-txt">
                            <h2>Download mydocpoint app</h2>
                            <ul>
                                <li>Find nearby doctors in your network</li>
                                <li>Browse doctor reviews by real patients</li>
                                <li>Book doctor appointments with a tap</li>
                            </ul>
                            <!-- send links -->
                            <div class="send-links">
                                <h4>Send me a link to the app</h4>
                                <form class="needs-validation" novalidate>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="(555) 555-555" required>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Enter number</div>
                                        <button class="send-link" type="submit">Send Link</button>
                                    </div>
                                </form>
                            </div>
                            <!-- send links end -->

                            <a class="playstore" href="#"><img src="{{ asset('public/storage/frontend/img/playstore.png') }}" alt="playstore button"></a>
                        </div>
                        <!-- doc point text end -->
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <!-- user card -->
                        <div class="user-card">
                            <img class="user-img" src="{{ asset('public/storage/frontend/img/user-card.png') }}" alt="doctor">
                            <h5>Dr. Mohan Kumar DDS</h5>
                            <h6>Dentist</h6>
                            <!-- address -->
                            <div class="address">
                                <h5>Sector 15,Faridabad</h5>
                                <p>Deep Dental Care & Treatment Centre Rs.400 Consultation fee at clinic</p>
                            </div>
                            <!-- address end -->

                            <!-- rating -->
                            <div class="rating">
                                <span>&#9733; &#9733; &#9733; &#9733; &#9733;</span>
                                <p class="total-rating">4</p>
                                <p class="rating-count">(969)</p>
                            </div>
                            <!-- rating end -->

                            <a class="blue-anchor" href="#">
                                <!-- calendar icon -->
                                <svg id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512"
                                    width="512" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="m446 40h-46v-24c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-224v-24c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-46c-36.393 0-66 29.607-66 66v340c0 36.393 29.607 66 66 66h380c36.393 0 66-29.607 66-66v-340c0-36.393-29.607-66-66-66zm34 406c0 18.778-15.222 34-34 34h-380c-18.778 0-34-15.222-34-34v-265c0-2.761 2.239-5 5-5h438c2.761 0 5 2.239 5 5z" />
                                    </g>
                                </svg>
                                <!-- calendar icon end -->
                                View all availability
                            </a>
                            <a class="blue-anchor" href="#">
                                <!-- user icon -->
                                <svg id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512"
                                    width="512" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="m256 512c-60.615 0-119.406-21.564-165.543-60.721-10.833-9.188-20.995-19.375-30.201-30.275-38.859-46.06-60.256-104.657-60.256-165.004 0-68.381 26.628-132.668 74.98-181.02s112.639-74.98 181.02-74.98 132.668 26.628 181.02 74.98 74.98 112.639 74.98 181.02c0 60.348-21.397 118.945-60.251 164.998-9.211 10.906-19.373 21.093-30.209 30.284-46.134 39.154-104.925 60.718-165.54 60.718zm0-480c-123.514 0-224 100.486-224 224 0 52.805 18.719 104.074 52.709 144.363 8.06 9.543 16.961 18.466 26.451 26.516 40.364 34.256 91.801 53.121 144.84 53.121s104.476-18.865 144.837-53.119c9.493-8.052 18.394-16.976 26.459-26.525 33.985-40.281 52.704-91.55 52.704-144.356 0-123.514-100.486-224-224-224z" />
                                        <path
                                            d="m256 256c-52.935 0-96-43.065-96-96s43.065-96 96-96 96 43.065 96 96-43.065 96-96 96zm0-160c-35.29 0-64 28.71-64 64s28.71 64 64 64 64-28.71 64-64-28.71-64-64-64z" />
                                        <path
                                            d="m411.202 455.084c-1.29 0-2.6-.157-3.908-.485-8.57-2.151-13.774-10.843-11.623-19.414 2.872-11.443 4.329-23.281 4.329-35.185 0-78.285-63.646-142.866-141.893-143.99l-2.107-.01-2.107.01c-78.247 1.124-141.893 65.705-141.893 143.99 0 11.904 1.457 23.742 4.329 35.185 2.151 8.571-3.053 17.263-11.623 19.414s-17.263-3.052-19.414-11.623c-3.512-13.989-5.292-28.448-5.292-42.976 0-46.578 18.017-90.483 50.732-123.63 32.683-33.114 76.285-51.708 122.774-52.358.075-.001.149-.001.224-.001l2.27-.011 2.27.01c.075 0 .149 0 .224.001 46.489.649 90.091 19.244 122.774 52.358 32.715 33.148 50.732 77.053 50.732 123.631 0 14.528-1.78 28.987-5.292 42.976-1.823 7.262-8.343 12.107-15.506 12.108z" />
                                    </g>
                                </svg>
                                <!-- user icon end -->
                                View profile
                            </a>
                            <a class="book-appoinment" href="#">Book Appointment</a>
                        </div>
                        <!-- user card end -->
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <!-- user card -->
                        <div class="user-card">
                            <img class="user-img" src="{{ asset('public/storage/frontend/img/user-card.png') }}" alt="doctor">
                            <h5>Dr. Mohan Kumar DDS</h5>
                            <h6>Dentist</h6>
                            <!-- address -->
                            <div class="address">
                                <h5>Sector 15,Faridabad</h5>
                                <p>Deep Dental Care & Treatment Centre Rs.400 Consultation fee at clinic</p>
                            </div>
                            <!-- address end -->

                            <!-- rating -->
                            <div class="rating">
                                <span>&#9733; &#9733; &#9733; &#9733; &#9733;</span>
                                <p class="total-rating">4</p>
                                <p class="rating-count">(969)</p>
                            </div>
                            <!-- rating end -->

                            <a class="blue-anchor" href="#">
                                <!-- calendar icon -->
                                <svg id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512"
                                    width="512" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="m446 40h-46v-24c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-224v-24c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-46c-36.393 0-66 29.607-66 66v340c0 36.393 29.607 66 66 66h380c36.393 0 66-29.607 66-66v-340c0-36.393-29.607-66-66-66zm34 406c0 18.778-15.222 34-34 34h-380c-18.778 0-34-15.222-34-34v-265c0-2.761 2.239-5 5-5h438c2.761 0 5 2.239 5 5z" />
                                    </g>
                                </svg>
                                <!-- calendar icon end -->
                                View all availability
                            </a>
                            <a class="blue-anchor" href="#">
                                <!-- user icon -->
                                <svg id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512"
                                    width="512" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="m256 512c-60.615 0-119.406-21.564-165.543-60.721-10.833-9.188-20.995-19.375-30.201-30.275-38.859-46.06-60.256-104.657-60.256-165.004 0-68.381 26.628-132.668 74.98-181.02s112.639-74.98 181.02-74.98 132.668 26.628 181.02 74.98 74.98 112.639 74.98 181.02c0 60.348-21.397 118.945-60.251 164.998-9.211 10.906-19.373 21.093-30.209 30.284-46.134 39.154-104.925 60.718-165.54 60.718zm0-480c-123.514 0-224 100.486-224 224 0 52.805 18.719 104.074 52.709 144.363 8.06 9.543 16.961 18.466 26.451 26.516 40.364 34.256 91.801 53.121 144.84 53.121s104.476-18.865 144.837-53.119c9.493-8.052 18.394-16.976 26.459-26.525 33.985-40.281 52.704-91.55 52.704-144.356 0-123.514-100.486-224-224-224z" />
                                        <path
                                            d="m256 256c-52.935 0-96-43.065-96-96s43.065-96 96-96 96 43.065 96 96-43.065 96-96 96zm0-160c-35.29 0-64 28.71-64 64s28.71 64 64 64 64-28.71 64-64-28.71-64-64-64z" />
                                        <path
                                            d="m411.202 455.084c-1.29 0-2.6-.157-3.908-.485-8.57-2.151-13.774-10.843-11.623-19.414 2.872-11.443 4.329-23.281 4.329-35.185 0-78.285-63.646-142.866-141.893-143.99l-2.107-.01-2.107.01c-78.247 1.124-141.893 65.705-141.893 143.99 0 11.904 1.457 23.742 4.329 35.185 2.151 8.571-3.053 17.263-11.623 19.414s-17.263-3.052-19.414-11.623c-3.512-13.989-5.292-28.448-5.292-42.976 0-46.578 18.017-90.483 50.732-123.63 32.683-33.114 76.285-51.708 122.774-52.358.075-.001.149-.001.224-.001l2.27-.011 2.27.01c.075 0 .149 0 .224.001 46.489.649 90.091 19.244 122.774 52.358 32.715 33.148 50.732 77.053 50.732 123.631 0 14.528-1.78 28.987-5.292 42.976-1.823 7.262-8.343 12.107-15.506 12.108z" />
                                    </g>
                                </svg>
                                <!-- user icon end -->
                                View profile
                            </a>
                            <a class="book-appoinment" href="#">Book Appointment</a>
                        </div>
                        <!-- user card end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- download doc point end -->

    <div class="seperator"></div>

    <!-- five star doctor -->
    <section>
        <div class="five-star">
            <div class="container sml-container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- star doctor -->
                        <div class="star-doctor">
                            <img class="float-right" src="{{ asset('public/storage/frontend/img/five-star-doctor.png') }}" alt="doctor vactor">
                            <h2>Are you a five-star doctor?</h2>
                            <p>List your practice to reach millions of patients.</p>
                            <ul>
                                <li>Attract and engage new patients</li>
                                <li>Build and strengthen your online reputation</li>
                                <li>Deliver a premium experience patients love</li>
                            </ul>
                            <a class="star-doc-btn" href="{{ Route('doctor.registration') }}">List your practice on Mydocpoint</a>
                        </div>
                        <!-- star doctor end -->
                    </div>

                    <div class="col-lg-12">
                        <h3 class="find-doc-heading">Find doctors and dentists by city</h3>
                    </div>
                    @foreach($country as $key=> $value)
                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>{{ $value->name }} City</option>
                                {{-- @foreach($value->city as $key2 => $value2)
                                    <option>{{ $value2->name }}</option>
                                @endforeach  --}}
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>
                    @endforeach
                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Baltimore</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Philadelphia</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Boston</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Brooklyn</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Washington, DC</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Houston</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>San Francisco</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Queens</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Seattle</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Dallas</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Miami</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Bronx</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Atlanta</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Austin</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Los Angeles</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Long island</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Denver</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <!-- doctor city -->
                        <div class="doctor-city">
                            <select>
                                <option>Chicago</option>
                                <option>city 1</option>
                                <option>city 2</option>
                                <option>city 3</option>
                            </select>
                        </div>
                        <!-- doctor city end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- five star doctor end -->
@endsection

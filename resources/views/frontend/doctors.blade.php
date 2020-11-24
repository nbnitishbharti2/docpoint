@extends('layouts.frontend')
@section('title', 'MyDocPoint | Doctors')
@section('content')

<!-- search -->
<section class="p-0 bg-blue">
  <div class="banner innr-banner">
    <div class="container sml-container">
      <div class="row">
        <div class="col-lg-12">
          <!-- search content -->
          <div class="banner-cont">
            <!-- search form -->
            <form class="needs-validation" novalidate>
              <div class="row no-gutters">
                <!-- search item -->
                <div class="col-md-4">
                  <i class="icofont-search-1"></i>
                  <input type="text" class="form-control" placeholder="Condition, Procedur..." value="Dentist" required>
                  <div class="invalid-feedback">
                    Enter Condition or Procedure
                  </div>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>
                <!-- search item end -->

                <!-- search item -->
                <div class="col-md-4">
                  <i class="icofont-location-pin"></i>
                  <input type="text" class="form-control" placeholder="Zip Code or city" value="New York, NY" required>
                  <div class="invalid-feedback">
                    Enter Zip code or City
                  </div>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>
                <!-- search item end -->

                <!-- search item -->
                <div class="col-md-4">
                  <input type="date" class="form-control" value="2020-10-01" required>
                  <div class="invalid-feedback">
                    Enter date
                  </div>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>
                <!-- search item end -->
              </div>
              <button class="search-btn" type="submit"><i class="icofont-search-1"></i></button>
            </form>
            <!-- search form end -->
          </div>
          <!-- search content end -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- search end -->

<!-- tab options -->
<section class="py-2">
  <div class="tab-options">
    <div class="container sml-container">
      <div class="row">
        <div class="col-lg-12">
          <!-- tab option wrap -->
          <ul class="tab-option-wrap">
              <li class="active"><a href="#">All appointments</a></li>
              <li><a href="#">In-person</a></li>
              <li><a href="#">Video visit <span class="bg-blue">New</span></a></li>
          </ul>
          <!-- tab option wrap end -->
        </div>
        <div class="col-lg-12">
          <!-- page options -->
          <div class="page-options">
            <span>923 doctors</span>
            <div class="sep"></div>
            <ul>
              <li><a href="#">Dental Consultation</a></li>
              <li><a href="#">Specialties</a></li>
              <li><a href="#">Availability</a></li>
              <li><a href="#">Special hours</a></li>
              <li><a href="#">Gender</a></li>
              <li><a href="#">Hospital affiliations</a></li>
              <!-- short by -->
              <li class="short-by"><a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort
                    <!-- short icon -->
                    <svg viewBox="0 0 490 490">
                      <path d="M85.877 154.014v274.295h45.829V154.014l48.791 67.199 37.087-26.943L108.792 44.46 0 194.27l37.087 26.943zM404.13 335.988V61.691h-45.829V335.99l-48.798-67.203-37.087 26.943 108.8 149.81L490 295.715l-37.087-26.913z">
                      </path>
                    </svg>
                    <!-- short icon end -->
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item active" href="#">default order</a>
                    <a class="dropdown-item" href="#">distance</a>
                    <a class="dropdown-item" href="#">wait time rating</a>
                  </div>
              </li>
              <!-- short by end -->
            </ul>
          </div>
          <!-- page options end -->
        </div>
        
      </div>
    </div>
  </div>
</section>
<!-- tab options end -->

<!-- inner page content -->
<section class="pt-0 inc-pg">
  <div class="inner-page-content">
    <div class="container-fluid">
      <div class="row no-gutters">
        <div class="col-lg-8">
          <!-- date slider -->
          <div class="owl-carousel date-slider">
            <div class="date-item"><p>Thu</p><h5>Oct 1</h5></div>
            <div class="date-item"><p>Fri</p><h5>Oct 2</h5></div>
            <div class="date-item"><p>Sat</p><h5>Oct 3</h5></div>
            <div class="date-item"><p>Sun</p><h5>Oct 4</h5></div>
            <div class="date-item"><p>Mon</p><h5>Oct 5</h5></div>
            <div class="date-item"><p>Tue</p><h5>Oct 6</h5></div>
            <div class="date-item"><p>Wed</p><h5>Oct 7</h5></div>
          </div>
          <div class="slider-btns">
            <span class="prev"><i class="icofont-rounded-left"></i></span>
            <span class="next"><i class="icofont-rounded-right"></i></span>
          </div>
          <!-- date slider end -->
        </div>
        <div class="col-lg-4"></div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-8">
          <!-- doctor list -->
          <div class="doctor-list">
            <!-- user card -->
            <div class="user-card">
              <img class="user-img d-desktop-for-phone" src="img/user-card.png" alt="doctor">
              <div class="row no-gutters">
                <div class="col-lg-6 pl-md-4">
                  <img class="user-img d-phone" src="img/user-card.png" alt="doctor">
                  <h5>Dr. Mohan Kumar DDS <i class="icofont-check"></i> <span class="distance">1.5 Km</span></h5>
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
                </div>
                <div class="col-lg-6 pl-md-4 pl-lg-0">
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

                  <ul class="time-btns d-tab">
                    <li><a href="#">09:00 AM</a></li>
                    <li><a href="#">11:00 AM</a></li>
                    <li><a href="#">12:00 AM</a></li>
                    <li><a href="#" class="empty">---</a></li>
                  </ul>
                </div>
                <div class="col-lg-12 pl-md-4">
                  <div class="inr-line-btn">
                    <a class="blue-anchor" href="#">
                      <!-- calendar icon -->
                      <svg id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <path d="m446 40h-46v-24c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-224v-24c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-46c-36.393 0-66 29.607-66 66v340c0 36.393 29.607 66 66 66h380c36.393 0 66-29.607 66-66v-340c0-36.393-29.607-66-66-66zm34 406c0 18.778-15.222 34-34 34h-380c-18.778 0-34-15.222-34-34v-265c0-2.761 2.239-5 5-5h438c2.761 0 5 2.239 5 5z"/>
                        </g>
                      </svg>
                      <!-- calendar icon end -->
                      View all availability
                    </a>
                    <a class="blue-anchor" href="#">
                      <!-- user icon -->
                      <svg id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                          <g>
                            <path d="m256 512c-60.615 0-119.406-21.564-165.543-60.721-10.833-9.188-20.995-19.375-30.201-30.275-38.859-46.06-60.256-104.657-60.256-165.004 0-68.381 26.628-132.668 74.98-181.02s112.639-74.98 181.02-74.98 132.668 26.628 181.02 74.98 74.98 112.639 74.98 181.02c0 60.348-21.397 118.945-60.251 164.998-9.211 10.906-19.373 21.093-30.209 30.284-46.134 39.154-104.925 60.718-165.54 60.718zm0-480c-123.514 0-224 100.486-224 224 0 52.805 18.719 104.074 52.709 144.363 8.06 9.543 16.961 18.466 26.451 26.516 40.364 34.256 91.801 53.121 144.84 53.121s104.476-18.865 144.837-53.119c9.493-8.052 18.394-16.976 26.459-26.525 33.985-40.281 52.704-91.55 52.704-144.356 0-123.514-100.486-224-224-224z" />
                            <path d="m256 256c-52.935 0-96-43.065-96-96s43.065-96 96-96 96 43.065 96 96-43.065 96-96 96zm0-160c-35.29 0-64 28.71-64 64s28.71 64 64 64 64-28.71 64-64-28.71-64-64-64z" />
                              <path d="m411.202 455.084c-1.29 0-2.6-.157-3.908-.485-8.57-2.151-13.774-10.843-11.623-19.414 2.872-11.443 4.329-23.281 4.329-35.185 0-78.285-63.646-142.866-141.893-143.99l-2.107-.01-2.107.01c-78.247 1.124-141.893 65.705-141.893 143.99 0 11.904 1.457 23.742 4.329 35.185 2.151 8.571-3.053 17.263-11.623 19.414s-17.263-3.052-19.414-11.623c-3.512-13.989-5.292-28.448-5.292-42.976 0-46.578 18.017-90.483 50.732-123.63 32.683-33.114 76.285-51.708 122.774-52.358.075-.001.149-.001.224-.001l2.27-.011 2.27.01c.075 0 .149 0 .224.001 46.489.649 90.091 19.244 122.774 52.358 32.715 33.148 50.732 77.053 50.732 123.631 0 14.528-1.78 28.987-5.292 42.976-1.823 7.262-8.343 12.107-15.506 12.108z" />
                            </g>
                      </svg>
                      <!-- user icon end -->
                      View profile
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- user card end -->
          </div>
          <!-- doctor list end -->

          <!-- doctor list -->
          <div class="doctor-list">
            <!-- user card -->
            <div class="user-card">
              <img class="user-img d-desktop-for-phone" src="img/user-card.png" alt="doctor">
              <div class="row no-gutters">
                <div class="col-lg-6 pl-md-4">
                  <img class="user-img d-phone" src="img/user-card.png" alt="doctor">
                  <h5>Dr. Mohan Kumar DDS <i class="icofont-check"></i> <span class="distance">1.5 Km</span></h5>
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
                </div>
                <div class="col-lg-6 pl-md-4 pl-lg-0">
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

                  <ul class="time-btns d-tab">
                    <li><a href="#">09:00 AM</a></li>
                    <li><a href="#">11:00 AM</a></li>
                    <li><a href="#">12:00 AM</a></li>
                    <li><a href="#" class="empty">---</a></li>
                  </ul>
                </div>
                <div class="col-lg-12 pl-md-4">
                  <div class="inr-line-btn">
                    <a class="blue-anchor" href="#">
                      <!-- calendar icon -->
                      <svg id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <path d="m446 40h-46v-24c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-224v-24c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-46c-36.393 0-66 29.607-66 66v340c0 36.393 29.607 66 66 66h380c36.393 0 66-29.607 66-66v-340c0-36.393-29.607-66-66-66zm34 406c0 18.778-15.222 34-34 34h-380c-18.778 0-34-15.222-34-34v-265c0-2.761 2.239-5 5-5h438c2.761 0 5 2.239 5 5z"/>
                        </g>
                      </svg>
                      <!-- calendar icon end -->
                      View all availability
                    </a>
                    <a class="blue-anchor" href="#">
                      <!-- user icon -->
                      <svg id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                          <g>
                            <path d="m256 512c-60.615 0-119.406-21.564-165.543-60.721-10.833-9.188-20.995-19.375-30.201-30.275-38.859-46.06-60.256-104.657-60.256-165.004 0-68.381 26.628-132.668 74.98-181.02s112.639-74.98 181.02-74.98 132.668 26.628 181.02 74.98 74.98 112.639 74.98 181.02c0 60.348-21.397 118.945-60.251 164.998-9.211 10.906-19.373 21.093-30.209 30.284-46.134 39.154-104.925 60.718-165.54 60.718zm0-480c-123.514 0-224 100.486-224 224 0 52.805 18.719 104.074 52.709 144.363 8.06 9.543 16.961 18.466 26.451 26.516 40.364 34.256 91.801 53.121 144.84 53.121s104.476-18.865 144.837-53.119c9.493-8.052 18.394-16.976 26.459-26.525 33.985-40.281 52.704-91.55 52.704-144.356 0-123.514-100.486-224-224-224z" />
                            <path d="m256 256c-52.935 0-96-43.065-96-96s43.065-96 96-96 96 43.065 96 96-43.065 96-96 96zm0-160c-35.29 0-64 28.71-64 64s28.71 64 64 64 64-28.71 64-64-28.71-64-64-64z" />
                              <path d="m411.202 455.084c-1.29 0-2.6-.157-3.908-.485-8.57-2.151-13.774-10.843-11.623-19.414 2.872-11.443 4.329-23.281 4.329-35.185 0-78.285-63.646-142.866-141.893-143.99l-2.107-.01-2.107.01c-78.247 1.124-141.893 65.705-141.893 143.99 0 11.904 1.457 23.742 4.329 35.185 2.151 8.571-3.053 17.263-11.623 19.414s-17.263-3.052-19.414-11.623c-3.512-13.989-5.292-28.448-5.292-42.976 0-46.578 18.017-90.483 50.732-123.63 32.683-33.114 76.285-51.708 122.774-52.358.075-.001.149-.001.224-.001l2.27-.011 2.27.01c.075 0 .149 0 .224.001 46.489.649 90.091 19.244 122.774 52.358 32.715 33.148 50.732 77.053 50.732 123.631 0 14.528-1.78 28.987-5.292 42.976-1.823 7.262-8.343 12.107-15.506 12.108z" />
                            </g>
                      </svg>
                      <!-- user icon end -->
                      View profile
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- user card end -->
          </div>
          <!-- doctor list end -->
        </div>
        <div class="col-lg-4">
          <!-- map -->
          <div class="loc-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d463522.6072642181!2d78.79619623857486!3d24.820425914447725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1606175912511!5m2!1sen!2sin" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>
          <!-- map end -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- inner page content end -->
 

@endsection
 
 
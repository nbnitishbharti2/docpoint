@extends('layouts.frontend')
@section('title', 'MyDocPoint | Doctors')
@section('content')
<style>
  .morecontent span {
    display: none;
    text-align: justify;
    text-justify: inter-word;
  }
  .morelink {
      display: block;
      color: brown;
  }
  .more {
    text-align: justify;
    text-justify: inter-word;
  }
</style>
@php
$lact = array(); 
$lact_new = array();
$location_blank = array(); 
$doctor_id_list = array();
@endphp
<!-- search -->
<form class="needs-validation" method="post" id="search-form" novalidate action="{{ url('doctor-lists') }}">
<section class="p-0 bg-blue">
  <div class="banner innr-banner">
    <div class="container sml-container">
      <div class="row">
        <div class="col-lg-12">
          <!-- search content -->
          <div class="banner-cont new-form">
            <!-- search form -->
           
              <div class="row no-gutters">
                <!-- search item -->
                <div class="col-md-4">
                  <i class="icofont-search-1"></i>
                  <select class="form-control" name="resion" required>
                    <option></option>
                    @foreach ($resion_list as $value) 
                    <option value="{{$value->id}}" <?php echo ($resion==$value->id)?'selected':'' ?>>{{$value->name}}</option>  
                    @endforeach
                </select>
                  {{-- <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Condition, Procedur..." value="Dentist" required> --}}
                  <div class="invalid-feedback">
                    Enter Condition or Procedure
                  </div>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>
                <!-- search item end -->

                <!-- search item -->
                <div class="col-md-4 px-2">
                  <i class="icofont-location-pin"></i>
                  <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Zip Code or city" value="New York, NY" required>
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
                  <input type="text" name="date" class="form-control"  id="date" value="{{ date("d-m-Y", strtotime($date)) }}" required>
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
              <li class="active" onclick="more_desktop_change_type('')"><a href="#">All appointments</a></li>
              <li ><a href="javascript:void(0)" onclick="more_desktop_change_type('Physical')">In-person</a></li>
              <li><a href="javascript:void(0)"  onclick="more_desktop_change_type('Video')">Video visit <span class="bg-blue">New</span></a></li>
          </ul>
          <!-- tab option wrap end -->
        </div>
        <div class="col-lg-12">
          <!-- page options -->
          <div class="page-options">
            <span>{{ count($doctors) }} doctors</span>
            <div class="sep"></div>
            <ul>
               
              {{-- <li><a href="#">Availability</a></li> --}}
              <li>
                <div class="dropdown multiselect">
                  <button class="select-btn" type="button" id="dropdownMenu11" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Sponsored
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu multidrop-off" aria-labelledby="dropdownMenu11">
                  
                  <li><a>
                    <input type="checkbox" id="action1" name="sponsored[]" {{(in_array('Yes',$sponsored_list))?'checked':''}} value="Yes">
                    <label for="action1">Yes</label>
                  </a></li>
                  <li><a>
                    <input type="checkbox" id="action1" name="sponsored[]" {{(in_array('No',$sponsored_list))?'checked':''}} value="No">
                    <label for="action1">No</label>
                  </a></li>
                  
                  <li class="mb-0">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      {{-- <button type="button" class="btn btn-secondary">clear</button> --}}
                      <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                  </li>
                  </ul>
                </div>
              </li>
                 <li>
                <div class="dropdown multiselect">
                  <button class="select-btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Speciality
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu multidrop-off" aria-labelledby="dropdownMenu1">
                    @foreach($speciality as $key => $val)
                  <li><a>
                    <input type="checkbox" id="action1" name="speciality[]" {{(in_array($val->id,$speciality_list))?'checked':''}} value="{{$val->id}}">
                    <label for="action1">{{$val->spec_name}}</label>
                  </a></li>
                  @endforeach 
                  <li class="mb-0">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      {{-- <button type="button" class="btn btn-secondary">clear</button> --}}
                      <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                  </li>
                  </ul>
                </div>
              </li>

               <li>
                <div class="dropdown multiselect">
                  <button class="select-btn" type="button" id="dropdownMenu11" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Gender
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu multidrop-off" aria-labelledby="dropdownMenu11">
                    @foreach($gender as $key => $val)
                  <li><a>
                    <input type="checkbox" id="action1" name="gender[]" {{(in_array($val->id,$gender_list))?'checked':''}} value="{{$val->id}}">
                    <label for="action1">{{$val->name}}</label>
                  </a></li>
                  @endforeach 
                  <li class="mb-0">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-secondary">clear</button>
                      <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                  </li>
                  </ul>
                </div>
              </li>
              <li>
                <div class="dropdown multiselect">
                  <button class="select-btn" type="button" id="dropdownMenu12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Hospital affiliations
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu multidrop-off" aria-labelledby="dropdownMenu12">
                    @foreach($affiliation as $key => $val)
                  <li><a>
                    <input type="checkbox" id="action1" name="affiliation[]" {{(in_array($val->id,$affiliation_list))?'checked':''}} value="{{$val->id}}">
                    <label for="action1">{{$val->name}}</label>
                  </a></li>
                  @endforeach 
                  <li class="mb-0">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      {{-- <button type="button" class="btn btn-secondary">clear</button> --}}
                      <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                  </li>
                  </ul>
                </div>
              </li>
               
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
                    <input name="short" type='text' id="short">
                    <a class="dropdown-item" onclick="submitform(1);" href="javascript:void(0)">Default Order</a>
                    <a class="dropdown-item" onclick="submitform(2);" href="javascript:void(0)">Distance</a>
                    <a class="dropdown-item" onclick="submitform(3);" href="javascript:void(0)">Wait Time Rating</a>
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
 </form>
<!-- tab options end -->

<!-- inner page content -->
<section class="pt-0 inc-pg">
  <div class="inner-page-content">
    <div class="container-fluid">
      <div class="row no-gutters">
        <div class="col-lg-8">
          <!-- date slider -->
          <div class="owl-carousel date-slider" id="date-list">
            @for($i=0; $i<5; $i++)
            <div class="date-item"><p>{{ date("D",strtotime($date. ' +'.$i.' day')) }}</p><h5>{{ date("M d",strtotime($date. ' +'.$i.' day')) }}</h5></div>
            @endfor
             
          </div>
          <div class="slider-btns">
            <span class="prev"><i class="icofont-rounded-left"  onclick="more_desktop_date(0)"></i></span>
            <span class="next"><i class="icofont-rounded-right" onclick="more_desktop_date(1)"></i></span>
          </div>
          <!-- date slider end -->
        </div>
        <div class="col-lg-4"></div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-8">
          <!-- doctor list -->

          @foreach($doctors as $key => $value)

          <?php 
            if($value->latitude!=null && $value->longitude!=null){
            $lact2  =array(); 
            $lact3  =array();  
            array_push($lact2,$value->name); 
            array_push($lact2,$value->latitude); 
            array_push($lact2,$value->longitude); 
            array_push($lact2,($key+1)); 
            array_push($lact, $lact2); 
            array_push($doctor_id_list, $value->id);
            
            $lact3['title']=$value->name; 
            $lact3['lat']=round($value->latitude,3); 
            $lact3['lng']=round($value->longitude,3); 
            array_push($lact_new, $lact3);
          }else{
            array_push($doctor_id_list, $value->id);
            array_push($location_blank,($key));
          }
             ?> 
          <div class="doctor-list">
            <!-- user card -->
            <div class="user-card">
              <img class="user-img d-desktop-for-phone" src="{{ ($value->pic && file_exists('public/storage/images/doctor/'.$value->pic)) ? asset('public/storage/images/doctor/'.$value->pic) : asset('public/storage/images/doctor/images.jpg') }}" alt="{{ $value->name }}">

              <div class="row no-gutters">
                <div class="col-lg-6 pl-md-4">
                  <img class="user-img d-phone" src="{{ asset('public/storage/frontend/img/user-card.png') }}" alt="doctor">
                  <h5>{{ $value->name }}@if($value->sponsored=='Yes')<i class="icofont-check"></i> @endif
                  <br> <i class="icofont-map-pins"></i><span id="distance-total{{$key }}"></span> 
                    {{-- <span class="distance">1.5 Km</span> --}}</h5>
                  <h6>{{ $value->speciality->spec_name }}</h6>
                  <!-- address -->
                  <div class="address">
                    <h5>{{ $value->address }}</h5>
                    <span class = "more">{{ $value->about }}</span>
                  </div>
                  <!-- address end -->
                  <div>
                    <ul class="pills-wrap padding-5">
                      @if($value->physical == "Yes")
                          <li class="pills"><a href="javascript:void(0)"><i class="icofont-user"></i><p>In-person visits</p></a></li>
                      @endif
                    </ul>
                    <ul class="pills-wrap padding-5">
                      @if($value->video == "Yes")
                          <li class="pills"><a href="javascript:void(0)"><i class="icofont-video"></i><p>Video visits</p></a></li>
                      @endif
                    </ul>
                  </div>
                  <!-- rating -->
                  <div class="rating">
                    <span>&#9733;</span>
                    <p class="total-rating">4</p>
                    <p class="rating-count">(969)</p>
                  </div>
                  <!-- rating end -->
                </div>
                <div class="col-lg-6 pl-md-4 pl-lg-0">
                  <!-- time buttons -->

                
                  <ul class="time-btns d-desktop-for-tab" id="sloat-p{{ $value->id }}"> 
                    @php 
                    $sloat=\App\Models\AppointmentSlots::getSloat($value->id, $date);
                   // $sloat=\App\Models\AppointmentSlots::getSloatTab($value->id,$date);
                  @endphp 
                 {{--  @foreach ($appointments[$value->id] as $key => $appointment)
                    
                    <li><a href="#">{{ date('h:i A', strtotime($appointment->slot_time)) }}</a></li>        
                  @endforeach --}}
                {{--    @foreach ($unique_sloat[$value->id] as $key => $unique)
                 @if(array_search($unique['slot_time'], array_column($appointments[$value->id], 'slot_time'))>0 && array_search($date, array_column($appointments[$value->id], 'slot_date')))
                       <li><a href="#">{{ date("h:m a",strtotime($unique['slot_time'])) }}</a></li>
                   @else
                      <li><a href="#">{{ array_search($unique['slot_time'], array_column($appointments[$value->id], 'slot_time')) }}--{{ array_search($date, array_column($appointments[$value->id], 'slot_date')) }}</a></li>
                   @endif
                   @if(array_search($unique['slot_time'], array_column($appointments[$value->id], 'slot_time'))>0 && array_search($date, array_column($appointments[$value->id], 'slot_date')))
                       <li><a href="#">{{ date("h:m a",strtotime($unique['slot_time'])) }}</a></li>
                   @else
                      <li><a href="#">--</a></li>
                   @endif
                   @if(array_search($unique['slot_time'], array_column($appointments[$value->id], 'slot_time'))>0 && array_search($date, array_column($appointments[$value->id], 'slot_date')))
                       <li><a href="#">{{ date("h:m a",strtotime($unique['slot_time'])) }}</a></li>
                   @else
                      <li><a href="#">--</a></li>
                   @endif
                   @if(array_search($unique['slot_time'], array_column($appointments[$value->id], 'slot_time'))>0 && array_search($date, array_column($appointments[$value->id], 'slot_date')))
                       <li><a href="#">{{ date("h:m a",strtotime($unique['slot_time'])) }}</a></li>
                   @else
                      <li><a href="#">--</a></li>
                   @endif
                 
                           
                  @endforeach --}}
                 
                  </ul>
                  <!-- time buttons end -->

                  <ul class="time-btns d-tab">
                  </ul>
                </div>
                <div class="col-lg-12 pl-md-4">
                  <div class="inr-line-btn">
                    <a class="blue-anchor" href="#" data-toggle="modal"  onclick="view_all_availability({{$value->id}})">
                      <!-- calendar icon -->
                      <svg id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <path d="m446 40h-46v-24c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-224v-24c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-46c-36.393 0-66 29.607-66 66v340c0 36.393 29.607 66 66 66h380c36.393 0 66-29.607 66-66v-340c0-36.393-29.607-66-66-66zm34 406c0 18.778-15.222 34-34 34h-380c-18.778 0-34-15.222-34-34v-265c0-2.761 2.239-5 5-5h438c2.761 0 5 2.239 5 5z"/>
                        </g>
                      </svg>
                      <!-- calendar icon end -->
                      View all availability
                    </a>
                    <a class="blue-anchor" href="{{ route('doctor.details', [$value->id]) }}">
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
          @endforeach
          <!-- doctor list -->
       
          <!-- doctor list end -->
        </div>
        <div class="col-lg-4">
          <!-- map -->
            <div id="map" style="width: 100%; height: 500px;"></div>
         {{--  <div class="loc-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d463522.6072642181!2d78.79619623857486!3d24.820425914447725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1606175912511!5m2!1sen!2sin" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div> --}}
          <!-- map end -->
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade exampleModalScrollable1" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog mb-0 mt-auto modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content" id="availity-body">
      
    
      
    </div>
  </div>
</div>
<!-- modal end -->
<input type="hidden" name="sloat" id="sloat-doctor-details" value="0">
<!-- inner page content end -->
<script type="text/javascript">

function submitform(type){ 
  $("#short").val(type);
  document.forms['search-form'].submit(); 
}


  var slot_url = "{{ route('get.doctor.appoinment.slot') }}";
  var availity_url = "{{ route('get.doctor.appoinment.availity') }}";
  var availity_more_url = "{{ route('get.doctor.appoinment.availity.more') }}";
  var date_slot_url = "{{ route('get.doctor.appoinment.slot.by.date') }}";
  var change_type_slot_url = "{{ route('get.doctor.appoinment.slot.change.type') }}";
  var new_date = <?php echo date("Ymd",strtotime($date)); ?>;
  var availity_date = <?php echo date("Ymd",strtotime($date)); ?>;
  var availity_date_start = <?php echo date("Ymd",strtotime($date)); ?>;
  var locations = <?php echo json_encode($lact_new); ?>; 
  var blank = <?php echo json_encode($location_blank); ?>;
  var doctorlistid = <?php echo json_encode($doctor_id_list); ?>;
  
  var min_date = <?php echo date("Ymd",strtotime(date("d-m-Y"))); ?>;
  var date_list_start = <?php echo date("Ymd",strtotime($date)); ?>;
  var date_list_end = <?php echo date("Ymd",strtotime($date.'+3 days')); ?>;
  var page_type=1;
  var appoinment_type='';
  
  function initMap() { 
    var bounds = new google.maps.LatLngBounds; 
    var markersArray = []; 
      //var origin2 = "{{ \Illuminate\Support\Facades\Session::get('booking.search')}}";
      var origin2='Noida';
      var destinationIcon = 'https://chart.googleapis.com/chart?' +
        'chst=d_map_pin_letter&chld=B|f5ac32|000000';
      var originIcon = 'https://chart.googleapis.com/chart?' +
        'chst=d_map_pin_letter&chld=O|FFFF00|000000';
      var image = "http://galaxydemo.in/m3.jpg";
      // var image = {{ asset('public/storage/images/logo/logo-map.jpg') }};
      var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 28.53, lng: 77.39},
        zoom: 10
      });

    var geocoder = new google.maps.Geocoder; 
    var service = new google.maps.DistanceMatrixService;
    service.getDistanceMatrix({
      origins: [origin2],
      destinations: locations,
      travelMode: 'DRIVING',
      // unitSystem: google.maps.UnitSystem.IMPERIAL,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
    }, function(response, status) {
      if (status !== 'OK') {
       // alert('Error was: ' + status);
      } else {
        var originList = response.originAddresses;
        var destinationList = response.destinationAddresses;                
        deleteMarkers(markersArray);
        var showGeocodedAddressOnMap = function(asDestination, name) {
          var icon = asDestination ? destinationIcon : originIcon;
          if(asDestination){
            return function(results, status) {
              if (status === 'OK') {
                map.fitBounds(bounds.extend(results[0].geometry.location));
                markersArray.push(new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location,
                  icon: image,
                  title:name
                }));
              } else {
               // alert('Geocode was not successful due to: ' + status);
              }
            };
          }
        };
        var count=0;
        for (var i = 0; i < originList.length; i++) {
          var results = response.rows[i].elements;
          geocoder.geocode({'address': originList[i]},
              showGeocodedAddressOnMap(false,' '));
          for(var j = 0; j < results.length; j++) {
              for (var p=0, len=blank.length;p<len;p++) {
                if (blank[p] == j){
                    count++;
                }  
            }
            geocoder.geocode({'address': destinationList[j]},
                showGeocodedAddressOnMap(true,locations[j]['title']));  
                  $("#distance-total"+count).html(results[j].distance.text+' From '+originList[0]); 
                  count++;
          }
        }
      }
    });
  }
  function deleteMarkers(markersArray) {
    for (var i = 0; i < markersArray.length; i++) {
      markersArray[i].setMap(null);
    }
    markersArray = [];
  }

  
</script>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfaLWLOOJzGnXan4NM8-sk6OSr53b_W4k&callback=initMap"> </script>
@endsection
 
 
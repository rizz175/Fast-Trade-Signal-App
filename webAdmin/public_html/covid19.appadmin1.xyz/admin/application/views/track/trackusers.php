<?php $this->load->view("include/header") ?>

<style>

.my-switch .slider:before {
    height: 17px!important;
    width: 17px!important;
    left: 3px!important;
    bottom: 3px!important;
}

.my-switch input:checked + .slider:before {
    -webkit-transform: translateX(19px)!important;
    -ms-transform: translateX(19px)!important;
    transform: translateX(19px)!important;
}

.my-switch.switch {
    width: 42px!important;
    height: 22px!important;
}



</style>

<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
        width:100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
</style>

<!-- Begin Page Content -->

<div class="container-fluid" id="app"> 

  <!-- Show user details Modal-->
  <!-- <div class="modal fade" id="showdetailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{user.username}}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <center><img v-bind:src="user.profile_pic" height="100"></center><br>
          <div class="d-block"><label><b>Email:</b> </label> {{user.email}}</div>
          <div class="d-block"><label><b>Age:</b> </label> {{user.age}} Years</div>
          <div class="d-block"><label><b>Location:</b> </label> {{user.location}}</div>
          <div class="d-block"><label><b>Address1:</b> </label> {{user.address1}}</div>
          <div class="d-block"><label><b>Address2:</b> </label> {{user.address2}}</div>
          <div class="d-block"><label><b>Registered from:</b> </label> {{user.social_account_type}}</div>
          <div class="d-block"><label><b>Registration date:</b> </label> {{user.dated}}</div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> -->
  
 
  <div class="row">
      
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Positive Predicted</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$positive?></div>
            </div>
            <div class="col-auto"> <i style="font-size:30px;" class="fas fa-thermometer-full text-danger"></i> </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Negative Predicted</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$negative?></div>
            </div>
            <div class="col-auto"> <i style="font-size:30px;" class="fas fa-thermometer-empty text-success"></i> </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Track users</h6>
    </div>
    <div class="card-body">
        
        <div id="map"></div>

    </div>
  </>
</div>
<!-- /.container-fluid -->

<?php $this->load->view("include/footer") ?>



<script>

    var geolocation=<?=json_encode($geolocation);?>;
    
    //console.log(geolocation);

    var map;
    function initMap() {
    map = new google.maps.Map(
        document.getElementById('map'),
        {   
            //center: new google.maps.LatLng(-26.0903458,26.2616818), 
            zoom: 5,
            //mapTypeId: google.maps.MapTypeId.ROADMAP
        });

    var iconBase ='<?=site_url("assets/images/")?>';

    var icons = {
        normal: {
        icon: iconBase + 'marker-normal.png'
        },
        abnormal: {
        icon: iconBase + 'marker-fever.png'
        }
    };

    var features=[];

    $.map(geolocation, function(elem,ind){
        
        let type="normal";
        let desc="Negative";

        if(elem["result"]=="0"){
            type="abnormal";
            desc="Positive";
        }
        
        features.push({position: new google.maps.LatLng(elem.lat, elem.lng), type: type, desc: desc });
    });

    
    
    var markers=[];

    var infowindow = new google.maps.InfoWindow();

    var bounds = new google.maps.LatLngBounds();

    // Create markers.
    for (var i = 0; i < features.length; i++) {
        
        var marker = new google.maps.Marker({
            position: features[i].position,
            icon: icons[features[i].type].icon,
            map: map
        });

        markers.push(marker);

        bounds.extend(marker.position);

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            
            return function() {
                infowindow.setContent(features[i].desc);
                infowindow.open(map, marker);
            }
        })(marker, i));

        // Add a marker clusterer to manage the markers.
        

    }

    // var markerCluster = new MarkerClusterer(map, markers,
    //         {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      

    map.fitBounds(bounds);

    


    }
</script>

<!-- <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script> -->

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=<?=$this->config->item("gmap_apikey")?>&callback=initMap">
</script>


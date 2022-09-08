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
        height: 400px;
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
  <div class="modal fade" id="showdetailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{user.fname+" "+user.lname}}</h5>
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
          <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!----Show on map----->
  <div class="modal fade" id="showmapmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Map</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="map"></div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Page Heading -->
  <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
  <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Circle Violations</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Violation on Map</th>
              <th>User Details</th>
              <th>Dated</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Violation on Map</th>
              <th>User Details</th>
              <th>Dated</th>
            </tr>
          </tfoot>
          <tbody>
            <?php if($data){ foreach($data as $row){ ?>
            <tr>
              <td>
                <?php if(empty($row->profile_pic)){$row->profile_pic="default.png";}?>
                <img class='mb-1' width="70" src="<?=site_url("assets/imgs/profile/200x200/").$row->profile_pic?>"><br>
                <?=$row->fname." ".$row->lname?>
              </td>
              
              <td>
                <span onclick="showmapmodal('<?=$row->lat?>','<?=$row->lng?>')" class="badge badge-primary" style="cursor:pointer;"><i class="fas fa-map-marked-alt"></i></span>
              </td>

              <td>
                
                <span @click='viewdetails("<?=$row->user_id?>")' class="badge badge-primary" style="cursor:pointer;"><i class="fas fa-eye"></i></span>

              </td>

              <td>
                <span class="d-none"><?=$row->dated?></span>
                <?=time_elapsed_string($row->dated)?><br>               
              </td>
            </tr>
            <?php } } ?>
           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<?php $this->load->view("include/footer") ?>


<script>

new Vue({
  el: '#app',
  data() {
    return {
      user:{address1:"",address2:"",age:"",dated:"",email:"",id:"",last_login:"",location:"",mob_code:"",mobile:"",profile_pic:"",social_account_type:"",status:"",user_points:"",username:""},
      
    }
  },
  methods: {

    

    viewdetails(id){
        
        $("#loading_div").css("display","block");

        let formData = new FormData();
        formData.append('id', id);

        axios.post("<?=site_url("user/details")?>", formData) 
        .then(response => {

            if(response){

                this.user=response.data;

                if(!this.user.profile_pic){this.user.profile_pic="default.png";}

                this.user.profile_pic="<?=site_url("assets/imgs/profile/200x200/")?>"+this.user.profile_pic;

                this.user.dated=this.user.dated.split(" ")[0];

                if(!this.user.social_account_type){
                    this.user.social_account_type="Simple Registration";
                }

                $("#showdetailmodal").modal("show");
            }

            $("#loading_div").css("display","none");

        })
        .catch(e => {
            alert('There is some issue! Kindly try again.');
            $("#loading_div").css("display","none");
        });

     


    }

  }

});


function showmapmodal(lat, lng){

    if(lat&&lng){
        
        position = new google.maps.LatLng(lat, lng);
        marker.setPosition(position);
        map.panTo(position);

        $("#showmapmodal").modal("show");
    }
}

var geolocation=[];
var map, marker;

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


    //var infowindow = new google.maps.InfoWindow();

    var bounds = new google.maps.LatLngBounds();

    // Create markers.
        
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(-26.0903458,26.261681),
        icon: icons['abnormal'].icon,
        map: map
    });


    bounds.extend(marker.position);
    

    map.fitBounds(bounds);

}

</script>

<!-- <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script> -->

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=<?=$this->config->item("gmap_apikey")?>&callback=initMap">
</script>
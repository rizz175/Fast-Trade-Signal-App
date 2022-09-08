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

<!-- Begin Page Content -->

<div class="container-fluid" id="app"> 

  <!-- Show user details Modal-->
  <div class="modal fade" id="showdetailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <h6 class="m-0 font-weight-bold text-primary">Users</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Location</th>
              <th>Mobile</th>
              <th>Missed Assessment</th>
              <th>Status</th>
              <th>Last Login</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Location</th>
              <th>Mobile</th>
              <th>Missed Assessment</th>
              <th>Status</th>
              <th>Last Login</th>
            </tr>
          </tfoot>
          <tbody>
            <?php if($users){ foreach($users as $user){ ?>
            <tr>
              <td>
                <?php if(empty($user->profile_pic)){$user->profile_pic="default.png";}?>
                <img class='mb-1' width="70" src="<?=site_url("assets/imgs/profile/200x200/").$user->profile_pic?>"><br>
                <?=$user->username?>
              </td>
              <td><?=$user->location?></td>
              <td><?=$user->mob_code."-".$user->mobile?></td>
              <td>
              
              <?=$user->assessment_count<=0?"<span class='badge badge-success'>Never</span>":"<span class='badge badge-danger'>".abs($user->assessment_count)." times</span>"?>
              
              </td>
              <td>
              
                <label class="switch my-switch" style="vertical-align:middle;">
                  <input type="checkbox" <?=$user->status=="active"?"checked":""?> @change="change_status(<?=$user->id?>, $event)">
                  <span class="slider round"></span>
                </label>

              </td>
              <td>
                <span class="d-none"><?=$user->last_login?></span>
                <?=time_elapsed_string($user->last_login)?><br>
                <span @click='viewdetails(<?=json_encode($user, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)?>)' class="badge badge-primary" style="cursor:pointer;"><i class="fas fa-eye"></i></span>

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

    change_status (id, event) {
      
      var is_checked=$(event.target).prop("checked")?"active":"inactive";

      $("#loading_div").css("display","block");

      let formData = new FormData();
      formData.append('id', id);
      formData.append('is_checked', is_checked);

      axios.post("<?=site_url("User/change_status")?>", formData) 
      .then(response => {

        if(!response){
          alert("There is some issue! Kindly try again.");
        }

        $("#loading_div").css("display","none");

      })
      .catch(e => {
        alert('There is some issue! Kindly try again.');
        $("#loading_div").css("display","none");
      })

    },

    viewdetails(user){
      
      this.user=user;

      if(!this.user.profile_pic){this.user.profile_pic="default.png";}

      this.user.profile_pic="<?=site_url("assets/imgs/profile/200x200/")?>"+this.user.profile_pic;
      
      this.user.dated=this.user.dated.split(" ")[0];

      if(!this.user.social_account_type){
        this.user.social_account_type="Simple Registration";
      }

      $("#showdetailmodal").modal("show");
    }

  }

});

</script>

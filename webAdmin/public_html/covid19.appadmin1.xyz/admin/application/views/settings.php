<?php $this->load->view("include/header") ?>


<style>

  .image_upload_preview{
    width: 125px;
    height: 125px;
    cursor: pointer;
    margin-bottom:10px;
    background-size:cover;
    opacity:0.8;
    background-position:50% 50%;
  }

  .image_upload_preview:hover{
    opacity:1;
  }

  .error_input{
    border:1px solid #ed1c25!important;
  }

  .error-text{
    color:#ed1c25;
    font-size:14px;
  }

</style>

<!-- Begin Page Content -->

<div id="app" class="container-fluid"> 
  
  <!-- Page Heading -->
  <!--<h1 class="h3 mb-2 text-gray-800">Add New Product</h1>-->
  <p class="mb-4"></p>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Profile Settings</h6>
    </div>
    <div class="card-body">
      
      <form onSubmit="return false;">
      	
        <div class="row">

          <div class="col-12">
            
            <div class="d-none d-lg-block" style="margin-top: 0px;"></div>
            <!-- <label for="featuredimg">Profile Picture</label> -->
            <div id="featuredimg" @click="trigger" class="image_upload_preview mx-auto d-block rounded-circle" v-bind:style="{backgroundImage:'url('+p_img+')'}"></div>

          </div>

          <div class="col-12">

            <div class="row">

              <div class="form-group col-12 col-sm-6">
                <label for="fname">First Name:</label>
                <input v-bind:class="{error_input:errors.fname}" type="text" class="form-control" id="fname" v-model="fname" required>
                <div class="error-text" v-if="errors.fname">This field is required</div>
              </div>

              <div class="form-group col-12 col-sm-6">
                <label for="lname">Last Name:</label>
                <input v-bind:class="{error_input:errors.lname}" type="text" class="form-control" id="lname" v-model="lname" required>
                <div class="error-text" v-if="errors.lname">This field is required</div>
              </div>
            
            </div>

            <div class="row">

              <div class="form-group col-12">
                <label for="email">Email:</label>
                <input type="text" class="form-control disabled" id="email" v-model="email" disabled>
                <!-- <div class="error-text" v-if="errors.price">This field is required</div> -->
              </div>

            </div>

            <div class="row">

                <div class="form-group col-12 col-sm-6">
                <label for="password">Password:</label>
                <input v-bind:class="{error_input:errors.password}" type="password" class="form-control" id="password" v-model="password" required>
                <div class="error-text" v-if="errors.password">This field is required</div>
                </div>

                <div class="form-group col-12 col-sm-6">
                <label for="cpassword">Confirm Password:</label>
                <input v-bind:class="{error_input:errors.cpassword}" type="password" class="form-control" id="cpassword" v-model="cpassword" required>
                <div class="error-text" v-if="errors.cpassword">Passwords must be same</div>
                </div>

            </div>

          </div>


         

        </div>
        
        


        <button type="submit" @click="submitForm()" class="btn btn-primary btn-icon-split mt-3 mb-3 mx-auto d-block">
          
          <span class="text text-white">Update Profile</span>

          <span class="icon text-white-50">
            <i class="fas fa-arrow-right"></i>
          </span>
          
        </button>
  
        <input class="d-none" type="file" @change="onFileChange" ref="fileInput" accept="image/*"/>

      </form>
      
    </div>
  </div>



</div>
<!-- /.container-fluid -->

<?php $this->load->view("include/footer") ?>


<script>

var data=<?=json_encode($data)?>;

const vm = new Vue({
  el: '#app',
  data() {
    return {
      p_img: data.profile_pic,
      image_file:null,
      fname:data.fname,
      lname:data.lname,
      email:data.email,
      password:data.password,
      cpassword:data.password,
      realpass:data.password,
      errors:{"fname":false, "lname":false, "password":false, "cpassword":false},
    }
  },
  watch: {
    fname(){
      this.errors.fname=false;
      if(!this.fname){
          this.errors.fname=true;
      }
    },
    lname(){
      this.errors.lname=false;
      if(!this.lname){
          this.errors.lname=true;
      }
    },
    password(){
      this.errors.password=false;
      if(!this.password){
          this.errors.password=true;
      }else{
          if(this.password!=this.cpassword){
            this.errors.cpassword=true;
          }else{
            this.errors.cpassword=false;
          }
      }
    },
    cpassword(){
      this.errors.cpassword=false;
      if(!this.cpassword){
          this.errors.cpassword=true;
      }else{
          if(this.password!=this.cpassword){
            this.errors.cpassword=true;
          }
      }
    }
  },
  methods: {

    trigger () {
    	this.$refs.fileInput.click()
    },

    onFileChange(e) {
      
      const file = e.target.files[0];

      if(file){
        this.p_img = URL.createObjectURL(file);
        this.image_file = this.$refs.fileInput.files[0];
      }else{
        this.p_img="<?=site_url("assets/images")?>/default.jpg";
        this.image_file=null;
      }

    },

    submitForm(){
      
      if(this.validateForm()){

        $loading_percentage=$("#loading_percentage");
        $loading_div=$("#loading_div");

        $loading_percentage.css("display","block");
        $loading_div.css("display","block");
        
        let formData = new FormData();

        formData.append('file[]', this.image_file);
        formData.append('fname', this.fname);
        formData.append('lname', this.lname);
        formData.append('password', this.password);
        formData.append('cpassword', this.cpassword);
        formData.append('realpass', this.realpass);
        
        axios.post( '<?=site_url("settings/save")?>',
              formData,
              {
              headers: {
                  'Content-Type': 'multipart/form-data'
              },
              onUploadProgress: function( progressEvent ) {
                
                this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ));
                
                $(".progress-bar", $loading_percentage).css("width", this.uploadPercentage+"%");
                $(".progress-bar", $loading_percentage).text(this.uploadPercentage+"%");

              }.bind(this),
            }
          ).then(function(d){
          
          
            $loading_percentage.css("display","none");
            $loading_div.css("display","none");

            if(d.data.status==200){
              window.location = window.location.href.replace("#","");
            }else{
              alert("There is some error while uploading! Kindly try again.");
            }

        })
        .catch(function(){

          console.log('FAILURE!!');

          $loading_percentage.css("display","none");
          $loading_div.css("display","none");

          alert("There is some error while uploading! Kindly try again.");
        });
      }
     

    },

    validateForm(){

      this.errors.fname=this.errors.lname=this.errors.password=this.errors.cpassword=false;

      var error=true;

      if(!this.fname){
          this.errors.fname=true;
          error=false;
      }

      if(!this.lname){
          this.errors.lname=true;
          error=false;
      }

      if(!this.password){
          this.errors.password=true;
          error=false;
      }

      if(!this.cpassword){
          this.errors.cpassword=true;
          error=false;
      }

      else{

          if(this.password!=this.cpassword){
            this.errors.cpassword=true;
            error=false;
          }
      }

      return error;
    }
  }
});

</script>

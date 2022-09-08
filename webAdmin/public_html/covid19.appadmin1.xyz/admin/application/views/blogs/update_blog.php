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
  <!--<h1 class="h3 mb-2 text-gray-800">Add New Blog</h1>-->
  <p class="mb-4"></p>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Update Blog</h6>
    </div>
    <div class="card-body">
      
      <form onSubmit="return false;">
      	
        <div class="row">

          <div class="col-12 col-lg-6">

            <div class="row">

              <div class="form-group col-12">
                <label for="title">Title*:</label>
                <input v-bind:class="{error_input:errors.title}" type="text" class="form-control" id="title" v-model="title" required>
                <div class="error-text" v-if="errors.title">This field is required</div>
              </div>
            
            </div>

            <div class="row">

              <div class="form-group col-12">
                <label for="youtube">Youtube Url:</label>
                <input type="text" class="form-control" id="youtube" v-model="youtube">
              </div>

            </div>

          </div>


          <div class="col-12 col-lg-6">
            
            <div class="d-none d-lg-block" style="margin-top: 30px;"></div>
          
            <div @click="trigger" class="image_upload_preview" v-bind:style="{backgroundImage:'url('+p_img+')'}"></div>

          </div>

        </div>
        
        

        <div class="form-group">
          <label for="description">Description*:</label>
          <textarea class="form-control" v-bind:class="{error_input:errors.description}" rows="5" v-model="description" required></textarea>
          <div class="error-text" v-if="errors.description">This field is required</div>
        </div>
        
        <div class="row">
          <div class="col-12">
              <label class="switch" style="vertical-align:middle;">
                <input type="checkbox" checked v-model="status">
                <span class="slider round"></span>
              </label>
          </div>
        </div>

        <button type="submit" @click="submitForm()" class="btn btn-primary btn-icon-split mt-3 mb-3">
          
          <span class="text text-white">Update Blog</span>

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

var blog=<?=json_encode($blog)?>;

const vm = new Vue({
  el: '#app',
  data() {
    return {
      p_img: blog.cover_img,
      image_file:null,
      description:blog.description,
      title:blog.title,
      youtube:blog.youtube,
      status:blog.status==1?true:false,
      uploadPercentage: 0,
      errors:{"title":false, description:false},
    }
  },
  watch: {
    title(){
      this.errors.title=false;
      if(!this.title){
          this.errors.title=true;
      }
    },
    description(){
      this.errors.description=false;
      if(!this.description){
          this.errors.description=true;
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
        formData.append('title', this.title);
        formData.append('description', this.description);
        formData.append('youtube', this.youtube);
        formData.append('status', this.status?1:0);
        
        axios.post( '<?=site_url("blog/save/")?>'+blog.id,
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

      this.errors.title=this.errors.description=false;

      var error=true;

      if(!this.title){
          this.errors.title=true;
          error=false;
      }

      if(!this.description){
          this.errors.description=true;
          error=false;
      }

      return error;
    }
  }
});

</script>

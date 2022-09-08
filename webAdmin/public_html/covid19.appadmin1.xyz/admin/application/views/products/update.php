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


  .preview_p__imgs{
    display:inline-block;
    margin-right: 10px;
    position:relative;
  }

  .rm_span__img{
    position:absolute;
    top:3px;
    right:3px;
    cursor:pointer;
  }

  span.rm_span__img i {
      border-radius: 100%;
      color: #000;
  }

  #loading_div{
    display:block;
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
      <h6 class="m-0 font-weight-bold text-primary">Update Product</h6>
    </div>
    <div class="card-body">
      
      <form onSubmit="return false;">
      	
        <div class="row">

          <div class="col-12 col-lg-6">

            <div class="row">

              <div class="form-group col-12">
                <label for="title">Title*:</label>
                <input v-bind:class="{error_input:errors.title}" type="text" class="form-control" id="title" v-model="title" required>
                <div class="error-text" v-if="errors.title">Title is required</div>
              </div>
            
            </div>

            <div class="row">

              <div class="form-group col-12 col-sm-6">
                <label for="youtube">Orignal Price*:</label>
                <input v-bind:class="{error_input:errors.price}" type="number" class="form-control" id="price" v-model="price" step="0.01" placeholder="Enter price in USD">
                <div class="error-text" v-if="errors.price">Price is required</div>
              </div>


              <div class="form-group col-12 col-sm-6">
                <label for="youtube">Discounted Price:</label>
                <input type="number" class="form-control" id="discount_price" v-model="discount_price" step="0.01" placeholder="Enter off price in USD">
                <!-- <div class="error-text" v-if="errors.price">Price is required</div> -->
              </div>


              <div class="form-group col-12 col-sm-6">
                <label for="youtube">Discount in Percentage:</label>
                
                <div class="input-group mb-3">
                <input type="text" class="form-control" id="discount_percentage" v-model="discount_percentage" disabled>
                <div class="input-group-append">
                  <button class="btn btn-success" type="button">%</button>
                </div>
                </div>
                <!-- <div class="error-text" v-if="errors.price">Price is required</div> -->
              </div>


              <div class="form-group col-12 col-sm-6">
                <label for="youtube">Quantity*:</label>
                <input v-bind:class="{error_input:errors.quantity}" type="number" class="form-control" id="quantity" v-model="quantity">
                <div class="error-text" v-if="errors.quantity">Quantity is required</div>
              </div>

            </div>

          </div>


          <div class="col-12 col-lg-6">
            
            <div class="d-none d-lg-block" style="margin-top: 0px;"></div>
            <label for="featuredimg">Featured Image</label>
            <div id="featuredimg" @click="trigger" class="image_upload_preview" v-bind:style="{backgroundImage:'url('+p_img+')'}"></div>

          </div>

        </div>
        


        <button class="btn btn-light mb-2" style='border:1px solid #eee;' onclick="$('#product__imgs').click();" type="button">Upload gallery images</button> 

        <input class="d-none" id="product__imgs" type="file" multiple accept="image/*" @change="onFiles2Change"/>

        <div class="d-block mb-3">
          <div class="mt-3 preview_p__imgs" v-for="(image, key) in images" :key="key">
              <img class="preview" :ref="'image'" width="100" height="100"/>
              <span class="rm_span__img" @click="remove_imgs(key)"><i class="fas fa-times-circle"></i></span>      
          </div>
        </div>
        

        <div class="form-group">
          <label for="description">Description*:</label>
          <textarea class="form-control" v-bind:class="{error_input:errors.description}" rows="5" v-model="description" required></textarea>
          <div class="error-text" v-if="errors.description">Description is required</div>
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
          
          <span class="text text-white">Update Product</span>

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

$(function(){
  $("#loading_div").css("display","none");
});

var data=<?=json_encode($data)?>;

const vm = new Vue({
  el: '#app',
  data() {
    return {
      p_img: data.cover_img,
      image_file:null,
      description:data.description,
      title:data.title,
      price:data.price,
      quantity:data.quantity,
      status:data.status==1?true:false,
      uploadPercentage: 0,
      discount_percentage:data.discount_percentage,
      discount_price:data.discount_price,
      errors:{"title":false, description:false, price:false, quantity:false},
      images: data.images,
      remove_images:[],
      img_order:data.img_order
    }
  },
  mounted(){

    for (let i = 0; i < this.images.length; i++) {
      
      if(this.images[i].img_order){//If img is already uploaded
      
        this.$refs.image[i].src = this.images[i].img;
      
      }
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
    },
    price(){
      this.errors.price=false;
      if(!this.price){
          this.errors.price=true;
      }

      if(this.discount_price&&this.price){
        this.discount_percentage=100-Math.round((this.discount_price/this.price)*100);
      }else{
        this.discount_percentage=0;
      }
      
    },
    quantity(){
      this.errors.quantity=false;
      if(!this.quantity){
          this.errors.quantity=true;
      }
    },

    discount_price(){

      if(this.price&&this.discount_price){
        this.discount_percentage=100-Math.round((this.discount_price/this.price)*100);
      }else{
        this.discount_percentage=0;
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

    onFiles2Change(e){

      let vm = this;
      var selectedFiles = e.target.files;
      for (let i = 0; i < selectedFiles.length; i++) {
        this.images.push(selectedFiles[i]);
      }

      for (let i = 0; i < this.images.length; i++) {
        
        if(!this.images[i].img_order){//If img is not already uploaded
         
          let reader = new FileReader();
          
          reader.onload = (e) => {
            this.$refs.image[i].src = reader.result;
          };

          reader.readAsDataURL(this.images[i]);
        }
      }

      $("#product__imgs").val("");

      },

    remove_imgs(k){

      //console.log(k);
      
      if(this.images[k].img_order){//If image is already uploaded then note down to remove this from server
        this.remove_images.push({"id":this.images[k].id,"name":this.images[k].img_name});
      }

      this.images.splice(k,1);

      //console.log(this.images);

      for (let i = 0; i < this.images.length; i++) {
        
        if(!this.images[i].img_order){//If this image is not uploaded to server
          let reader = new FileReader();
          
          reader.onload = (e) => {
            this.$refs.image[i].src = reader.result;
          };

          reader.readAsDataURL(this.images[i]);
        }
        
        else{//If server uploaded image
          this.$refs.image[i].src = this.images[i].img;
        }
      }
    
    },

    submitForm(){
      
      if(this.validateForm()){

        $loading_percentage=$("#loading_percentage");
        $loading_div=$("#loading_div");

        $loading_percentage.css("display","block");
        $loading_div.css("display","block");
        
        let formData = new FormData();

        var ii=0;
        for(single_img in this.images){
          if(!this.images[single_img].img_order){//Don't push already uploaded images inside array
            formData.append('files['+ii+']', this.images[single_img]);
            ii++;
          }
        }
        
        formData.append('remove_images', JSON.stringify(this.remove_images));
        formData.append('img_order', this.img_order);
        formData.append('file[]', this.image_file);
        formData.append('title', this.title);
        formData.append('description', this.description);
        formData.append('price', this.price);
        formData.append('quantity', this.quantity);
        formData.append('status', this.status?1:0);
        formData.append('discount_percentage', this.discount_percentage);
        formData.append('discount_price', this.discount_price);
                
        axios.post( '<?=site_url("product/save/")?>'+data.id,
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

      this.errors.title=this.errors.description=this.errors.quantity=this.errors.price=false;

      var error=true;

      if(!this.title){
          this.errors.title=true;
          error=false;
      }

      if(!this.description){
          this.errors.description=true;
          error=false;
      }

      if(!this.price){
          this.errors.price=true;
          error=false;
      }

      if(!this.quantity){
          this.errors.quantity=true;
          error=false;
      }

      return error;
    }
  }
});

</script>

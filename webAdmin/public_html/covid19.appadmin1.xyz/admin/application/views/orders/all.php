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

select.form-control option, select.form-control{
  cursor:pointer;
}

</style>

<!-- Begin Page Content -->

<div class="container-fluid" id="app"> 

  <!-- Show user details Modal-->
  <div class="modal fade" id="showdetailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="color:#333;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color:#000;">Order# {{user.id}}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <center><img v-bind:src="user.profile_pic" height="100"></center><br>
          <div class="d-block"><label><b style="color:#000;">User Name:</b> </label> {{user.fname+" "+user.lname}}</div>
          <div class="d-block"><label><b style="color:#000;">Address:</b> </label> {{user.address}}</div>
          <div class="d-block"><label><b style="color:#000;">Mobile#:</b> </label> {{user.mobile}}</div>
          
          <div class="table-responsive mt-2">

          <table class="table">
            <thead>
              <tr>
                <th style="color:#000;">Product</th>
                <th style="color:#000;">Price</th>
                <th style="color:#000;">Quantity</th>
                <th style="color:#000;">Total</th>
              </tr>
            </thead>
            <tbody>
              
              <tr v-for="product in products">
                <td style="color:#333;">{{product.title}}</td>
                <td style="color:#333;">${{product.single_item_price}}</td>
                <td style="color:#333;">{{product.quantity}}</td>
                <td style="color:#333;">${{product.single_item_price*product.quantity}}</td>
              </tr>
              

              <tr>
                <td></td>
                <td></td>
                <td style="font-size:20px;color:#000;">Grand Total:</td>
                <td style="font-size:20px;font-weight:bold;color:#000;">${{user.grand_total}}</td>
              </tr>
              
            </tbody>
          </table>

          </div>
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
      <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>User</th>
              <th>Total Amount</th>
              <th>Transaction Type</th>
              <th>Mobile</th>
              <th>Transaction Status</th>
              <th>Order Status</th>
              <th>Dated</th>
              <th>Details</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>User</th>
              <th>Total Amount</th>
              <th>Transaction Type</th>
              <th>Mobile</th>
              <th>Transaction Status</th>
              <th>Order Status</th>
              <th>Dated</th>
              <th>Details</th>
            </tr>
          </tfoot>
          <tbody>
            <?php if($data){ foreach($data as $row){ $row=(object)$row; ?>
            <tr>
              <td>
                <?php if(empty($row->profile_pic)){$row->profile_pic="default.png";}?>
                <img class='mb-1' width="70" src="<?=site_url("assets/imgs/profile/200x200/").$row->profile_pic?>"><br>
                <?=$row->fname." ".$row->lname?>
              </td>
              <td>$<?=$row->grand_total?></td>
              <td><?=ucfirst($row->transaction_type)?></td>
              <td><?=$row->mobile?></td>
             
              <td>
              
              <?php if($row->transaction_type=="paypal"){ ?>
              
                <?=$row->transaction_status=="completed"?"<span class='badge badge-success'>Successful</span>":($row->transaction_status=="failed"?"<span class='badge badge-danger'>Failed</span>":"<span class='badge badge-warning'>Not Completed</span>")?>
              
              <?php } ?>

              </td>

              <td>
                <select class="form-control" style="font-size:13px;padding:3px 3px;width:120px;" @change="changestatus('<?=$row->id?>', $event)">
                  <option value="select_status" <?=$row->order_status=="select_status"?"Selected":""?>>Select Status</option>
                  <option style="background:#e74a3b!important;color:#fff;" value="not_completed" <?=$row->order_status=="not_completed"?"Selected":""?>>Not Completed</option>
                  <option style="background:#1cc88a!important;color:#fff;" value="completed" <?=$row->order_status=="completed"?"Selected":""?>>Completed</option>
                </select>
              </td>

              <td>
                <span class="d-none"><?=$row->dated?></span>
                <?=time_elapsed_string($row->dated)?>
               
              </td>
              <td>
                                
                <span @click='viewdetails(<?=json_encode($row, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE)?>)' class="badge badge-primary" style="cursor:pointer;"><i class="fas fa-eye"></i></span>

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
      user:{},
      products:[],
      
      
    }
  },
  methods: {

    changestatus (id, event) {
      
      let status=$(event.target).val();
      
      $("#loading_div").css("display","block");

      let formData = new FormData();
      formData.append('id', id);
      formData.append('status', status);

      axios.post("<?=site_url("order/change_status")?>", formData) 
      .then(response => {

        if(!response){
          alert("There is some issue! Kindly try again.");
        }

        $("#loading_div").css("display","none");

      })
      .catch(e => {
        alert('There is some issue! Kindly try again.');
        $("#loading_div").css("display","none");
      });

    },

    viewdetails(data){
      
      $("#loading_div").css("display","block");

      let formData = new FormData();
      formData.append('id', data.id);

      axios.post("<?=site_url("order/details")?>", formData) 
      .then(response => {

        //console.log(response);

        this.user=data;

        if(!this.user.profile_pic){this.user.profile_pic="default.png";}

        this.user.profile_pic="<?=site_url("assets/imgs/profile/200x200/")?>"+this.user.profile_pic;

        if(!response){
          alert("There is some issue! Kindly try again.");
        }
        else{
          this.products=response.data;
        }

        $("#loading_div").css("display","none");

      })
      .catch(e => {
        alert('There is some issue! Kindly try again.');
        $("#loading_div").css("display","none");
      });

     
      
      

      $("#showdetailmodal").modal("show");
    }

  }

});

</script>

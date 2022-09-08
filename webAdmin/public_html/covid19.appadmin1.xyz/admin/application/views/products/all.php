<?php $this->load->view("include/header") ?>

        <!-- Begin Page Content -->
        <div class="container-fluid" id="app">

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Price</th>
                      <th>Remaining quantity</th>
                      <th>Status</th>
                      <th>Listed</th>
                      <th>Updated</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <!-- <tfoot>
                    <tr>
                      <th>Cover Image</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Listed</th>
                      <th>Updated</th>
                      <th>Options</th>
                    </tr>
                  </tfoot> -->
                  <tbody>
                    
                    <?php if($data){ ?>
                      <?php foreach($data as $row){ ?>
                        <tr>
                          <td><img src="<?=$row->cover_img?>" width="50"></td>
                          <td><?=substr($row->title,0,20)?></td>
                          
                          <td><?=($row->price)?></td>

                          <td><?=$row->quantity<=0?"<span style='color:#ed1c25;'><u>{$row->quantity}</u></span>":$row->quantity?></td>

                          <td><?=$row->status==1?"<span class='badge badge-success'>Active</span>":"<span class='badge badge-danger'>Inactive</span>"?></td>
                          <td>
                            <span class="d-none"><?=$row->listed_date?></span>
                            <?=$row->added_timeago?>
                          </td>
                          <td>
                            <span class="d-none"><?=$row->modified_date?></span>
                            <?=$row->updated_timeago?>
                          </td>
                          <td>
                            <div class="dropdown btn-dropdown-div">
                              <button type="button" class="btn-dropdown-option btn btn-default dropdown-toggle" data-toggle="dropdown">
                                ...
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=site_url("dashboard/product/edit/").$row->id."/".$row->slug?>">Edit</a>
                                <a class="dropdown-item" onclick="return false;" href="#" @click="messagedelete(<?=$row->id?>, '<?=$row->slug?>')">Delete</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>


          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Alert!</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">Delete this product?</div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                  <button class="btn btn-primary" @click="deleteYes" data-dismiss="modal">Yes</button>
                </div>
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
      blog_id:null,
      slug:null
      
    }
  },
  methods: {

    messagedelete (d,slug) {
    	
      this.id=d;
      this.slug=slug;

      $("#deleteModal").modal("show");
    },

    deleteYes() {

      $("#loading_div").css("display","block");
      
      window.location="<?=site_url("product/delete/")?>"+this.id+"/"+this.slug;

    }
  }
});
</script>
<!doctype html>
<html lang="en">


<head>

   
    <meta charset="utf-8">
    <title>Countries</title>
    <link rel="icon" href="<?php echo site_url("assets/"); ?>assets/img/favicon.ico" sizes="16x16" type="image/icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Monopolion Real Estate Software">
	
	
  	<?php $this->load->view("header/header.php") ?>
   
    <section class="min-vh-100 mt-5" style="padding-top:0px;">
    
    <div class="container">
        <div class="row justify-content-center">
          <div class="col">
            <h2>Monopolion supported countries <?=count($countries)>0?"(".count($countries).")":""?></h2>
            <table class="table">
              <thead>
                <tr>
                  <!--<th>#</th>-->
                  <th scope="col"><b>Country Name</b></th>
                  <th scope="col"><b>Country ISO2 code</b></th>
                  <th scope="col"><b>Cities</b></th>
                  <th scope="col"><b>Sub Area's</b></th>
                </tr>
              </thead>
              <tbody>
                <?php if($countries){ $i=1;?>
                <?php foreach($countries as $row){ ?>
                <tr>
                  <!--<th scope="row"><?php //echo $i; $i++; ?></th>-->
                  <td><?php echo $row->country_name; ?></td>
                  <td><?php echo $row->country_code; ?></td>
                  <td><a target="_blank" href="<?=base_url("show/cities/").$row->id."/".md5($row->id."cities")?>">See cities list</a></td>
                  <td><a target="_blank" href="<?=base_url("show/subareas/").$row->id."/".md5($row->id."subareas")?>">See sub area's list</a></td>
                </tr>
                <?php }
				}
				 ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </section>
    
    <?php $this->load->view("footer/footer.php") ?>

<!-- Mirrored from leap.mediumra.re/account-sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Mar 2019 19:25:29 GMT -->
</html>

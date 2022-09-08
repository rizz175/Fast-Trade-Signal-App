<!doctype html>
<html lang="en">


<head>

   
    <meta charset="utf-8">
    <title>Sub area's of <?=$name?></title>
    <link rel="icon" href="<?php echo site_url("assets/"); ?>assets/img/favicon.ico" sizes="16x16" type="image/icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Monopolion Real Estate Software">
	
	
  	<?php $this->load->view("header/header.php") ?>
   
    <section class="min-vh-100 mt-5" style="padding-top:0px;">
    
    <div class="container">
        <div class="row justify-content-center">
          <div class="col">
            <h2><?=$name?> sub area's <?=$total_sub_areas>0?"(".$total_sub_areas.")":""?></h2><br>
            
             <?php if($data){
					
					foreach($data as $data_row){
						
					$areas=$data_row["data"];	
				?>
            
            
            <p style="color:#0088cc;font-weight:bold;"><?=$data_row["city_title"]." ".($data_row["city_title_other"]?"(".$data_row["city_title_other"].")":"")?></p>
            
            <table class="table">
              <thead>
                <tr>
                  <!--<th>#</th>-->
                  <th scope="col"><b>Sub Area ID</b></th>
                  <th scope="col"><b>Sub Area Name in English</b></th>
                  <th scope="col"><b>Sub Area Name in Local Language</b></th>
                  <!--<th scope="col" style="color:#888;"><b>City Name of Area</b></th>-->
                </tr>
              </thead>
              <tbody>
               
                <?php foreach($areas as $row){ ?>
                <tr>
                  <!--<th scope="row"><?php //echo $i; $i++; ?></th>-->
                  <th><?php echo $row->id; ?></th>
                  <td><?=$row->area_title?></td>
                  
                  <td><?=($row->area_title_other?$row->area_title_other:"")?></td>
                  
                  
                </tr>
                <?php } ?>
				
                
              </tbody>
            </table>
            
            <hr>
            <br>
            
            
                <?php }
				 ?>
            
            
            <?php }
				
				 ?>
                 
          </div>
        </div>
      </div>
      
    </section>
    
    <?php $this->load->view("footer/footer.php") ?>

<!-- Mirrored from leap.mediumra.re/account-sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Mar 2019 19:25:29 GMT -->
</html>

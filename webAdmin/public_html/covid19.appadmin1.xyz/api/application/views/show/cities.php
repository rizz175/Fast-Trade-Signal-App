<!doctype html>
<html lang="en">


<head>

   
    <meta charset="utf-8">
    <title>Cities of <?=$name?></title>
    <link rel="icon" href="<?php echo site_url("assets/"); ?>assets/img/favicon.ico" sizes="16x16" type="image/icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Monopolion Real Estate Software">
	
	
  	<?php $this->load->view("header/header.php") ?>
   
    <section class="min-vh-100 mt-5" style="padding-top:0px;">
    
    <div class="container">
        <div class="row justify-content-center">
          <div class="col">
            <h2><?=$name?> cities <?=count($data)>0?"(".count($data).")":""?></h2>
            <table class="table">
              <thead>
                <tr>
                  <!--<th>#</th>-->
                  <th scope="col"><b>City ID</b></th>
                  <th scope="col"><b>City Name in English</b></th>
                  <th scope="col"><b>City Name in Local Language</b></th>
                </tr>
              </thead>
              <tbody>
                <?php if($data){ $i=1;?>
                <?php foreach($data as $row){ ?>
                <tr>
                  <!--<th scope="row"><?php //echo $i; $i++; ?></th>-->
                  <th><?php echo $row->id; ?></th>
                  <td><?=$row->title?></td>
                  <td><?=($row->title_other?$row->title_other:"")?></td>
                  
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

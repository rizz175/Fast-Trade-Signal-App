<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?=$website_name?></title>
    </head>
    
    <body bgcolor="#f0f3f4" style="margin:0; padding:0; font-family:Arial, Helvetica, sans-serif;font-size:12px; color:#000;">

<center>
<div class="canvas" style="">
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#F9F9F9;" id="bodyTable">
	<tbody><tr>
		<td align="center" valign="top" style="padding-right:10px;padding-left:10px;" id="bodyCell">
		<!--[if (gte mso 9)|(IE)]><table align="center" border="0" cellspacing="0" cellpadding="0" style="width:600px;" width="600"><tr><td align="center" valign="top"><![endif]-->

		
		

		<!-- Email Wrapper Body Open // -->
		<table border="0" cellpadding="0" cellspacing="0" style="max-width:80%;border-radius:10px;" width="100%" class="wrapperBody">
			<tbody><tr>
				<td align="center" valign="top">

					<!-- Table Card Open // -->
					<table border="0" cellpadding="0" cellspacing="0" style="background-color:#FFFFFF;border-color:#E5E5E5; border-style:solid; border-width:0 1px 1px 1px;" width="100%" class="tableCard">

						<tbody><tr>
							<!-- Header Top Border // -->
							<td height="3" style="background-color:#f00005;font-size:1px;line-height:3px;" class="topBorder">&nbsp;</td>
						</tr>


						

						<tr>
							<td align="center" valign="top" style="padding-top: 20px; padding-bottom: 20px; padding-left: 20px; padding-right: 20px;background: rgb(255, 255, 255);" class="mainTitle">
								<!-- Main Title Text // -->
								<h2 class="text" style="color:#fff; font-family:&#39;Poppins&#39;, Helvetica, Arial, sans-serif; font-size:20px; font-weight:500; max-width:330px; font-style:normal; letter-spacing:normal; line-height:36px; text-transform:none; text-align:center; padding:0; margin:0">
									<img src="<?=$logo_url?>">
								</h2>
							</td>
						</tr>

						

						<tr>
							<td align="center" valign="top" style="padding-left:20px;padding-right:20px;" class="containtTable ui-sortable">


								<!-- Divider // -->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td height="1" style="background-color:#E5E5E5;font-size:1px;line-height:1px;" class="divider">&nbsp;</td>
                                    </tr>
                                </tbody></table>

								<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
									<tbody><tr>
										<td align="left" valign="top" style="padding-bottom: 10px;padding-top: 30px;" class="description">
											<!-- Description Text-->
											<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:left; padding:0; margin:0">
												<?=$username?>,
											</p>
                                            
										</td>
                                        
                                        <td align="left" valign="top" style="padding-bottom: 10px;padding-top: 30px;" class="description">
                                            
                                            <!-- Button// -->
											<a href="<?=$full_stats_url?>" style=" border-radius: 3px; -webkit-border-radius: 3px;-moz-border-radius: 3px; color: #fff; text-decoration: none; background-color: #ed1c24; border-top: 5px solid #ed1c24; border-bottom: 5px solid #ed1c24; border-left: 10px solid #ed1c24; border-right: 10px solid #ed1c24;display: inline-block; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px;float:right;height:20px;line-height:20px">See Full Statistics</a>
                                            
										</td>
									</tr>
                                    
                                   
								</tbody></table>
                                
                                
                                
                                
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
									<tbody><tr>
										
                                        
                                        <td align="left" valign="top" style="padding-bottom: 10px;padding-top: 20px;" class="description">
                                        
                                        	<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:left; padding:0; margin:0">
                                        <b>Weekly Report for <?php echo $from." - ".$to; ?>.</b></p><br>
                                           
                                            
                                            <!-- Description Text// -->
											<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:left; padding:0; margin:0">
												This report summarises your weekly statistical analysis results associated with your <?=$website_name?> account. The purpose of this report is to show the consolidated view of user activity.
											</p>
										</td>
									</tr>
                                    
                                   
								</tbody></table>
                                
                                
                                
                                <table class="tableDescription" border="1" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;border:1px solid #ddd; margin-top:10px;">
                                    <tr>
                                        <th width="50%" style="text-align:center;color:#fff;background-color:#ed1c24;vertical-align:middle;padding:10px;border:none;">Total Visits</th>
                                        
                                        
                                        <th width="50%" style="text-align:center;color:#fff;background-color:#ed1c24;vertical-align:middle;padding:10px;border:none;">Visited Properties</th>
                                    </tr>
                                    <tr>
                                    
                                        <td style="text-align:center;font-size:18px;font-weight:bold;padding:15px;vertical-align:middle;"><?php $total_visits_count=0; foreach($props as $row){ $total_visits_count+=$row->total_visits; } echo $total_visits_count; ?></td>
                                        
                                        <td style="text-align:center;font-size:18px;font-weight:bold;padding:15px;vertical-align:middle;"><?= count($props) ?></td>
                                    </tr>
                                </table> 
                                
                                
                               
                                <table class="tableDescription" border="1" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;border:1px solid #ddd; margin-top:30px;">
                                    <tr>
                                        <th width="25%" style="text-align:left;color:#fff;background-color:#F2F2F2;vertical-align:middle;padding:10px;border:none;color: #333333;">Property</th>
                                        
                                        <th width="50%" style="text-align:left;color:#fff;background-color:#F2F2F2;vertical-align:middle;padding:10px;border:none;color: #333333;">Title</th>
                                        
                                        
                                        <th width="25%" style="text-align:left;color:#fff;background-color:#F2F2F2;vertical-align:middle;padding:10px;border:none;color: #333333;">Visits</th>
                                    </tr>
                                    
                                     <?php if($props){ 
										
										$i=-1;
										foreach($props as $row){
										
										$i++;
									?>
                                    
                                    <?php if($i%2==0){ ?>
										<tr style="background-color: #fff;">
									<?php } else{ ?>
                                    	<tr style="background-color: #f9f9f9;">
                                    <?php } ?>
                                    
                                        <td style="text-align:left;font-size:14px;font-weight:400;padding:15px;vertical-align:middle;">
                                        <a class="text" href="<?=$property_url_link.$row->id."?view=list"?>" target="_blank" style="text-decoration:none; display:block;"><img src="<?= $row->img ?>" width="80">
                                        </a>
                                        
                                        <?= $row->reference; ?></td>
                                        
                                        <td style="text-align:left;font-size:14px;font-weight:400;padding:15px;vertical-align:middle;">
										<a class="text" href="<?=$property_url_link.$row->id."?view=list"?>" target="_blank" style="text-decoration:underline; display:block;"><?= $row->title; ?></a>
                                        
                                        </td>
                                        
                                        
                                        <td style="text-align:left;font-size:14px;font-weight:400;padding:15px;vertical-align:middle;"><?= $row->total_visits; ?></td>
                                        
                                    </tr>
                                    
                                     
									<?php } 
                                    
                                    }else{
                                    
                                    ?>
                                	
                                    <tr style="background-color: #fff;">
                                    	<td colspan="3" style="text-align:center;font-size:14px;font-weight:400;padding:15px;vertical-align:middle;">Analytics are not available yet!</td>
                                    </tr>
                                    
                                    <?php } ?>
                                
                                </table> 
                               
                                
                                
                              
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
									<tbody><tr>
										<td align="center" valign="top" style="padding-top:40px;padding-bottom:0px;">

											<!-- Button Table // -->
											<table align="center" border="0" cellpadding="0" cellspacing="0">
												<tbody><tr>
													<td align="center" class="ctaButton" style="border: 2px solid #f00005;background: #fff;padding: 12px 35px;">
														<!-- Button Link // -->
														<a class="text" href="<?=$full_stats_url?>" style="color:#000; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:14px; font-weight:600; font-style:normal; line-height:21px; text-decoration:none; display:block; width:250px;">
															See Full Statistics...
														</a>
													</td>
												</tr>
											</tbody></table>

										</td>
									</tr>
								</tbody></table>
                              
                                
                                <!-- Divider // -->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td height="40px" style="line-height:40px;">&nbsp;</td>
                                    </tr>
                                </tbody></table>
                                
                                
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
									<tbody>
                                    
                                    
                                    <tr>
										<td align="center" valign="top" style="padding-bottom: 0px;padding-top: 5px;" class="description">
											<!-- Description Text// -->
											<p class="text" style="color:#666666; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:center; padding:0; margin:0;">
												Product of Monopolion.com
											</p>
                                            
                                            <a target="_blank" href="<?=$this->config->item("main_url")?>">
                                            <img src="<?=$this->config->item("main_url")?>assets/img/logo2.png" width="100">
                                            </a>
                                            
										</td>
									</tr>
                                    
                                   
								</tbody></table>

								

							</td>
						</tr>

						<tr>
							<td height="0" style="font-size:1px;line-height:1px;">&nbsp;</td>
						</tr>

					
					</tbody>
                    
                    <tbody><tr>
				<td align="center" valign="top">
					<!-- Content Table Open// -->
					<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
						<tbody>

						

						

						<!-- Space -->
						<tr>
							<td height="40" style="font-size:1px;line-height:1px;">&nbsp;</td>
						</tr>
                        
                        	

					</tbody></table>
					<!-- Content Table Close// -->
				</td>
			</tr>

		</tbody>
        
                    </table>
					<!-- Table Card Close// -->

					<!-- Space -->
					<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
						<tbody><tr>
							<td height="50" style="font-size:1px;line-height:1px;">&nbsp;</td>
						</tr>
					</tbody></table>

				</td>
			</tr>
		</tbody>
        
        
        </table>
		<!-- Email Wrapper Body Close // -->

		<!-- Email Wrapper Footer Open // -->
		<table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%" class="wrapperFooter">
			</table>
		<!-- Email Wrapper Footer Close // -->

		<!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
		</td>
	</tr>
</tbody></table>
	</div>
    
    </center>
    
</body>
</html>    
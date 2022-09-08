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
		<table border="0" cellpadding="0" cellspacing="0" style="max-width:767px;border-radius:10px;" width="100%" class="wrapperBody">
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
										<td align="center" valign="top" style="padding-bottom: 10px;padding-top: 30px;" class="description">
                                        
                                        	<!-- Description Text// -->
											<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:left; padding:0;  padding-bottom:10px; margin:0">
												Buyer match ticket <a href="#">#<?=$ticket_id?></a>
											</p>
                                            
											<!-- Description Text// -->
											<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:left; padding:0; padding-bottom:10px; margin:0">
												Dear <b><?=$prop_data["user_name"]?></b>,
											</p>
                                            
                                            <!-- Description Text// -->
											<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:left; padding:0;  padding-bottom:10px; margin:0">
												There has been an interest for cooperation from <b><?=$agent_details["fname"]." ".$agent_details["lname"]?></b> for your property <a class="text" href="<?=$property_url?>" target="_blank" style="text-decoration:none;"><?=$prop_data["title"]?></a>.

											</p>
										</td>
									</tr>
                                    
                                   
								</tbody></table>
                                
                                
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
									<tbody><tr>
										<td align="center" valign="top" style="padding-bottom: 0px;padding-top: 0px;" class="description">
                                        
                                            <a class="text" href="<?=$property_url?>" target="_blank" style="text-decoration:none; display:block;">
											<img src="<?=$prop_data['prop_img']?>">
                                            
                                            </a>
                                            
                                             <!-- Description Text// -->
											<p class="text" style="color:#f00005; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:600; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:left; padding:0; padding-top:10px; margin:0">
												#<?=$prop_data['prop_reference']?>
											</p>
                                            
                                            <!-- Description Text// -->
											<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:left; padding:0; padding-top:0px; margin:0">
												<?=$prop_data['title']?>
											</p>
                                            
                                            <!-- Description Text// -->
											<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:left; padding:0; padding-bottom:0px; margin:0">
												<?=$prop_data['currency']." ".number_format($prop_data['price'])?>
											</p>
                                            
                                            <a class="text" href="<?=$property_url?>" target="_blank" style="text-decoration:underline; display:block;">
                                                <p class="text" style="color:#000FBF; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:left; padding:0; padding-bottom:20px; margin:0">
                                                Visit Property
                                                </p>
                                            </a>
                                            
										</td>
									</tr>
                                    
                                   
								</tbody></table>
                                
                                
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="background:#f3f5fa;padding-left:10px;padding-right:10px;padding-top:15px;">
									<tbody>
                                    
                                    
                                     <tr>
										<td align="center" valign="top" style="padding-left: 0px;padding-right: 0px;padding-bottom:10px;" class="description">
											
                                            <!-- Description Text// -->
											<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:15px; font-weight:700; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:left; padding:0; margin:0; text-decoration:underline;">
												Commission terms:
											</p>
                                        </td>
                                        
                                    </tr>
                                    
                               </tbody></table>
                                    
                               
                                    
                                   
                                
                                <?php if($comission_selected_option==1){ ?>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="background:#f3f5fa;padding-left:10px;padding-right:10px;padding-top:0px;">
									<tbody>
                                    <tr>
										<td align="center" valign="top" style="padding-bottom: 20px;padding-top: 10px;" class="description">
											<!-- Description Text// -->
											<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:justify; padding:0; margin:0">
												
                                                <b><?=$agent_details["fname"]." ".$agent_details["lname"]?></b> <u>will receive commission from Buyer</u>, and you <b><?=$prop_data["user_name"]?></b> <u>will receive commission from Seller</u>.
											</p>
                                            
                                            
										</td>
									</tr>
                                    
                                   
								</tbody></table>
                                <?php }  
								
								elseif($comission_selected_option==2){ ?>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="background:#f3f5fa;padding-left:10px;padding-right:10px;padding-top:0px;">
									<tbody>
                                    <tr>
										<td align="center" valign="top" style="padding-bottom: 20px;padding-top: 10px;" class="description">
											<!-- Description Text// -->
											<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:justify; padding:0; margin:0">
												
                                                
                                                <b><?=$agent_details["fname"]." ".$agent_details["lname"]?></b> and <b><?=$prop_data["user_name"]?></b> <u>will split the commission of <?=$commission_percentage?>%</u>.
                                                
											</p>
                                            
                                            
										</td>
									</tr>
                                    
                                   
								</tbody></table>
                                <?php } ?>
                                
                               
                               
                                <?php if($message){ ?>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="background:#f3f5fa;padding-left:10px;padding-right:10px;padding-top:0px;">
									<tbody>
                                    <tr>
										<td align="center" valign="top" style="padding-bottom: 20px;padding-top: 0px;" class="description">
											<!-- Description Text// -->
											<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:justify; padding:0; margin:0">
												<span style="font-weight:600;"><b>Message:</b></span> <?=$message?>
											</p>
                                            
                                            
										</td>
									</tr>
                                    
                                   
								</tbody></table>
                                <?php } ?>
                                
                                
                                
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
									<tbody><tr>
										<td align="center" valign="top" style="padding-top:30px;padding-bottom:0px;">

											<!-- Button Table // -->
											<table align="center" border="0" cellpadding="0" cellspacing="0">
												<tbody><tr>
													<td align="center" class="ctaButton" style="border: 2px solid #09A707;background: #09A707;padding: 12px 25px;">
														<!-- Button Link // -->
														<a class="text" href="<?=$approved_req_url?>" style="color:#fff; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:14px; font-weight:600; font-style:normal; line-height:21px; text-decoration:none; display:block; width:250px;">
															Approve
														</a>
													</td>
                                                    
                                                    <td align="center" class="ctaButton" style="padding:20px;"></td>
                                                    
                                                    <td align="center" class="ctaButton" style="border: 2px solid #f00005;background: #f00005;padding: 12px 25px;">
														<!-- Button Link // -->
														<a class="text" href="<?=$rejected_req_url?>" style="color:#fff; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:14px; font-weight:600; font-style:normal; line-height:21px; text-decoration:none; display:block; width:250px;">
															Decline
														</a>
													</td>
												</tr>
											</tbody></table>

										</td>
									</tr>
								</tbody></table>
                                
                                
                                
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
									<tbody>
                                    
                                    <tr>
										<td align="center" valign="top" style="padding-bottom: 5px;padding-top: 30px;" class="description">
											<!-- Description Text// -->
											<p class="text" style="color:#000; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:600; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:center; padding:0; margin:0">
												Below is the details of the <?=$agent_details["fname"]." ".$agent_details["lname"]?>
											</p>
                                           
										</td>
									</tr>
                                    
                                    <tr>
                                        <td height="0" style="font-size:1px;line-height:1px;">&nbsp;</td>
                                    </tr>
                                    
                                    
                                   
								</tbody></table>
                                
                                
                                
                                 <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
									<tbody><tr>
										<td align="center" valign="top" style="padding-top:30px;padding-bottom:20px;">

											<!-- Button Table // -->
											<table align="center" border="0" cellpadding="0" cellspacing="0">
												<tbody><tr>
													<td align="center">
														<!-- Button Link // -->
														<a class="text" href="<?=$agent_url?>" target="_blank" style="text-decoration:none; display:block; width:100px; height:100px;">
															<img src="<?=$agent_details['profile_pic']?>" height="100">
														</a>
                                                        
                                                        <a class="text" href="<?=$agent_url?>" target="_blank" style="color:#000; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:14px; font-weight:600; font-style:normal; line-height:21px; text-decoration:none; display:block;">
															<b><?=$agent_details['fname']." ".$agent_details['lname']?></b>
														</a>
                                                        
													</td>
												</tr>
											</tbody></table>

										</td>
									</tr>
								</tbody></table>
                                
                                 <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
									<tbody><tr>
										<td align="center" valign="top" style="padding-top:10px;padding-bottom:20px;">

											<!-- Button Table // -->
											<table align="center" border="0" cellpadding="0" cellspacing="0">
												<tbody><tr>
													<td align="center" class="ctaButton" style="border: 2px solid #f00005;background: #fff;padding: 12px 35px;">
														<!-- Button Link // -->
														<a class="text" href="tel:<?="+".$agent_details['mobile_code'].$agent_details['mobile']?>" target="_blank" style="color:#000; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:14px; font-weight:600; font-style:normal; line-height:21px; text-decoration:none; display:block; width:250px;">
															<?="+".$agent_details['mobile_code'].$agent_details['mobile']?>
														</a>
													</td>
												</tr>
											</tbody></table>

										</td>
									</tr>
								</tbody></table>
                              
                              
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
									<tbody><tr>
										<td align="center" valign="top" style="padding-top:10px;padding-bottom:0px;">

											<!-- Button Table // -->
											<table align="center" border="0" cellpadding="0" cellspacing="0">
												<tbody><tr>
													<td align="center" class="ctaButton" style="border: 2px solid #f00005;background: #fff;padding: 12px 35px;">
														<!-- Button Link // -->
														<a class="text" href="mailto:<?=$agent_details['email']?>" style="color:#000; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:14px; font-weight:600; font-style:normal; line-height:21px; text-decoration:none; display:block; width:250px;">
															Click to Email
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
											<p class="text" style="color:#666666; font-family:&#39;Open Sans&#39;, Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:center; padding:0; padding-bottom:20px; margin:0;">
												<b>Note:</b> In case of no response in the next 48 hours from now, this request will automatically decline.
											</p>
                                            
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
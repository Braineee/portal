<?php
// check if payment status exists
if(!isset($_SESSION['school_fees_payment_status'])){
  redirect('?pg=home');
  die();
}

// check if the payment status is valid
if(
  $_SESSION['school_fees_payment_status'] == 'NOT_DEFINED' ||
  $_SESSION['school_fees_payment_status'] == 'PAYMENT_NOT_DEFINED' ||
  $_SESSION['school_fees_payment_status'] == 'NOT_SET'
){
  if($_SESSION['school_fees_payment_status'] == 'NOT_DEFINED'){
    Session::flash('error', 'Err: Could not get school fees details.');
    redirect('?pg=home');
    die();
  }
  if($_SESSION['school_fees_payment_status'] == 'PAYMENT_NOT_DEFINED'){
    Session::flash('error', 'Err: Could not get school fees payment status.');
    redirect('?pg=home');
    die();
  }
  if($_SESSION['school_fees_payment_status'] == 'NOT_SET'){
    Session::flash('info', 'Your school fees has not been set please check back later.');
    redirect('?pg=home');
    die();
  }
  redirect('?pg=home');
  die();
}

// check if the amount isset
if(!isset($_SESSION['amount_to_pay'])){
  redirect('?pg=home');
  die();
}


?>
<head>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <style type="text/css">
    body{
		background-image:url(assets/img/yblogo.jpg);
        font-family: "Source Sans Pro", sans-serif;
    }
        /*table, th, td {
            border: 1px solid #060;
        }*/
        .bio{
            color:#006600;
            font-size: 15px;
            padding: 10px 10px;
        }
        blockquote.emph {
            padding: 10px 10px;
            margin: 0px 0px 0px;
            font-size: 17.5px;
            color:#006600;
            border-left:10px solid #006600;
            border-left-color: #006600;
        }
    </style>
</head>
<body  oncontextmenu="return false" onkeydown="return false;" class="panel-body"  id="printDiv">
<div class="vertical-align-wrap">
    <div class="vertical-align-middle">
        <div class="content">
            <div>

             <div class="print"   style="margin-left:">

                <div class="panel-body">
                <table align="center">
						<div class="panel-body">
							<div class="logo text-center"><img  style="margin-left:50px; margin-bottom:30px" src="assets/img/logo3.png" alt="Yaba_tech Logo"></div>
							<div class="col-md-12">
								<!-- PANEL HEADLINE -->
								<div class="panel panel-headline">
									<div class="panel-body">
										<blockquote class="emph"><b>PAYMENT ADVICE SLIP</b></blockquote>
										<p>
											<table style="margin-left:40px;" align="center">
												<tr>
													<td>
														<table>
															<tr>
																<td><li class="bio">APPLICATION. NO.:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->Appnum; ?></b></li></td>
															<tr>
															<tr>
																<td><li class="bio">NAME:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->Surname.' '.$_SESSION['applicant_details']->Firstname.' '.$_SESSION['applicant_details']->Othername;?></b></li></td>
															<tr>
															<tr>
																<td><li class="bio">SCHOOL/FACULTY:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->SchoolName; ?></b></li></td>
															<tr>
															<tr>
																<td><li class="bio">DEPARTMENT:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->PNName;?></b></li></td>
															<tr>
															<tr>
																<td><li class="bio">PROGRAMME:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->program;?></b></li></td>
															<tr>
															<tr>
																<td><li class="bio">SESSION:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->EntrySession;?></b></li></td>
															<tr>
															<tr>
																<td><li class="bio">FEE AMOUNT:</td>
																<td><b class="bio">&#8358;<?php echo number_format($_SESSION['actual_amount']); ?></b></li></td>
															</tr>
														</table>
													</td>
													<!--picturre colum-->
													<td valign="top">
														<div style="margin-left:220px;" class="col-md-4 pull-right">
															<!-- PANEL HEADLINE -->
															<div>
																<div>
																	<img src="<?= $_SESSION['applicant_picture'] ?>" alt="<?php echo $_SESSION['applicant_details']->Appnum; ?>" width="150px" height="150px">
																</div>
															</div>
															<!-- END PANEL HEADLINE -->
														</div>
													</td>
												</tr>
											</table>
										</p>
										<br>

										</p>
										<br>
									</div>
								</div>
								<!-- END PANEL HEADLINE -->
							</div>
                        </div>
                        <table style="width:800px; border: 0px; margin-top:100px; color:#060;" align="center">
                            <tr>
                                <td align="center" style="border: 0px;" class="col-md-4">
                                    <span><small>DEVELOPED BY: CENTER FOR INFORMATION AND TECHNOLOGY MANAGEMENT, (CITM) YABA COLLEGE OF TECHNOLOGY</small></span>
                                </td>

                            </tr>
                            <tr>
                                <td align="center" style="border: 0px;" class="col-md-4">
                                    <span><small>DATE PRINTED : <?php echo date('Y-m-d / H:i:s'); ?></small></span><!---LOCAL MACHINE-->
                                </td>
                            </tr>
                        </table>
                        <table style="width:800px; border: 0px; margin-top:20px; color:#060;" align="center">
                            <tr>
                                <td align="center" style="border: 0px;" class="col-md-4">

                                </td>
                                <td align="center"style="border: 0px;" class="col-md-4">
                                    <button onclick="window.print(this)">PRINT</button>
                                    <button onclick="window.history.back()">GO BACK TO PORTAL</button>
                                </td>
                                <td align="right" style="border: 0px;" class="col-md-4">

                                </td>
                            </tr>
                        </table>
						<div class="panel-body">
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
<input type="hidden" name="sess" value="2">
<script src="<?php echo BASE_URL; ?>ajax/get_std_data.js"></script>

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
<body oncontextmenu="return false" onkeydown="return false;" class="panel-body"  id="printDiv" >
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
										<blockquote class="emph"><b>BIO DATA</b></blockquote>
										<p>
											<table style="margin-left:40px;" align="center">
												<tr>
													<td>
														<table>
															<tr>
																<td><li class="bio">FULL NAME:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->Surname.' '.$_SESSION['applicant_details']->Firstname.' '.$_SESSION['applicant_details']->Othername;?></b></li></td>

															</tr>
															<tr>
																<td><li class="bio">APPLICATION. NO.:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->Appnum; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">PROGRAMME TYPE:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->PTName; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">SESSION:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->EntrySession; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">SCHOOL:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->SchoolName; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">DEPARTMENT:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->PNName; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">PROGRAMME:</td>
															<td><b class="bio"><?php echo $_SESSION['applicant_details']->program; ?></b></li></td>
															<tr>
																<td><li class="bio">ENTRY YEAR:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->EntrySession; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">SEX:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->Sex; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">DATE OF BIRTH:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->DOB; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">EMAIL:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->Email; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">PHONE:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->Phone; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">RESIDENTIAL ADDRESS:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->Address; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">PLACE OF BIRTH:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->POBName; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">STATE OF ORIGIN:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->StateName; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">LOCAL GOV. (LGA):</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->LGAName; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">NEXT OF KIN(NOK):</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->NOK; ?></b></li></td>
															</tr>
															<tr>
																<td><li class="bio">NEXT OF KIN(NOK) PHONE NO.:</td>
																<td><b class="bio"><?php echo $_SESSION['applicant_details']->NOKPhone; ?></b></li></td>
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
										<blockquote class="emph"><b>PARENT / GUARDIAN</b></blockquote>
										<p>
											<table style="margin-left:40px;">
											<tr>
												<td>
													<table>
														<tr>
															<td><li class="bio">PARENT / GUARDIAN NAME:</td>
															<td><b class="bio"><?php echo $_SESSION['applicant_details']->PGName; ?></b></li></td>
														</tr>
														<tr>
															<td><li class="bio">PARENT / GUARDIAN ADDRESS:</td>
															<td><b class="bio"><?php echo $_SESSION['applicant_details']->PGAddress; ?></b></li></td>
														</tr>
														<tr>
															<td><li class="bio">PARENT / GUARDIAN PHONE:</td>
															<td><b class="bio"><?php echo $_SESSION['applicant_details']->PGPhone; ?></b></li></td>
														</tr>
													</table>
												</td>

											</tr>

											</table>
										</p>
										<p>
											<!--div class="col-md-12">
												<table class="col-md-12">
													<tr>
														<td class="col-md-4"> </td>
														<td style="text-align:center" class="col-md-4">

															<form method="POST" action="?pg=verify_course">
															<button type="submit" id="send" name=" send" onclick="window.print()" class="btn btn-primary btn-block">PRINT</button>
															</form>
														</td>
														<td class="col-md-4"> </td>
													</tr>
												</table>
											</div-->
										</p>
										<br>
									</div>
								</div>
								<!-- END PANEL HEADLINE -->
							</div>
                        </div>
                        <table style="width:800px; border: 0px; margin-top:30px; color:#060;" align="center">
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

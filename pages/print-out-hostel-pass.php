<?php
 // do this if student is partime
if ($_SESSION['is_part_time'] == true) :
  Session::flash('info', 'Part time students are not eligible to apply for hostel.');
  redirect('?pg=home');
  die();
endif;

// check if payment status exists
if (!isset($_SESSION['school_fees_payment_status'])) {
    Session::flash('error', 'Sorry, we could not get your school fees payment status, kindly logout and login again.');
    redirect('?pg=home');
    die();
}

// check if the student payment is complete
if ($_SESSION['school_fees_payment_status'] != 'PAID_COMPLETE') {
    Session::flash('info', 'You are not eligible to apply for hostel, you have to complete your school fees payment first.');
    redirect('?pg=home');
    die();
}

// check if hostel status exits
if (!isset($_SESSION['hostel_status'])) :
  Session::flash('info', 'Sorry, we could not get your hostel application status, kindly logout and login again.');
  redirect('?pg=home');
  die();
endif;

// Check if the studen has appied already
if ($_SESSION['hostel_status'] != "PAID COMPLETE") {
    Session::flash('info', 'You have not paid for any hostel space yet');
    redirect('?pg=hostel');
    die();
}

?>

<!---body oncontextmenu="return false" onkeydown="return false;" -->

<head>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet"> 
    <style type="text/css">
        @page {
            /* dimensions for the whole page */
            size: A5;
            
            margin: 0;
        }

        html {
            /* off-white, so body edge is visible in browser */
            background: #eee;
        }

        body {
            /* A5 dimensions */
            height: 210mm;
            width: 160.5mm;
            /*ackground-color:#ff0;*/
            background-image:url(assets/img/yblogo.jpg);
            margin: 0;
            margin-left:30%;
            font-size:12px;
            font-family: "Source Sans Pro", sans-serif;
        }

        .rotate4{ /*upside down*/
            -webkit-transform:rotate(180deg);
            -moz-transform:rotate(180deg);
            -o-transform:rotate(180deg);
            -ms-transform:rotate(180deg);
            transform:rotate(180deg);
        }
        
        table{
            font-size:12px;
            color:#060;
        }
        /* fill half the height with each face */
        .face {
            height: 50%;
            width: 100%;
            position: relative;
        }

        /* the back face */
        .face-back {
            background: #f6f6f6;
        }

        /* the front face */
        .face-front {
            background-image:url(assets/img/yblogo.jpg);
        }

        @media print {
			.btn{
				display: none;
			}
            body{
                margin-left:15%;
            }
		}
    </style> 

    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.qrcode.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/JsBarcode.all.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.watermark.min.js"></script>

</head>
<body  oncontextmenu="return false" align="center" onkeydown="return false;"  id="printDiv">
<div class="vertical-align-wrap">
    <div class="vertical-align-middle">
        <div class="content" >
            <div>
             <div class="print"   style="">
               
                <div class="panel-body">
                    <div class="face face-front">
                        <table style="margin-bottom:10px;">
                            <tr>
                                <td align="center">
                                    <img src="assets/img/logo3.png" width="100%" alt="Yaba_tech Logo">											
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size:17px; background-color:#060; color:#fff;">
                                    <b>...HOSTEL PASS...</b>										
                                </td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td>
                                    <table style="border: 0px;">
                                      <tr>
                                          <td style="border: 0px; padding-right:20px;"><li class="bio_print">NAME OF STUDENT:</td>
                                          <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->surname." ".$_SESSION['student_details']->firstname." ".$_SESSION['student_details']->othername;?></b></li></td>													
                                      </tr>
                                      <tr>
                                          <td style="border: 0px; padding-right:20px; "><li class="bio_print">MATRIC NO:</td>
                                          <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->matricnum;?></b></li></td>													
                                      </tr>
                                      <tr>
                                          <td style="border: 0px; padding-right:20px;"><li class="bio_print">SEX:</td>
                                          <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->sex;?></b></li></td>													
                                      </tr>
                                      <tr>
                                          <td style="border: 0px; padding-right:20px;"><li class="bio_print">LEVEL:</td>
                                          <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->Real_Level;?></b></li></td>													
                                      </tr>
                                      <tr>
                                          <td style="border: 0px; padding-right:20px;"><li class="bio_print">SCHOOL:&ensp;</td>
                                          <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->School;?></b></li></td>													
                                      </tr>
                                      <tr>
                                          <td style="border: 0px; padding-right:20px;"><li class="bio_print">DEPARTMENT:</td>
                                          <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->department;?></b></li></td>													
                                      </tr>
                                      <tr>
                                          <td style="border: 0px; padding-right:20px;"><li class="bio_print">PROGRAMME:</td>
                                          <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->programme;?></b></li></td>	
                                      </tr>
                                      <tr>
                                          <td style="border: 0px; padding-right:20px;"><li class="bio_print">HOSTEL NAME:</td>
                                          <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['hostel_allocation_details']->Hostelname; ?></b></li></td>													
                                      </tr>
                                    </table>
                                </td>
                                <td align="center">
                                <img src="<?= $_SESSION['student_passport'] ?>">
                                <br>
                                    <span style="font-size:25px;"><b><?php echo $_SESSION['hostel_allocation_details']->Hostelname; ?></b></span><br>
                                    <span style="font-size:15px;"><b>ROOM NO.:</b></span><br>
                                    <span style="font-size:20px;"><b><?php echo $_SESSION['hostel_allocation_details']->Room;?></b></span>
                                </td>
                            <tr>
                        </table>
                        <table style="border: 0px; margin-top:50px; background-color:#060; color:#fff;" width="100%" align="center">
                            <tr align="center">
                                <td align="center" style="border: 0px;" class="col-md-4">   
                                    <span><small><b>DEVELOPED BY: CENTER FOR INFORMATION TECHNOLOGY AND MANAGEMENT, (CITM) YABA COLLEGE OF TECHNOLOGY</b></small></span>
                                </td>
                                
                            </tr>
                            <tr>
                                <td align="center" style="border: 0px;" class="col-md-4">   
                                    <span><small>DATE PRINTED : <?php echo date('Y-m-d / H:i:s'); ?></small></span><!---LOCAL MACHINE-->
                                </td>
                            </tr>
                        </table>
                    </div>


                    <div class="rotate4">
                        <table style="padding:10px; margin-top:50px;">
                            <tr>
                                <td>
                                    <b style="font-size:16px;">This card remains a property of the College and must be surrendered on request to the Authority of the College.</b><br>
                                    <table style="width:100%; border: 0px; margin-bottom:5px; color:#060;" align="center">
                                        <tr>
                                            <td style="border: 0px; padding-top:10px;">
                                            
                                            </td>
                                            <td align="right" style="border: 0px; padding-top:50px;">
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="bottom" style="border: 0px; padding-top:10px; ">
                                                <img src="<?php echo BASE_URL;?>assets/img/signatures/Directors/DSA.jpg" width="40%" alt="Dean's Signature">
                                            </td>
                                            <td valign="bottom" align="right" style="border: 0px; padding-top:10px; ">
                                                <img src="<?php echo BASE_URL;?>assets/img/signatures/Directors/HODWF.jpg" width="60%" alt="Hod welfare Signature">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 0px;">
                                                _____________________
                                            </td>
                                            <td align="right" style="border: 0px;">
                                                _________________________
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 0px;">
                                                <b>DEAN STUDENT AFFAIR</b>
                                            </td>
                                            <td align="right" style="border: 0px;">
                                                <b>HOD, STUDENT WELFARE</b>
                                            </td>
                                        </tr>
                                        <?php
                                            
                                        ?>
                                        <tr>
                                            <td valign="bottom" style="border: 0px; padding-top:10px; ">
                                                <img src="<?php echo BASE_URL;?>assets/img/signatures/Directors/0.png" width="40%" alt="Director's Signature">
                                            </td>
                                            <td align="right" style="border: 0px; padding-top:10px;">
                                                <?php
                                                    $en_mat = tpyrcne($_SESSION['student_details']->matricnum, 'e');
                                                    $list = "";
                                                    $list .="Matric No: ".$_SESSION['student_details']->matricnum."\n";
                                                    $list .="Name: ".$_SESSION['student_details']->surname." ".$_SESSION['student_details']->firstname." ".$_SESSION['student_details']->othername."\n";
                                        
                                                    $list .="http://portal.yabatech.edu.ng/portalplus/?pg=verify_hostel_pass&id=".$en_mat;
                                                    $data = json_encode($list);
                                                ?>
                                                <script> 
                                                    generate_qr(<?php echo $data;?>);

                                                    function generate_qr(string){
                                                        jQuery(function(){
                                                            jQuery('#qr_code').qrcode({width: 80,height: 80,text: string});
                                                        });
                                                    }
                                                </script>
                                                <div id="qr_code">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 0px; padding:0px;">
                                                _____________________
                                            </td>
                                            <td align="right" style="border: 0px; padding:0px;">
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 0px;">
                                                <b>DIRECTOR - CITM</b>
                                            </td>
                                            <td align="right" style="border: 0px;">
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="center">
                                   
                                </td>
                            <tr>
                        </table>
                    </div>
                    
                   
                    
                    <table style="border: 0px; margin-top:20px; color:#060;" align="center" width=100%;>
                        <tr>
                            <td align="center"style="border: 0px;" class="col-md-4">
                                <button class="btn btn-default btn-block" id="print" onclick="window.print(this)">PRINT</button>
                                <!--button class="btn btn-default btn-block"  onclick="window.history.back()">GO BACK TO PORTAL</button-->
                            </td>
                        </tr>
                    </table>
                    
                
                </div>
            
                </div> 
            </div>
        </div>
    </div>
</div>

<script>
generate_watermark();
function generate_watermark(){
	$('.display').watermark({
		path: 'assets/img/log.png',
		margin: 0,
		gravity: 'sw',
		opacity: 0.3,
		outputWidth: 400
	});
}
</script>



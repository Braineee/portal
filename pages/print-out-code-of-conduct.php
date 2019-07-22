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
    body{
        font-family: "Source Sans Pro", sans-serif;
    }
        table, th, td {
            border: 1px solid #060;
        }
        #printDiv {
            background-image:url(assets/img/yblogo.jpg);
        
        }

        .bio_print{
            color:#006600;
            font-size: 14px;
            padding: 5px 5px;
        }
        blockquote.emph {
            padding: 10px 10px;
            margin: 0px 0px 0px;
            font-size: 17.5px;
            color:#006600;
            border-left:10px solid #006600;
            border-left-color: #006600;
        }
        .emph{
            color:#006600;
        }
        @media print {
			.btn{
				display: none;
			}
		}
    </style> 
</head>
<body  oncontextmenu="return false" onkeydown="return false;" class="panel-body"  id="printDiv">
<div class="vertical-align-wrap">
    <div class="vertical-align-middle">
        <div class="content" >
            <div>
             <div class="print"   style="">
               
                <div class="panel-body">
                    <table style="width:800px; border: 0px;" align="center" id="printDiv">
                        <tr>
                            <td align="center" style="border: 0px; padding-left:50px;">
                            
                                    <img  src="assets/img/logo3.png" alt="Yaba_tech Logo">
                                
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="border: 0px; padding-left:50px;">
                                <h2 align="center"><b class="emph" >CODE OF CONDUCT</b></h2>
                           </td> 
                        </tr>
                    </table>
                    <table style="width:800px; border: 0px; margin-bottom:10px;" align="center" >
                       
                        <tr>
                            <td style="border: 0px;">
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
                            <td align="right" style="border: 0px;">
                            <img src="<?= $_SESSION['student_passport'] ?>">
                            </td>
                        </tr>
                    </table>
                    <br>
                    <br>  
                    <table style="width:800px; border: 0px; margin-bottom:30px;" align="center">
                        <tr>
                            <td style="border: 0px; padding-right:20px;">   
                                <blockquote class="emph"><b>CODE OF CONDUCT (INFORMATION ATTESTATION)</b></blockquote>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0px; padding-right:20px;"><li class="bio_print">
                                It is a punishable offence for anybody in Yaba College of Technology to <b>establish or join Cult or Secret Society or use any sign, password, code 
                                ring, brooch, uniform, oath, rites, symbols or anything related to or associated with such society</b>.
                            </li>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0px; padding-right:20px;"><li class="bio_print">
                               You are seriously advised to desist from engaging in activities inimical to peace on Yabatech Campus, National Security, Public Order, Public Morality and Public Health.
                            </li>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0px; padding-right:20px;"><li class="bio_print">
                                You must not inflict any injury or cause the death of another student/person. You would be tried accordingly, under the Federal Goverment Criminal Codes.
                            </li>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0px; padding-right:20px;"><li class="bio_print">
                                I swear an oath never to carry on my person, in a bag, in my room or anywhere in Yabatech campus any of the following, <b>Knife, Axe, Cutlass, Firearms (including accessories)
                                which are dangerous to my fellow human beings and myself</b>.
                            </li>
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 0px; padding-right:20px; padding-top:10px;"><li class="bio_print">
                                I ---------------------------------------------------------------------------------------- having read and understood the above information of the codes of conduct, do solemnly swear to abide by its contents.
                            </li></td>
                        </tr> 
                        
                        <tr>
                            <td style="border: 0px; padding-right:20px; padding-top:30px;" class="bio_print"  align="center">
                                --------------------------------------------------------<br>
                                SIGNATURE & DATE
                            </td>
                        <tr>
                    </table>
                    
                   
                    <table style="width:800px; border: 0px; margin-top:50px; color:#060;" align="center">
                        <tr>
                            <td align="center" style="border: 0px;" class="col-md-4">   
                                <span><small>DEVELOPED BY: CENTER FOR INFORMATION TECHNOLOGY AND MANAGEMENT, (CITM) YABA COLLEGE OF TECHNOLOGY</small></span>
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
                                <button class="btn btn-default btn-block" id="print" onclick="window.print(this)">PRINT</button>
                                <!--button class="btn btn-default btn-block"  onclick="window.history.back()">GO BACK TO PORTAL</button-->
                            </td>
                            <td align="right" style="border: 0px;" class="col-md-4">
                                
                            </td>
                        </tr>
                    </table>
                    
                
                </div>
            
                </div> 
            </div>
        </div>
    </div>
</div>

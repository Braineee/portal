<?php
    include "controller/GetRegistrationDetails.php";
?>
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
    </style> 
</head>
<!--body oncontextmenu="return false" onkeydown="return false;" class="panel-body"  id="printDiv"-->
<body oncontextmenu="return false" onkeydown="return false;" class="panel-body"  id="printDiv">
<div class="vertical-align-wrap">
    <div class="vertical-align-middle">
        <div class="content" >
            <div>
             <div class="print"   style="">
               
                <div class="panel-body">
                    <table style="width:800px; border: 0px; margin-bottom:30px;" align="center" id="printDiv">
                        <tr>
                            <td align="center" style="border: 0px; padding-left:50px;">
                            
                                    <img  src="assets/img/logo3.png" alt="Yaba_tech Logo">
                                
                            </td>
                        </tr>
                    </table>
                    
                    <table style="width:800px; border: 0px; margin-bottom:30px;" align="center" >
                        <tr>
                            <td style="border: 0px;">
                                <table style="border: 0px;">
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; padding-bottom:20px;"><blockquote class="emph"><b>COURSE FORM</b></blockquote></td>
                                        <td style="border: 0px;"><b class="bio_print"></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px;"><li class="bio_print">MATRIC. NO.:</td>
                                        <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->matricnum;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio_print">NAME:</td>
                                        <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->surname." ".$_SESSION['student_details']->firstname." ".$_SESSION['student_details']->othername;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px;"><li class="bio_print">PROGRAMME TYPE:</td>
                                        <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->programme;?></b></li></td>													
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
                                        <td style="border: 0px; padding-right:20px;"><li class="bio_print">SESSION:&ensp;</td>
                                        
                                        <td style="border: 0px;"><b class="bio_print"><?php echo $_list_of_registrations_details[0]->Session;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px;"><li class="bio_print">SEMESTER:</td>
                                       
                                        <td style="border: 0px;"><b class="bio_print"><?php echo $_list_of_registrations_details[0]->Semester;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px;"><li class="bio_print">LEVEL:</td>
                                        <td style="border: 0px;"><b class="bio_print"><?php echo $_list_of_registrations_details[0]->Level;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px;"><li class="bio_print">DATE REGISTERED:</td>
                                        <td style="border: 0px;"><b class="bio_print"><?php echo $_list_of_registrations_details[0]->DateSubmitted2;?></b></li></td>													
                                    </tr>
                                </table>
                            </td>
                            <td align="right" style="border: 0px;">
                            <img src="<?= $_SESSION['student_passport'] ?>" alt="<?= $_SESSION['student_details']->matricnum ?>">
                            </td>
                        </tr>
                    </table>
                    <table style="width:800px; border: 1px solid #060; margin-top:40px; color:#060" align="center">
                        <tr>
                            <td align="center" ><b>COURSE CODE</b></td>
                            <td align="center" ><b>COURSE TITLE</b></td>
                            <td align="center" ><b>COURSE STATUS</b></td>
                            <td align="center" ><b>UNIT</b></td>
                        </tr>
                        <?php
                            // ionitialize the total sum of the units
                            $_total_units = 0;
                            foreach ($_list_of_registrations_details as $details) {
                                echo "
                                    <tr>
                                        <td class='bio' align='center'>{$details->CourseCode}</td>
                                        <td class='bio' style='padding-left:10px;'>{$details->CourseTitle}</td>
                                        <td class='bio' align='center'>{$details->Tstatus}</td>
                                        <td class='bio' align='center'>{$details->CourseUnit}</td>
                                    <tr>
                                ";
                                $_total_units += $details->CourseUnit;
                            }
                        ?>
                    </table>
                    <table style="width:800px; border: 0px; margin-top:50px;" align="center">
                        <tr>
                            <td align="center" style="border: 0px; color:#060">
                            <b>TOTAL UNITS:<?= $_total_units ?></b>
                            </td>
                        </tr>
                    </table>
                    <table style="width:800px; border: 0px; margin-top:50px; color:#060;" align="center">
                        <tr>
                            <td style="border: 0px;">
                                _____________________
                            </td>
                            <td align="right" style="border: 0px;">
                                _____________________________
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0px;">
                                <b>STUDENT'S SIGNATURE</b>
                            </td>
                            <td align="right" style="border: 0px;">
                                <b>COURSE ADVISER'S SIGNATURE</b>
                            </td>
                        </tr>
                        <?php
                            
                        ?>
                        <tr>
                            <td style="border: 0px; padding-top:50px;">
                                <img src="<?php echo BASE_URL;?>assets/img/signatures/Directors/<?php echo $_SESSION['student_details']->SchoolID; ?>.gif" width="40%" alt="Dean's Signature">
                            </td>
                            <td align="right" style="border: 0px; padding-top:50px;">
                                <img src="<?php echo BASE_URL;?>assets/img/signatures/officer_images/<?php echo $_SESSION['student_details']->SchoolID; ?>.jpg"  width="40%" alt="School Officer's Signature">
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0px; padding:0px;">
                                _____________________
                            </td>
                            <td align="right" style="border: 0px; padding:0px;">
                                _____________________________
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0px;">
                                <b>DEAN'S SIGNATURE</b>
                            </td>
                            <td align="right" style="border: 0px;">
                                <b>SCHOOL OFFICER'S SIGNATURE</b>
                            </td>
                        </tr>
                    </table>
                    <tr>
                    <!---hr-->
                    <table style="width:800px; border: 0px; margin-top:50px; color:#060;" align="center">
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
                                <button class="btn btn-default btn-block" id="print" onclick="window.print(this)">PRINT</button>
                                <button class="btn btn-default btn-block"  onclick="window.history.back()">GO BACK TO PORTAL</button>
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
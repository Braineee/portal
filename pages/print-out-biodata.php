<?php
    include_once("controller/GetPaymentHistroy.php");
?>

<head>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet"> 
    <style type="text/css">
    body{
        font-family: "Source Sans Pro", sans-serif;
        background-image:url(assets/img/yblogo.jpg);
    }
        table, th, td {
            border: 1px solid #060;
        }
        #printDiv {
            background-image:url(assets/img/yblogo.jpg);
        
        }
        .bio{
            color:#006600;
            font-size: 15px;
            padding: 10px 10px;
        }
        .bio_print{
            color:#006600;
            font-size: 12px;
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
<body  oncontextmenu="return false" onkeydown="return false;" class="panel-body"  id="printDiv">
<div class="vertical-align-wrap">
    <div class="vertical-align-middle">
        <div class="content">
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
                    <table style="width:800px; border: 0px; margin-bottom:30px;" align="center">
                        <tr>
                            <td style="border: 0px;">
                                <table style="border: 0px;">
                                    <tr>
                                        <blockquote class="emph"><b>BIODATA:</b></blockquote>
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px;"><li class="bio">NAME:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->surname." ".$_SESSION['student_details']->firstname." ".$_SESSION['student_details']->othername;?></b></li></td>									
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">MATRIC. NO.:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->matricnum;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">PROGRAMME TYPE:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->programme_type;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">SESSION:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->acadsession;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">SCHOOL:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->School;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">DEPARTMENT:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->department;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">PROGRAMME:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->programme;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">LEVEL:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->Real_Level;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">ENTRY YEAR:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->entry_year;?></b></li></td>												
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">SEX:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->sex;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">DATE OF BIRTH:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->dob."/".$_SESSION['student_details']->mob."/".$_SESSION['student_details']->yob;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">EMAIL:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->CurrentEmail;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">PHONE:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->CurrentPhoneNo;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">RESIDENTIAL ADDRESS:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->address;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">PLACE OF BIRTH:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->place_of_birth;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">STATE OF ORIGIN:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->state_of_origin;?></b></li></td>													
                                    </tr>
                                </table>
                                <br>
                                <table style="border: 0px;">
                                    <tr>
                                        <blockquote class="emph"><b>PARENT / GUARDIAN</b></blockquote>
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">PARENT / GUARDIAN NAME:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->parent_guardian;?></b></li></td>											
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">PARENT / GUARDIAN ADDRESS:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->p_g_address;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px; "><li class="bio">PARENT / GUARDIAN PHONE:</td>
                                        <td style="border: 0px;"><b class="bio"><?php echo $_SESSION['student_details']->p_g_phone;?></b></li></td>													
                                    </tr>
                                </table>
                            </td>
                            <td align="right" valign="top" style="border: 0px; padding-top:60px;">
                                <img src="<?= $_SESSION['student_passport'] ?>" alt="<?= $_SESSION['student_details']->matricnum ?>">
                            </td>
                        </tr>
                    </table>
                    <table style="width:800px; border: 0px; margin-top:50px; color:#060;" align="center">
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

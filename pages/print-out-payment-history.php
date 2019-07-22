<?php
    include_once("controller/GetPaymentHistroy.php");
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
                                        <blockquote class="emph"><b>PAYMENT HISTORY:</b></blockquote>
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px;"><li class="bio_print">NAME:</td>
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
                                        <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->department; ?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px;"><li class="bio_print">PROGRAMME:</td>
                                        <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->programme ?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px;"><li class="bio_print">ENTRY SESSION:</td>
                                        <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['student_details']->entry_year;?></b></li></td>													
                                    </tr>
                                    <tr>
                                        <td style="border: 0px; padding-right:20px;"><li class="bio_print">CURRENT SESSION:</td>
                                        <td style="border: 0px;"><b class="bio_print"><?php echo $_SESSION['current_academic_session']->Session;?></b></li></td>													
                                    </tr>
                                </table>
                            </td>
                            <td align="right" style="border: 0px;">
                            <img src="<?= $_SESSION['student_passport'] ?>" alt="<?= $_SESSION['student_details']->matricnum ?>">
                            </td>
                        </tr>
                    </table>
                    
                    <table style="width:800px; border: 1px solid #060; margin-top:50px; color:#060" align="center">
                    
                        <tr>
                            <td align="center" ><b>S/No.</b></td>
                            <td align="center" ><b>FEE TYPE</b></td>
                            <td align="center" ><b>ACADEMIC SESSION</b></td>
                            <td align="center" ><b>VALUE</b></td>
                            <td align="center" ><b>DATE</b></td>
                            <td align="center" ><b>STATUS</b></td>
                        </tr>
                        <?php
                            $count = 1;
                            foreach ($history as $payment){
                                $price = number_format($payment->Amount);
                                echo"
                                    <tr>
                                        <td class='bio' align='center'>". $count ++ ."</td>
                                        <td class='bio' style='padding-left:10px;'>{$payment->PaymentName}</td>
                                        <td class='bio' align='center'>{$payment->Session}</td>  
                                        <td class='bio' align='center'>&#8358;{$price}</td>
                                        <td class='bio' align='center'>{$payment->DatePosted}</td>
                                        <td class='bio' align='center'>{$payment->TransactionStatus}</td>	
                                    </tr>
                                ";
                            }
                        ?>
                    </table>
                   
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

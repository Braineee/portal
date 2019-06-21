<!doctype html>
<html lang="en">
  <head>
    <?php
  		$token = $_SESSION['student_token'];
  	?>
    <meta name="csrf-token" content="<?= $_SESSION['student_token'] ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="applicant portal for newly admitted student">
    <meta name="author" content="CITM-yabatech">
    <title>Applicant Portal</title>

    <!-- Bootstrap core CSS -->
    <!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet"-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300|Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>assets/css/bootstrap.css" rel="stylesheet" >
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/css/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/fonts/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="<?= BASE_URL ?>assets/css/main.css" rel="stylesheet" >
    <link href="<?= BASE_URL ?>assets/css/login.css" rel="stylesheet" >



    <!-- Jquery -->
    <script type="text/javascript" src="<?= BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
  </head>

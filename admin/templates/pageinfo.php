<?php
session_start();
error_reporting(0);
include('../rsc/includes/config.php');

    ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <title>        <?php
    echo basename(__DIR__);
    ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  
  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,600,700" rel="stylesheet">
  
  <!-- Stylesheets -->
  
  <link href="../rsc/plugin-frameworks/bootstrap.css" rel="stylesheet">
  
  <link href="../rsc/fonts/ionicons.css" rel="stylesheet">
  
    
  <link href="../rsc/common/styles.css" rel="stylesheet">
</head>
<body>
  
<?php include'../rsc/includes/navbar.php';?>
  
  
  <section class="ptb-0">
    <div class="mb-30 brdr-ash-1 opacty-5"></div>
    <div class="container">
      <a class="mt-10" href="index.html"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-10 ion-chevron-right"></i></a>
         <?php
    echo basename(__DIR__);
    ?>
    </div><!-- container -->
  </section>
  
  
  <section>
    <div class="container">
      <h2 class="mb-50"><b>        <?php
    echo basename(__DIR__);
    ?></b></h2>
     <?php

$stmt = $con -> prepare('select PageTitle,Description from tblpages where PageName=?');
$pagetype=basename(__DIR__);
$stmt -> bind_param('s', $pagetype);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($PageTitle,$Description);
$stmt->fetch();
?> 
<?php echo $Description;?>
            
    </div><!-- container -->
  </section>
  
  
  
  <?php include'../rsc/includes/footer.php';?>

  <!-- SCIPTS -->
  
  <script src="../rsc/plugin-frameworks/jquery-3.2.1.min.js"></script>
  
  <script src="../rsc/plugin-frameworks/tether.min.js"></script>
  
  <script src="../rsc/plugin-frameworks/bootstrap.js"></script>
  
  <script src="../rsc/common/scripts.js"></script>
  
</body>
</html>
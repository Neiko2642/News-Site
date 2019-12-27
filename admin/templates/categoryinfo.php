<?php
session_start();
error_reporting(0);
include('../rsc/includes/config.php');

    ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo basename(__DIR__);?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
<?php include'../rsc/includes/header.php';?>
</head>
<body>
<?php include'../rsc/includes/navbar.php';?>


    <section class="ptb-0">
        <div class="mb-30 opacty-5"></div>
        <div class="container">
            <a class="mt-10" href="/"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-10 ion-chevron-right"></i></a>
            <a class="mt-10 color-ash"><?php echo basename(__DIR__);?></a>
        </div><!-- container -->
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">

                    <h4 class="p-title"><b><?php echo basename(__DIR__);?></b></h4>
                    <div class="row">
                                                                            <?php

$stmt = mysqli_prepare($con, "select tblposts.PostTitle as pid,tblposts.PostTitle as posttitle, tblposts.year as year, tblposts.month as month,tblposts.PostImage,tblcategory.CategoryName as category,tblwritter.Writter as writter,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblwritter on  tblwritter.WritterId=tblposts.WritterId where tblcategory.CategoryName=? and tblposts.Is_Active=1 order by tblposts.id desc LIMIT 16");
$stmt->bind_param("s", $category);
$category=basename(__DIR__);
$stmt->execute();
$stmt->bind_result($pid,$posttitle,$year,$month,$PostImage,$category,$writter,$postdetails,$postingdate,$url);
while ($stmt->fetch()){?>
                        <div class="col-sm-6">
                            <img src="/rsc/images/<?php echo $PostImage;?>" alt="">
                            <h4 class="pt-20"><a href="/<?php echo $url?>"><b><?php echo $posttitle;?></b></a></h4>
                            <ul class="list-li-mr-20 pt-10 mb-30">
                                <li class="color-lite-black">by <a href="#" class="color-black"><b><?php echo $writter; ?>,</b></a>
                               <?php echo $postingdate?></li>
                            </ul>
                        </div><!-- col-sm-6 -->
<?php } ?>
                    </div><!-- col-sm-6 -->



                </div><!-- col-md-9 -->

                <div class="d-none d-md-block d-lg-none col-md-3"></div>
<?php include'../rsc/includes/sidemenu.php'; ?>

            </div><!-- row -->
        </div><!-- container -->
    </section>

<?php include'../rsc/includes/footer.php'; ?>
<?php include'../rsc/includes/js.php';?>

</body>
</html>

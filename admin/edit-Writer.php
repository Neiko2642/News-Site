<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  {
header('location:index.php');
}
else{
if(isset($_POST['WritterDescription']))
{
$writterid=intval($_GET['scid']);
$categoryid=$_POST['category'];
$writtername=$_POST['Writter'];
$writterdescription=$_POST['WritterDescription'];
$stmt = $con->prepare("UPDATE tblwritter SET CategoryId='$categoryid',Writter='$writtername',writterdescription='$writterdescription' where WritterId='$writterid'");
    $stmt->bind_param("issi", $categoryid,$writtername,$writterdescription,$writterid);
$stmt->execute();


if($stmt)
{
$msg="Sub-Category created ";
}
else{
$error="Something went wrong . Please try again.";
}
}


?>


<!DOCTYPE html>
<html lang="en">
    <head>

        <title>NeikoPanel | Edit Writers</title>

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

<!-- Top Bar Start -->
 <?php include('includes/topheader.php');?>
<!-- Top Bar End -->


<!-- ========== Left Sidebar Start ========== -->
           <?php include('includes/leftsidebar.php');?>
 <!-- Left Sidebar End -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Edit Writer</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Category </a>
                                        </li>
                                        <li class="active">
                                            Edit Writter
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Edit Writer </b></h4>
                                    <hr />



<div class="row">
<div class="col-sm-6">
<!---Success Message--->
<?php if($msg){ ?>
<div class="alert alert-success" role="alert">
<strong>Well done!</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>

<!---Error Message--->
<?php if($error){ ?>
<div class="alert alert-danger" role="alert">
<strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
<?php } ?>


</div>
</div>

<?php
$stmt = mysqli_prepare($con, "Select tblcategory.CategoryName as catname,tblcategory.id as catid, tblwritter.Writter as writtername, tblwritter.writterdescription as writterdescription, tblwritter.PostingDate as writterpostingdate, tblwritter.UpdationDate as writterupdationdate, tblwritter.WritterId as writterid from  tblwritter join tblcategory on  tblwritter.CategoryId=tblcategory.id where  tblwritter.Is_Active=1 and  WritterId=?");
$stmt->bind_param("i", $writterid);
$writterid=intval($_GET['scid']);
$stmt->execute();
$stmt->bind_result($catname,$catid,$writtername,$writterdescription,$writterpostingdate,$writterupdationdate,$writterid);
$stmt->fetch();
?>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <form class="form-horizontal" name="category" method="post">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Category</label>
                                                    <div class="col-md-10">
                                                      <select class="form-control" name="category" required>
                                                   <option value="<?php echo $catid;?>"><?php echo $catname;?></option>


<p value="<?php echo $id;?>"><?php echo $CategoryName;?></p>

                                                        </select>
                                                    </div>
                                                </div>




    <div class="form-group">
                                                    <label class="col-md-2 control-label">Writer</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" value="<?php echo $writtername;?>" name="Writter" required>
                                                    </div>
                                                </div>






                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Writer-Category Description</label>
                                                    <div class="col-md-10">
                                       <textarea class="form-control" rows="5" name="WritterDescription" required><?php echo $writterdescription;?></textarea>
                                                    </div>
                                                </div>


        <div class="form-group">
                                                    <label class="col-md-2 control-label">&nbsp;</label>
                                                    <div class="col-md-10">

                                                <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submitsubcat">
                                                    Submit
                                                </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>


                                    </div>











                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->

<?php include('includes/footer.php');?>

            </div>




        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>
<?php } ?>
